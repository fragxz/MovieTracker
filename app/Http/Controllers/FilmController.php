<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use App\Models\Film;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\App;

class FilmController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->api_url = env('FILMDATA_API_URL');
        $this->api_key = env('OMDB_API_KEY');
    }

    public function read()
    {
        $filmlogs = FilmlogController::read();

        return view('dashboard', [
            "filmlogs"=>$filmlogs,
        ]);
    }

    public function search(Request $request)
    {
        $search = $request->input('search_film');
        $requestURL = "$this->api_url/?s=$search&apikey=$this->api_key";
        $response = Http::get($requestURL);
        $films = json_decode($response->body(), TRUE);


        if ($films['Response'] == 'False' ) {
            return redirect('')->with('error',$films['Error']);
        }

        if ( isset($films['Search']) ) {
            $searchResult = $films['Search'];
            return view('search', ["films" => $searchResult]);
        }

    }

    public function create(Request $request)
    {
        $film = Film::firstOrCreate(
            ['imdb_id' => $request->input('imdbID')],
            [
                'title' => $request->input('title'),
                'year' => $request->input('year'),
                'type' => $request->input('type'),
                'poster_url' => $request->input('poster')
            ]
        );

        $result = FilmlogController::create($film->id);

        if (isset($result[0]) && $result[0] == 'ERROR') {
            return redirect('')->with('error',$result[1]);
        } else {
            return redirect('')->with('success_create',$film->title);
        }
    }

    public function update()
    {
        // possible idea: update existing films in database via cron..
    }

    public function findExisting($imdbID)
    {
        $foundFilm = Film::where('active', 1)
            ->where('imdb_id', $imdbID)
            ->first();

        if (! $foundFilm) { return FALSE; }

        return $foundFilm->id;
    }

}
