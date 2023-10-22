<?php

namespace App\Http\Controllers;

use App\Models\Filmlog;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;

class FilmlogController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public static function create($film_id)
    {
        $filmlogExists = FilmlogController::findExisting($film_id);

        if ($filmlogExists) {
            return ['ERROR', 'Could not add Filmlog, it already exists.'];
        }

        $filmlog = new Filmlog();
        $filmlog->user_id = Auth::id();
        $filmlog->film_id = $film_id;
        $filmlog->status = 'seen';
        $result = $filmlog->save();

        if (!$result) {
            App::abort(500, 'Error 142'); // Filmlog could not be saved
        }

        return $result;
    }

    public static function read()
    {
        return Auth::user()->filmlogs()->with('film')->get();
    }

    public function delete(Filmlog $filmlog)
    {
        $title = $filmlog->film->title;
        $filmlog->delete();
        return redirect('')->with('success_delete', $title);
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
        return Filmlog::where('active', 1)
            ->where('film_id', $film_id)
            ->where('user_id', Auth::id())
            ->exists();
    }
}
