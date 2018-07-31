<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Endereco;
use Validator;

class EnderecoController extends Controller
{
    public function createEndereco(Request $request) {
        $validate = $this->validaCampos($request);
        if($validate->fails()) {
            return response()->json($validate->errors());
        }

        $endereco = Endereco::create($request->all());
        return $endereco;
    }

    public function listaEnderecos() {
        $enderecos = Endereco::all();
        if (is_null($enderecos) || count($enderecos) == 0) {
            return response()->json("Nenhum dado encontrado.");
        }
        return response()->json($enderecos);
    }

    public function listaEnderecoById($id) {
        $endereco = Endereco::find($id);
        if (is_null($endereco)) {
            return response()->json("Nenhum dado encontrado.");
        }
        return response()->json($endereco);
    }

    public function updateEndereco(Request $request, $id)
    {
        $validate = $this->validaCampos($request);
        if($validate->fails()) {
            return response()->json($validate->errors());
        }

        $endereco = Endereco::find($id);
        $endereco->update($request->all());
        return $endereco;
    }

    public function deleteEndereco($id) {
        $endereco = Endereco::find($id);
        $endereco->delete();
        return response()->json(['message' => 'Endereço deletado com sucesso.'], 200);
    }

    private function validaCampos(Request $request) {
        return Validator::make($request->all(), $this->rules(), $this->mensagensErros());
    }

    private function rules() {
        return array(
            'rua'               => 'required|max:150',
            'numero'            => 'required|max:5',
            'bairro'            => 'required|max:150',
            'cidade'            => 'required|max:150',
            'estado'            => 'required|min:2|max:2'
        );
    }

    private function mensagensErros() {
        return array(
            'required'          => 'O campo é de preenchimento obrigatório.',
            'max'               => 'No máximo 5 caracteres.',
            'estado.min'        => 'Este campo deve ser composto por 2 caracteres.',
            'estado.max'        => 'Este campo deve ser composto por 2 caracteres.'
        );
    }
}
