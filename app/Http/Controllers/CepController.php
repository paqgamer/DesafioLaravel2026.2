<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Http;

class CepController extends Controller
{
    public function show(string $cep)
    {
        $cepLimpo = preg_replace('/\D/', '', $cep);

        if (strlen($cepLimpo) !== 8) {
            return response()->json(['erro' => true, 'mensagem' => 'CEP inválido.'], 422);
        }

        $response = Http::timeout(5)->get("https://viacep.com.br/ws/{$cepLimpo}/json/");

        if ($response->failed()) {
            return response()->json(['erro' => true, 'mensagem' => 'Erro, o cep não  pode ser consultado no momento, favor preencher manualmente ou aguardar.'], 502);
        }

        $dados = $response->json();

        if (! empty($dados['erro'])) {
            return response()->json(['erro' => true, 'mensagem' => 'CEP não encontrado.'], 404);
        }

        return response()->json([
            'cep' => $dados['cep'] ?? null,
            'logradouro' => $dados['logradouro'] ?? null,
            'complemento' => $dados['complemento'] ?? null,
            'unidade' => $dados['unidade'] ?? null,
            'bairro' => $dados['bairro'] ?? null,
            'localidade' => $dados['localidade'] ?? null,
            'uf' => $dados['uf'] ?? null,
            'estado' => $dados['estado'] ?? null,
            'regiao' => $dados['regiao'] ?? null,
            'ibge' => $dados['ibge'] ?? null,
            'gia' => $dados['gia'] ?? null,
            'ddd' => $dados['ddd'] ?? null,
            'siafi' => $dados['siafi'] ?? null,
        ]);
    }
}