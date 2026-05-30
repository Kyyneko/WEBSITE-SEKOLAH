<?php

namespace App\Helpers;

use Illuminate\Support\Str;

class ImageOptimizer
{
    /**
     * Compress, resize, and store an uploaded image.
     *
     * @param \Illuminate\Http\UploadedFile $file
     * @param string $directory Directory inside storage/app/public (e.g., 'article_photos')
     * @param int $maxWidth Maximum width of the image (default 1200)
     * @param int $quality Compression quality 1-100 (default 75)
     * @return string Stored file path (e.g., 'public/article_photos/filename.jpg')
     */
    public static function compressAndStore($file, $directory, $maxWidth = 1200, $quality = 75)
    {
        $extension = strtolower($file->getClientOriginalExtension());
        $mime = $file->getMimeType();
        $tempPath = $file->getRealPath();

        // Generate unique filename with .jpg extension for uniform performance and quality
        $fileName = Str::uuid() . '.jpg';
        $subFolder = trim($directory, '/');
        
        // Ensure destination folder exists in storage/app/public/subFolder
        $publicDir = storage_path('app/public/' . $subFolder);
        if (!file_exists($publicDir)) {
            mkdir($publicDir, 0775, true);
        }
        
        $destPath = $publicDir . '/' . $fileName;

        // Let's check if the file is HEIC/HEIF
        $isHeic = in_array($extension, ['heic', 'heif']) || in_array($mime, ['image/heic', 'image/heif']);
        
        if ($isHeic) {
            if (!class_exists('Imagick')) {
                throw new \Exception('Format HEIC memerlukan PHP extension Imagick. Silakan upload dalam format JPG, JPEG, PNG, atau WEBP.');
            }
            
            try {
                $imagick = new \Imagick($tempPath);
                $imagick->setImageFormat('jpeg');
                
                // Get original dimensions
                $origWidth = $imagick->getImageWidth();
                $origHeight = $imagick->getImageHeight();
                
                // Calculate new dimensions (preserve aspect ratio)
                if ($origWidth > $maxWidth) {
                    $newWidth = $maxWidth;
                    $newHeight = intval($origHeight * ($maxWidth / $origWidth));
                    $imagick->resizeImage($newWidth, $newHeight, \Imagick::FILTER_LANCZOS, 1);
                }
                
                $imagick->setImageCompressionQuality($quality);
                $imagick->writeImage($destPath);
                $imagick->clear();
                $imagick->destroy();
                
                return 'public/' . $subFolder . '/' . $fileName;
            } catch (\Throwable $e) {
                throw new \Exception('Gagal mengonversi file HEIC: ' . $e->getMessage());
            }
        }

        // Try using GD extension
        try {
            switch ($mime) {
                case 'image/jpeg':
                case 'image/jpg':
                case 'image/pjpeg':
                    $srcImg = @imagecreatefromjpeg($tempPath);
                    break;
                case 'image/png':
                case 'image/x-png':
                    $srcImg = @imagecreatefrompng($tempPath);
                    break;
                case 'image/gif':
                    $srcImg = @imagecreatefromgif($tempPath);
                    break;
                case 'image/webp':
                    $srcImg = @imagecreatefromwebp($tempPath);
                    break;
                default:
                    // If not supported by GD, fall back to Laravel's default store method
                    $storedPath = $file->store('public/' . $subFolder);
                    return $storedPath;
            }

            if (!$srcImg) {
                $storedPath = $file->store('public/' . $subFolder);
                return $storedPath;
            }

            // Get original dimensions
            $origWidth = imagesx($srcImg);
            $origHeight = imagesy($srcImg);

            // Calculate new dimensions (preserve aspect ratio)
            if ($origWidth > $maxWidth) {
                $newWidth = $maxWidth;
                $newHeight = intval($origHeight * ($maxWidth / $origWidth));
            } else {
                $newWidth = $origWidth;
                $newHeight = $origHeight;
            }

            // Create canvas for the new resized image
            $destImg = imagecreatetruecolor($newWidth, $newHeight);

            // Handle transparency for PNG/GIF
            imagealphablending($destImg, false);
            imagesavealpha($destImg, true);
            $transparentColor = imagecolorallocatealpha($destImg, 255, 255, 255, 127);
            imagefill($destImg, 0, 0, $transparentColor);

            // Copy and resize
            imagecopyresampled(
                $destImg,
                $srcImg,
                0, 0, 0, 0,
                $newWidth, $newHeight,
                $origWidth, $origHeight
            );

            // Save image as JPEG (universal, compressed)
            imagejpeg($destImg, $destPath, $quality);

            // Free memory
            imagedestroy($srcImg);
            imagedestroy($destImg);

            return 'public/' . $subFolder . '/' . $fileName;

        } catch (\Throwable $e) {
            // Fallback to Laravel's default store in case GD fails
            return $file->store('public/' . $subFolder);
        }
    }
}
