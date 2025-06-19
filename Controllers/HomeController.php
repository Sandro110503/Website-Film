<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Film;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    public function index()
    {
        $films = Film::all();
        $newReleases = Film::where('release_year', date('Y'))->get();
        $trendingFilms = Film::whereBetween('rating_imdb', [7, 9])
            ->inRandomOrder()
            ->take(10)
            ->get();

        $top10Films = Film::whereBetween('rating_imdb', [8, 9])
            ->inRandomOrder()
            ->take(10)
            ->get();
        $sliderFilms = Film::inRandomOrder()->limit(10)->get();

        return view('backend.v_home.index', compact('films', 'newReleases', 'trendingFilms', 'top10Films', 'sliderFilms'));
    }    

    public function filter(Request $request)
    {
        $genre = $request->input('genre'); 
        $year = $request->input('year');   

        $films = Film::query();

        if ($genre) {
            $films->where(function ($query) use ($genre) {
                foreach ((array) $genre as $g) {
                    $query->orWhere('genre', 'LIKE', "%$g%");
                }
            });
        }

        if ($year) {
            $films->where('release_year', $year);
        }

        return view('backend.admin.film.filter', [
            'films' => $films->get(),
            'genre' => $genre,
            'year' => $year
        ]);
    }
}
