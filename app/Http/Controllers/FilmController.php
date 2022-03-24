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
        $this->api_url = env('FILMDATA_API_URL');
        $this->api_key = env('OMDB_API_KEY');
    }

    public function read()
    {
        if (! Auth::User()) {
            return redirect('/login');
        }

        $filmlogs = FilmlogController::read();

        return view('dashboard', [
            "filmlogs"=>$filmlogs,
        ]);
    }

    public function search(Request $request)
    {
        if (! Auth::User()) {
            return redirect('/login');
        }

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
        if (! Auth::User()) {
            return redirect('/login');
        }

        $title = $request->input('title');
        $year = $request->input('year');
        $imdb_id = $request->input('imdbID');
        $type = $request->input('type');
        $poster = $request->input('poster');

        $foundFilm = $this->findExisting($imdb_id);

        if ( !$foundFilm ) {
            $film = new Film;
            $film->title = $title;
            $film->year = $year ? $year : '';
            $film->imdb_id = $imdb_id;
            $film->type = $type;
            $film->poster_url = $poster;
            $result = $film->save();

            if(!$result){
                App::abort(500, 'Error 142'); // Film could not be saved
            }
        }

        if ($foundFilm) {
            $film_id = $foundFilm;
        } else {
            $film_id = $film->id;
        }

        $result = FilmlogController::create($film_id);

        if (isset($result[0]) && $result[0] == 'ERROR') {
            return redirect('')->with('error',$result[1]);
        } else {
            return redirect('')->with('success_create',$title);
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
