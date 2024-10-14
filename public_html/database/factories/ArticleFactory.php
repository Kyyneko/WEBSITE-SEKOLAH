<?php

namespace Database\Factories;

use App\Models\Article;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class ArticleFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Article::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $title = $this->faker->sentence;

        return [
            'title' => $title,
            'slug' => Str::slug($title), // Menggunakan title untuk membuat slug
            'photo_path' => 'default.jpg', // Misalkan menggunakan default.jpg untuk semua artikel
            'description' => $this->faker->paragraph,
            // Disini akan menggunakan author_id secara acak antara 1 dan 4
            'author_id' => $this->faker->numberBetween(1, 4),
        ];
    }
}
