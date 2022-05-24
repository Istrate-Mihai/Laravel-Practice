<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Profile;
use App\Models\Author;

class AuthorFactory extends Factory
{
  /**
   * Define the model's default state.
   *
   * @return array
   */
  public function definition()
  {
    return [];
  }

  public function configure()
  {
    // return $this->afterMaking(function (Author $author) {
    //   return $author->profile()->save(Profile::factory()->create(['author_id' => 5]));
    // })
    return $this->afterCreating(function (Author $author) {
      return $author->profile()->save(Profile::factory()->create(['author_id' => 20]));
    });
  }
}
