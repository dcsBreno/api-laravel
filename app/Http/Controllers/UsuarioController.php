<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Usuario;
use Validator;

class UsuarioController extends Controller
{
    public function createUsuario(Request $request) {
        $validate = $this->validaCampos($request);
        if($validate->fails()) {
            return response()->json($validate->errors());
        }

        $usuario = Usuario::create($request->all());
        return $usuario;
    }

    public function listaUsuarios() {
        $usuario = Usuario::with("endereco")->get();
        if (is_null($usuario) || count($usuario) == 0) {
            return response()->json("Nenhum dado encontrado.");
        }
        return response()->json($usuario);
    }

    public function listaUsuarioById($id) {
        $usuario = Usuario::where('id', $id)->with("endereco")->first();
        if (is_null($usuario)) {
            return response()->json("Nenhum dado encontrado.");
        }
        return response()->json($usuario);
    }

    public function updateUsuario(Request $request, $id)
    {
        $validate = $this->validaCampos($request);
        if($validate->fails()) {
            return response()->json($validate->errors());
        }

        $usuario = Usuario::find($id);
        $usuario->update($request->all());
        return $usuario;
    }

    public function deleteUsuario($id) {
        $usuario = Usuario::find($id);
        $usuario->delete();
        return response()->json(['message' => 'Usuário deletado com sucesso.'], 200);
    }

    private function validaCampos(Request $request) {
        return Validator::make($request->all(), $this->rules(), $this->mensagensErros());
    }

    private function rules() {
        return array(
            'nome'             => 'required|max:150',
            'email'            => 'required|max:150|email',
            'telefone'         => 'required|min:9|max:9',
            'endereco_id'      => 'required|digits:1'
        );
    }

    private function mensagensErros() {
        return array(
            'required'          => 'O campo é de preenchimento obrigatório.',
            'telefone.max'      => 'No máximo 9 caracteres.',
            'telefone.min'      => 'No mínimo 9 caracteres.',
            'email'             => 'Informe um e-mail válido.',
            'digits'            => 'Este campo deve ser um número'
        );
    }
}
