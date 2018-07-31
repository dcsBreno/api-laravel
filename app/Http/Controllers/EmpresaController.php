<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Empresa;
use Validator;

class EmpresaController extends Controller
{
    public function createEmpresa(Request $request) {
        $validate = $this->validaCampos($request);
        if($validate->fails()) {
            return response()->json($validate->errors());
        }

        $empresa = Empresa::create($request->all());
        return $empresa;
    }

    public function listaEmpresas() {
        $empresas = Empresa::with("endereco")->get();
        if (is_null($empresas) || count($empresas) == 0) {
            return response()->json("Nenhum dado encontrado.");
        }
        return response()->json($empresas);
    }

    public function listaEmpresaById($id) {
        $empresa = Empresa::where('id', $id)->with("endereco")->first();
        if (is_null($empresa)) {
            return response()->json("Nenhum dado encontrado.");
        }
        return response()->json($empresa);
    }

    public function updateEmpresa(Request $request, $id)
    {
        $validate = $this->validaCampos($request);
        if($validate->fails()) {
            return response()->json($validate->errors());
        }

        $empresa = Empresa::find($id);
        $empresa->update($request->all());
        return $empresa;
    }

    public function deleteEmpresa($id) {
        $empresa = Empresa::find($id);
        $empresa->delete();
        return response()->json(['message' => 'Empresa deletada com sucesso.'], 200);
    }

    private function validaCampos(Request $request) {
        return Validator::make($request->all(), $this->rules(), $this->mensagensErros());
    }

    private function rules() {
        return array(
            'cnpj'             => 'required|digits:14',
            'nome'             => 'required|max:150',
            'telefone'         => 'required|min:9|max:9',
            'endereco_id'      => 'required|digits:1'
        );
    }

    private function mensagensErros() {
        return array(
            'required'          => 'O campo é de preenchimento obrigatório.',
            'telefone.max'      => 'No máximo 9 caracteres.',
            'telefone.min'      => 'No mínimo 9 caracteres.',
            'cnpj.digits'       => 'Informe um CNPJ válido com 14 caracteres.',
            'digits'            => 'Este campo deve ser um número'
        );
    }
}
