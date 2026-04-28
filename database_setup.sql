-- ============================================================
-- SQL LENGKAP - Database Website SMP Negeri 14 Bulukumba
-- Jalankan seluruh query ini di phpMyAdmin (Tab SQL)
-- ============================================================

-- 1. Buat Database
CREATE DATABASE IF NOT EXISTS `website-sekolah`
    CHARACTER SET utf8mb4
    COLLATE utf8mb4_unicode_ci;

USE `website-sekolah`;

-- ============================================================
-- 2. TABEL: users
-- ============================================================
CREATE TABLE `users` (
    `id` BIGINT UNSIGNED NOT NULL AUTO_INCREMENT,
    `name` VARCHAR(255) NOT NULL,
    `nik` VARCHAR(255) NULL DEFAULT NULL,
    `nip` VARCHAR(255) NULL DEFAULT NULL,
    `ttl` VARCHAR(255) NULL DEFAULT NULL,
    `phone` VARCHAR(255) NULL DEFAULT NULL,
    `email` VARCHAR(255) NOT NULL,
    `subject_id` INT NULL DEFAULT NULL,
    `photo_path` VARCHAR(255) NULL DEFAULT NULL,
    `email_verified_at` TIMESTAMP NULL DEFAULT NULL,
    `password` VARCHAR(255) NOT NULL,
    `role` ENUM('teacher', 'admin') NOT NULL DEFAULT 'teacher',
    `remember_token` VARCHAR(100) NULL DEFAULT NULL,
    `created_at` TIMESTAMP NULL DEFAULT NULL,
    `updated_at` TIMESTAMP NULL DEFAULT NULL,
    PRIMARY KEY (`id`),
    UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ============================================================
-- 3. TABEL: password_reset_tokens
-- ============================================================
CREATE TABLE `password_reset_tokens` (
    `email` VARCHAR(255) NOT NULL,
    `token` VARCHAR(255) NOT NULL,
    `created_at` TIMESTAMP NULL DEFAULT NULL,
    PRIMARY KEY (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ============================================================
-- 4. TABEL: failed_jobs
-- ============================================================
CREATE TABLE `failed_jobs` (
    `id` BIGINT UNSIGNED NOT NULL AUTO_INCREMENT,
    `uuid` VARCHAR(255) NOT NULL,
    `connection` TEXT NOT NULL,
    `queue` TEXT NOT NULL,
    `payload` LONGTEXT NOT NULL,
    `exception` LONGTEXT NOT NULL,
    `failed_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    PRIMARY KEY (`id`),
    UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ============================================================
-- 5. TABEL: personal_access_tokens (Sanctum)
-- ============================================================
CREATE TABLE `personal_access_tokens` (
    `id` BIGINT UNSIGNED NOT NULL AUTO_INCREMENT,
    `tokenable_type` VARCHAR(255) NOT NULL,
    `tokenable_id` BIGINT UNSIGNED NOT NULL,
    `name` VARCHAR(255) NOT NULL,
    `token` VARCHAR(64) NOT NULL,
    `abilities` TEXT NULL DEFAULT NULL,
    `last_used_at` TIMESTAMP NULL DEFAULT NULL,
    `expires_at` TIMESTAMP NULL DEFAULT NULL,
    `created_at` TIMESTAMP NULL DEFAULT NULL,
    `updated_at` TIMESTAMP NULL DEFAULT NULL,
    PRIMARY KEY (`id`),
    UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
    KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`, `tokenable_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ============================================================
-- 6. TABEL: subjects (Mata Pelajaran)
-- ============================================================
CREATE TABLE `subjects` (
    `id` BIGINT UNSIGNED NOT NULL AUTO_INCREMENT,
    `name` VARCHAR(255) NOT NULL,
    `description` TEXT NULL DEFAULT NULL,
    `created_at` TIMESTAMP NULL DEFAULT NULL,
    `updated_at` TIMESTAMP NULL DEFAULT NULL,
    PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ============================================================
-- 7. TABEL: documents (Perangkat Pembelajaran)
-- ============================================================
CREATE TABLE `documents` (
    `id` BIGINT UNSIGNED NOT NULL AUTO_INCREMENT,
    `user_id` BIGINT UNSIGNED NOT NULL,
    `description` TEXT NULL DEFAULT NULL,
    `file_path` VARCHAR(255) NOT NULL,
    `created_at` TIMESTAMP NULL DEFAULT NULL,
    `updated_at` TIMESTAMP NULL DEFAULT NULL,
    PRIMARY KEY (`id`),
    KEY `documents_user_id_index` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ============================================================
-- 8. TABEL: articles (Artikel)
-- ============================================================
CREATE TABLE `articles` (
    `id` BIGINT UNSIGNED NOT NULL AUTO_INCREMENT,
    `title` VARCHAR(255) NOT NULL,
    `slug` VARCHAR(255) NOT NULL,
    `photo_path` JSON NULL DEFAULT NULL,
    `description` TEXT NULL DEFAULT NULL,
    `author_id` INT NOT NULL,
    `created_at` TIMESTAMP NULL DEFAULT NULL,
    `updated_at` TIMESTAMP NULL DEFAULT NULL,
    PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ============================================================
-- 9. TABEL: ads (Iklan / Banner)
-- ============================================================
CREATE TABLE `ads` (
    `id` BIGINT UNSIGNED NOT NULL AUTO_INCREMENT,
    `title` VARCHAR(255) NOT NULL,
    `description` TEXT NOT NULL,
    `link` VARCHAR(255) NOT NULL,
    `photo_path` VARCHAR(255) NOT NULL,
    `created_at` TIMESTAMP NULL DEFAULT NULL,
    `updated_at` TIMESTAMP NULL DEFAULT NULL,
    PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ============================================================
-- 10. TABEL: organisasis (Organisasi / Ekskul)
-- ============================================================
CREATE TABLE `organisasis` (
    `id` BIGINT UNSIGNED NOT NULL AUTO_INCREMENT,
    `nama` VARCHAR(255) NOT NULL,
    `slug` VARCHAR(255) NOT NULL,
    `description` TEXT NOT NULL,
    `photo_path` JSON NULL DEFAULT NULL,
    `created_at` TIMESTAMP NULL DEFAULT NULL,
    `updated_at` TIMESTAMP NULL DEFAULT NULL,
    PRIMARY KEY (`id`),
    UNIQUE KEY `organisasis_slug_unique` (`slug`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ============================================================
-- 11. TABEL: migrations (Laravel Internal)
-- ============================================================
CREATE TABLE `migrations` (
    `id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
    `migration` VARCHAR(255) NOT NULL,
    `batch` INT NOT NULL,
    PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Catat migration sebagai sudah dijalankan
INSERT INTO `migrations` (`migration`, `batch`) VALUES
('2014_10_12_000000_create_users_table', 1),
('2014_10_12_100000_create_password_reset_tokens_table', 1),
('2019_08_19_000000_create_failed_jobs_table', 1),
('2019_12_14_000001_create_personal_access_tokens_table', 1),
('2024_02_06_165956_documents', 1),
('2024_02_06_214348_create_subjects_table', 1),
('2024_02_07_193058_create_articles_table', 1),
('2024_02_08_101118_create_ads_table', 1),
('2024_02_11_174401_create_organisasis_table', 1);

-- ============================================================
-- 12. SEED DATA: Mata Pelajaran
-- ============================================================
INSERT INTO `subjects` (`name`, `created_at`, `updated_at`) VALUES
('Seni Budaya', NOW(), NOW()),
('Matematika', NOW(), NOW()),
('Bahasa Indonesia', NOW(), NOW()),
('Bahasa Inggris', NOW(), NOW()),
('Fisika', NOW(), NOW()),
('Kimia', NOW(), NOW()),
('Biologi', NOW(), NOW()),
('Sejarah', NOW(), NOW());

-- ============================================================
-- 13. SEED DATA: User Admin
-- Password: "password" (bcrypt hash)
-- ============================================================
INSERT INTO `users` (`name`, `email`, `email_verified_at`, `subject_id`, `password`, `role`, `remember_token`, `created_at`, `updated_at`) VALUES
('Mahendra Kirana M.B', 'mahendrakirana284@gmail.com', NOW(), 1,
 '$2y$12$jb8pDdNOtg1szd13TbOe1.2qLWMr8RbDB8oyjaJN.wxgknOEgzWVy',
 'admin', NULL, NOW(), NOW()),
('Muhammad Amin', 'myfitriamin@gmail.com', NOW(), NULL,
 '$2y$12$Kb6KBVupp.fwK4HoWgeFYOvG2T7Q5eSAgJ0Y8OxezRnmXW43./7/u',
 'admin', NULL, NOW(), NOW());

-- ============================================================
-- SELESAI! Database siap digunakan.
-- 
-- AKUN LOGIN:
-- 1. Email: mahendrakirana284@gmail.com  |  Password: password
-- 2. Email: myfitriamin@gmail.com        |  Password: 11Bulukumba
-- ============================================================
