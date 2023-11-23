<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PlayerController extends Controller
{
  public function getPlayer()
  {
    return view('player', [
      'title' => 'Player Page'
    ]);
  }
}
