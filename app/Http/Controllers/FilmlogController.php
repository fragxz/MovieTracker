<?php

namespace App\Http\Controllers;

use App\Models\Film;
use App\Models\Filmlog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;

class FilmlogController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function create($film_id)
    {
        $filmlogExists = FilmlogController::findExisting($film_id);

        if ( $filmlogExists ) {
            return ['ERROR','Could not add Filmlog, it already exists.'];
        }

        $filmlog = new Filmlog();
        $filmlog->user_id = Auth::id();
        $filmlog->film_id = $film_id;
        $filmlog->status = 'seen';
        $result = $filmlog->save();

        if(!$result){
            App::abort(500, 'Error 142'); // Filmlog could not be saved
        }

        return $result;
    }

    public function read()
    {
        $filmlogs = Film::where('films.active', 1)
            ->where('user_id', Auth::id())
            ->leftJoin('filmlogs', 'filmlogs.film_id', '=', 'films.id')
            ->get();

        return $filmlogs;
    }

    public function delete(Request $request)
    {
        $filmlog_id = $request->input('filmlog_id');
        $title = $request->input('title');

        if ($filmlog_id <= 0) {
            App::abort(500, 'Error 143'); // Filmlog could not be deleted
        }

        $filmlog = Filmlog::find($filmlog_id);
        $filmlog->delete();

        return redirect('')->with('success_delete',$title);
    }

    /**
     * find existing Filmlog
     * if found, return true
     * if not found, return false
     * @param $film_id
     * @return bool
     */
    public static function findExisting($film_id)
    {
        $foundFilmlog = Filmlog::where('active', 1)
            ->where('film_id', $film_id)
            ->where('user_id', Auth::id())
            ->first();

        if ($foundFilmlog) { return TRUE; }
        return FALSE;
    }
}
