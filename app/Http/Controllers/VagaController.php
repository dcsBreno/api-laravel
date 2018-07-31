<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Vaga;
use Validator;

class VagaController extends Controller
{
    public function createVaga(Request $request) {
        $validate = $this->validaCampos($request);
        if($validate->fails()) {
            return response()->json($validate->errors());
        }

        $vaga = Vaga::create($request->all());
        return $vaga;
    }

    public function listaVagas() {
        $vagas = Vaga::with("empresa")->get();
        if (is_null($vagas) || count($vagas) == 0) {
            return response()->json("Nenhum dado encontrado.");
        }
        return response()->json($vagas);
    }

    public function listaVagaById($id) {
        $vaga = Vaga::where('id', $id)->with("empresa")->first();
        if (is_null($vaga)) {
            return response()->json("Nenhum dado encontrado.");
        }
        return response()->json($vaga);
    }

    public function updateVaga(Request $request, $id)
    {
        $validate = $this->validaCampos($request);
        if($validate->fails()) {
            return response()->json($validate->errors());
        }

        $vaga = Vaga::find($id);
        $vaga->update($request->all());
        return $vaga;
    }

    public function deleteVaga($id) {
        $vaga = Vaga::find($id);
        $vaga->delete();
        return response()->json(['message' => 'Vaga deletada com sucesso.'], 200);
    }

    private function validaCampos(Request $request) {
        return Validator::make($request->all(), $this->rules(), $this->mensagensErros());
    }

    private function rules() {
        return array(
            'funcao'          => 'required|max:150',
            'descricao'       => 'required|max:150',
            'salario'         => 'required|regex:/^\d{1,13}(\.\d{1,4})?$/',
            'empresa_id'      => 'required|digits:1'
        );
    }

    private function mensagensErros() {
        return array(
            'required'          => 'O campo é de preenchimento obrigatório.',
            'salario.digits'    => 'Informe um valor válido para o salário.',
            'digits'            => 'Este campo deve ser um número'
        );
    }
}
