<?php

declare(strict_types=1);

namespace Database\Seeders;

use App\Models\Movie;
use App\Models\User;
use Illuminate\Database\Seeder;

class MovieSeeder extends Seeder
{
    private const DEFAULT_USERS_MOVIE_COUNT = 5;

    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $users = User::all();

        Movie::factory(
            $users->count() * self::DEFAULT_USERS_MOVIE_COUNT
        )->create();

        $skipCounter = 0;

        foreach ($users as $user) {
            $movies = Movie::skip($skipCounter)->take(self::DEFAULT_USERS_MOVIE_COUNT)->get();

            foreach ($movies as $movie) {
                $user->movies()->save($movie);
            }

            $skipCounter += self::DEFAULT_USERS_MOVIE_COUNT;
        }
    }
}
