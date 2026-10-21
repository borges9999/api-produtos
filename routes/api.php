<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\ProdutoController;
use Illuminate\Support\Facades\Http;

Route::get('/usuarios-externos', function () {
    $resposta = Http::timeout(10)
        ->get('https://jsonplaceholder.typicode.com/users');

    if ($resposta->failed()) {
        return response()->json([
            'erro' => 'Não foi possível consultar a API externa'
        ], 502);
    }

    return response()->json($resposta->json());
});

Route::apiResource('produtos', ProdutoController::class);