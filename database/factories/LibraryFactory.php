<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use LaraZeus\Sky\SkyPlugin;

class LibraryFactory extends Factory
{
    public function getModel(): string
    {
        return SkyPlugin::get()->getLibraryModel();
    }

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'slug' => $this->faker->slug(2),
            'title' => $this->faker->word,
            'description' => $this->faker->sentence,
            'type' => $this->faker->randomElements(config('zeus-sky.library_types')),
            'file_path' => 'https://picsum.photos/200/300',
        ];
    }
}
