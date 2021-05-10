<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Kategori_Lampu;
use Validator;
use App\Http\Resources\KategorilampuResource;

class KategorilampuController extends Controller
{
    public function get_all()
    {
        return KategorilampuResource::collection(Kategori_lampu::all());
    }
}
