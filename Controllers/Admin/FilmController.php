<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Film;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FilmController extends Controller
{

    public function filmBackend()
    {
        $films = Film::with('reviews')->get();
        return view('backend.admin.film.create', data: compact('films'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        {
            return view('backend.admin.film.create');
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'genre' => 'required|string|max:100',
            'release_year' => 'required|integer|digits:4',
            'rating_imdb' => 'required|numeric|between:0,10',
            'poster' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'synopsis' => 'required|string',
        ]);
    
        $posterPath = null;
        if ($request->hasFile('poster')) {
            $posterPath = $request->file('poster')->store('posters', 'public');
        }
    
        Film::create([
            'title' => $request->title,
            'genre' => $request->genre,
            'release_year'=> $request->release_year,
            'rating_imdb' => $request->rating_imdb,
            'poster' => $posterPath,
            'synopsis' => $request->synopsis,
        ]);
    
        return redirect()->route('backend.admin.film.index')->with('success', 'Film berhasil ditambahkan!');
    }

    public function storeReview(Request $request, $id)
    {
        $request->validate([
            'rating' => 'required|integer|min:1|max:5',
            'review' => 'required|string'
        ]);

        $film = Film::findOrFail($id);
        $film->reviews()->create([
            'user_id' => auth()->id(),
            'rating' => $request->rating,
            'review' => $request->review,
        ]);

        return redirect()->route('film.show', $film->id)->with('success', 'Ulasan berhasil dikirim.');
    }


    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $film = Film::with('reviews.user')->findOrFail($id);
        return view('backend.admin.film.show', compact('film'));
    }

    public function search(Request $request)
    {
        $query = $request->input('query');
        $selectedGenre = $request->input('genre');

        $keywords = $query ? preg_split('/[\s,]+/', $query) : [];

        $validGenres = [
            'Action', 'Adventure', 'Anime', 'Biography', 'Comedy',
            'Documentary', 'Drama', 'Family', 'Fantasy', 'History',
            'Horror', 'Musical', 'Mystery', 'Romance', 'Sci-Fi',
            'Supernatural', 'Sport', 'Slice of Life', 'Superhero', 'Thriller'
        ];

        $films = Film::query();

        if ($selectedGenre && in_array($selectedGenre, $validGenres)) {
            $films->where('genre', 'like', "%$selectedGenre%");
        }

        foreach ($keywords as $word) {
            $cleanWord = trim(ucwords(strtolower($word))); 

            if (in_array($cleanWord, $validGenres)) {
                $films->orWhere('genre', 'like', '%' . $cleanWord . '%');
            } elseif (is_numeric($word) && strlen($word) == 4) {
                $films->orWhereYear('release_year', $word);
            } else {
                $films->orWhere('title', 'like', '%' . $word . '%');
            }
        }

        $results = $films->get();

        return view('backend.admin.film.search_result', [
            'films' => $results,
            'query' => $query,
            'selectedGenre' => $selectedGenre
        ]);
    }

    public function searchForm()
    {
        return view('backend.admin.film.search');
    }

    public function searchResults(Request $request)
    {
        $query = $request->input('query');
        $films = Film::where('title', 'LIKE', '%' . $query . '%')->get();

        return view('backend.admin.film.search_results', compact('films', 'query'));
    }

    public function edit($id)
    {
        $film = Film::findOrFail($id);
        return view('backend.admin.film.edit', compact('film'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => 'required|string',
            'genre' => 'required|string',
            'release_year' => 'required|integer',
            'rating_imdb' => 'required|numeric|between:0,10',
            'synopsis' => 'required|string',
            'poster' => 'nullable|image|max:2048',
        ]);

        $film = Film::findOrFail($id);
        $film->title = $request->title;
        $film->genre = $request->genre;
        $film->release_year = $request->release_year;
        $film->rating_imdb = $request->rating_imdb;
        $film->synopsis = $request->synopsis;

        if ($request->hasFile('poster')) {
            $posterPath = $request->file('poster')->store('posters', 'public');
            $film->poster = $posterPath;
        }



        $film->save();

        return redirect()->route('films.index')->with('success', 'Film berhasil diperbarui.');
    }

    public function index(Request $request)
    {
        $query = $request->input('query');
        $selectedGenre = $request->input('genre');

        $keywords = $query ? preg_split('/[\s,]+/', $query) : [];

        $validGenres = [
            'Action', 'Adventure', 'Anime', 'Biography', 'Comedy',
            'Documentary', 'Drama', 'Family', 'Fantasy', 'History',
            'Horror', 'Musical', 'Mystery', 'Romance', 'Sci-Fi',
            'Supernatural', 'Sport', 'Slice of Life', 'Superhero', 'Thriller'
        ];

        $films = Film::query();

        if ($selectedGenre && in_array($selectedGenre, $validGenres)) {
            $films->where('genre', 'like', "%$selectedGenre%");
        }

        foreach ($keywords as $word) {
            $cleanWord = trim(ucwords(strtolower($word))); 

            if (in_array($cleanWord, $validGenres)) {
                $films->orWhere('genre', 'like', '%' . $cleanWord . '%');
            } elseif (is_numeric($word) && strlen($word) == 4) {
                $films->orWhere('release_year', $word); // Diperbaiki di sini
            } else {
                $films->orWhere('title', 'like', '%' . $word . '%');
            }
        }

        $results = $films->get();

        return view('backend.admin.film.index', [
            'films' => $results,
            'query' => $query,
            'selectedGenre' => $selectedGenre
        ]);
    }



    public function destroy(string $id)
    {
        $film = Film::findOrFail($id);
        $film->delete();
        return redirect()->route('backend.admin.film.index')->with('success', 'Film berhasil dihapus.');
    }
}
