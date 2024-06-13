<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class loginController
{
    const USERS = ['Толик' => 'director', 'Шадидур' =>'admin', 'Дима' => 'user'];
    public function getAccessRights(Request $request)
    {
        $nameUser[0]= $request->post("nameUser",null);
        $request->session()->pull('nameUser','default');
        $request->session()->pull('AccessRights', 'default');
        $request->session()->push('nameUser',$nameUser[0]);
        $request->session()->push('AccessRights', self::USERS[$nameUser[0]]);
        return view('4041',$nameUser);
    }
}
