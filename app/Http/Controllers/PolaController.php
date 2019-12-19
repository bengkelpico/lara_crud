<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;

class PolaController extends Controller
{
    public function index(Request $request, Response $response)
    {
        if ($request->post('name')) {
            return $response->json(['test' => 'test']);
        }

        return view('pola.jumlah');
    }

    public function star(Request $request, Response $response)
    {
        if ($request->post('name')) {
            return $response->json(['test' => 'test']);
        }

        return view('pola.star');
    }
}
