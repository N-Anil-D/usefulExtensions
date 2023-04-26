<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Stevebauman\Location\Facades\Location;
use Illuminate\Support\{Str, Arr};


class LocationController extends Controller
{
    public function index(){
        dd(Location::get(request()->ip()),Arr::dot(Location::get()));
    }
}
