<?php

namespace App\Http\Controllers;
class errorController extends Controller
{
   public function getError()
   {
       //abort(404);
       return view('404');
   }
}
