<?php

namespace LaraZeus\Sky\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use LaraZeus\Sky\Models\Post;
use App\Models\User;

class PostFactory extends Factory
{
	protected $model = Post::class;

	/**
	 * Define the model's default state.
	 *
	 * @return array
	 */
	public function definition()
	{
		return [
			'user_id'      => auth()->user()->id ?? User::first()->id ?? 1,
			'title'        => $this->faker->sentence,
			'slug'         => $this->faker->slug(),
			'description'  => $this->faker->sentence,
			'content'      => $this->faker->sentence,
			'published_at' => now(),
			'status'       => 'publish',
			'ordering'     => 1,
			'post_type'    => $this->faker->randomElement(['page', 'post']),
		];
	}
}
