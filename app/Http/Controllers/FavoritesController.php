<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FavoritesController extends Controller
{

    public function store(Request $request, $id)
    {
        Auth::user()->favorite($id);
        return back();
    }

    public function destroy($id)
    {
        Auth::user()->unfavorite($id);
        return back();
    }

}
