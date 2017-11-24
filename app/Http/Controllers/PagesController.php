<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PagesController extends Controller
{
    //
    public function index(){
        $data=[
            'title'=>'WHAAAT',
            'bob'=>false,
            'services'=>['sdfsd','sdfsd']
        ];
        return view('about.one')->with($data);
    }
}
