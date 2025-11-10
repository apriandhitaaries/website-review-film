<?php

namespace Database\Seeders;

use App\Models\Genre;
use Illuminate\Database\Seeder;

class GenreSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $daftarGenre = [
            "Action",
            "Comedy",
            "Drama",
            "Horror",
            "Romance",
            "Sci-Fi",
            "Thriller",
            "Fantasy",
            "Documentary",
            "Animation",
            "Adventure",
            "Crime",
            "Mystery",
            "Musical",
            "Family",
        ];

        foreach ($daftarGenre as $namaGenre) {
            Genre::updateOrCreate(
                ['nama' => $namaGenre]
            );
        }
    }
}
