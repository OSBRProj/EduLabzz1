<?php

namespace App\Http\Controllers\Badges\Admin;

use App\Entities\Badges\Repository as Badge;
use App\Entities\Users\Repository as User;
use App\Generals\Upload\Upload;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;


class BadgesController extends Controller
{

    private $badge;
    private $user;
    private $upload;

    public function __construct(Badge $badge, User $user, Upload $upload)
    {
        $this->badge = $badge;
        $this->user = $user;
        $this->upload = $upload;
    }

    // listar todas as badges
    public function index()
    {
        $badges = $this->badge->all();
        $alunos = $this->user->getAll('A');
        return view('pages.badges.admin.index', compact('badges', 'alunos'));
    }


    // Gravar uma nova badge
    public function store(Request $request)
    {
        // Faz a validação do campo título como obrigatório.
        $this->validate($request, [
            'titulo' => 'required'
        ]);

        // recupera os valores dos inputs
        $values = $request->all();

        // recupera id do usuário logado que está cadastrando a badge
        $values['user_id'] = Auth::user()->id;

        // verifica se a pessoa fez o envio de um ícone para a badge
        if ($request->file('icone')) {
            $file = $request->file('icone');
            $fileName = $this->upload->makeResize($file, 400, 'badges/capas');
            $values['icone'] = $fileName;
            if ($fileName == false) {
                return \Session::flash('error', 'Não foi possível fazer upload de seu conteúdo!');
            }
        }

        $this->badge->store($values);
        return redirect()->route('gestao.badges.listar')->with('message', 'Badge cadastrada com sucesso!');
    }


    public function update($idBadge, Request $request)
    {
        // Faz a validação do campo título como obrigatório.
        $this->validate($request, [
            'titulo' => 'required'
        ]);
        $this->badge->update($idBadge, $request->all());
        return redirect()->route('gestao.badges.listar')->with('message', 'Badge atualizada com sucesso!');
    }


    // Atualiza o ícone de uma badge
    public function updateIconBadge($idBadge, Request $request)
    {
        // Verifica se já existe um ícone para esta badge, se exitir, deleta a imagem antiga antes de realizar o novo upload
        if ($request->get('oldIcon') !== null) {
            Storage::disk('public_uploads')->delete('badges/capas/' . $request->get('oldIcon'));
        }
        $file = $request->file('icone');
        $fileName = $this->upload->makeResize($file, 400, 'badges/capas');
        if ($fileName == false) {
            return \Session::flash('error', 'Não foi possível fazer upload de seu conteúdo!');
        }
        $this->badge->update($idBadge, ['icone' => $fileName]);
        return redirect()->route('gestao.badges.listar')->with('message', 'Ícone atualizado com sucesso!');
    }


    // Deletar badge selecionada
    public function delete(Request $request)
    {
        // verifica se existe algum ícone relacionada a esta badge
        $badgeIcon = $this->badge->find($request->idBadge)->icone;
        if ($badgeIcon !== null) {
            Storage::disk('public_uploads')->delete('badges/capas/' . $badgeIcon);
        }
        $this->badge->delete($request->idBadge);
        return redirect()->route('gestao.badges.listar')->with('message', 'Badge excluída com sucesso!');
    }

}
