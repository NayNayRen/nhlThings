<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PlayerController extends Controller
{
  public function player($id)
  {
    return view('player', [
      'title' => 'Player Page'
    ]);
  }
}
