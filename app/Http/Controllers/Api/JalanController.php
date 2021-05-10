<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Jalan;
use Validator;
use App\Http\Resources\JalanResource;

class JalanController extends Controller
{
     public function get_jalan()
     {
       return JalanResource::collection(Jalan::all());
     }
}
