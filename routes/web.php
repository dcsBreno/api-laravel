<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});
Route::get('/api/endereco', 'EnderecoController@listaEnderecos');
Route::get('/api/endereco/{id}' ,'EnderecoController@listaEnderecoById');
Route::delete('/api/endereco/{id}' ,'EnderecoController@deleteEndereco');
Route::post('/api/endereco', 'EnderecoController@createEndereco');
Route::put('/api/endereco/{id}', 'EnderecoController@updateEndereco');

Route::post('/api/usuario', 'UsuarioController@createUsuario');
Route::get('/api/usuario', 'UsuarioController@listaUsuarios');
Route::get('/api/usuario/{id}', 'UsuarioController@listaUsuarioById');
Route::put('/api/usuario/{id}', 'UsuarioController@updateUsuario');
Route::delete('/api/usuario/{id}', 'UsuarioController@deleteUsuario');

Route::post('/api/empresa', 'EmpresaController@createEmpresa');
Route::get('/api/empresa', 'EmpresaController@listaEmpresas');
Route::get('/api/empresa/{id}', 'EmpresaController@listaEmpresaById');
Route::put('/api/empresa/{id}', 'EmpresaController@updateEmpresa');
Route::delete('/api/empresa/{id}', 'EmpresaController@deleteEmpresa');

Route::post('/api/vaga', 'VagaController@createVaga');
Route::get('/api/vaga', 'VagaController@listaVagas');
Route::get('/api/vaga/{id}', 'VagaController@listaVagaById');
Route::put('/api/vaga/{id}', 'VagaController@updateVaga');
Route::delete('/api/vaga/{id}', 'VagaController@deleteVaga');