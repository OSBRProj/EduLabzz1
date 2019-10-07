<?php

use Illuminate\Http\Request;

Route::middleware('auth:api')->get('/user', function (Request $request) {
  return $request->user();
});

Route::group(["prefix" => "v2", "namespace" => "API"], function () {
  Route::post('/login', 'LoginController@login');
  Route::post('/forgot-password', 'LoginController@forgotPassword');
  Route::get('/refresh', 'LoginController@refresh');
  Route::get('/logout', 'LoginController@logout');

  Route::group(["middleware" => "jwt.auth"], function () {
    Route::resource('playlists', 'PlaylistController')->except(['create', 'edit']);
    Route::delete('playlists/{idPlaylist}/audio/{idAudio}', 'AudioPlaylistController@destroy');
    Route::put('playlists/{idPlaylist}/audio/{idAudio}', 'AudioPlaylistController@update');
    Route::post('playlists/{idPlaylist}/audio/{idAudio}', 'AudioPlaylistController@store');

    Route::get('/glossary/{letter?}', 'GlossaryController@show')->name('glossary');

    Route::get('panel', 'PanelController@index')->name('panel');

    Route::resource('users', 'UserController')->except(['create', 'edit']);

    Route::resource('planoaula', 'PlanoAulaController')->only('show');

    Route::resource('cursos', 'CursoController')->only('show');

  });

});

/*

// Badges
Route::prefix('badges')->group(function () {

// http://localhost:8000/api/jpiaget/badges/usuario/1/19/desbloquear
Route::get('usuario/{idUsuario}/{idBadge}/desbloquear', 'Badges\Api\BadgesController@desbloquearUsuarioBadge');

// http://localhost:8000/api/jpiaget/badges/19/desbloquear
Route::get('{idBadge}/desbloquear', 'Badges\Api\BadgesController@desbloquearUsuarioAuthBadge');

});

// Métricas
Route::prefix('metricas')->group(function () {

// http://localhost:8000/api/jpiaget/metricas/nova
Route::post('nova', 'Metricas\Api\MetricasController@nova');

});

// Habilidades
Route::prefix('habilidades')->group(function () {

// http://localhost:8000/api/jpiaget/habilidades/usuario/1/2
Route::post('usuario/{idUsuario}/{idHabilidade}', 'Habilidades\Api\HabilidadesController@UsuarioHabilidade');

// http://localhost:8000/api/jpiaget/habilidades/2
Route::post('{idHabilidade}', 'Habilidades\Api\HabilidadesController@UsuarioAuthHabilidade');
});

// Gamificação
Route::prefix('gamificacao')->group(function () {
Route::post('usuario/{idUsuario}/incrementar', 'GamificacaoUsuario\Api\GamificacaoUsuarioController@incrementar')->name('gamificacao.incrementar');
});

 */
