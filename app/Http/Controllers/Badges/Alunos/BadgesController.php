<?php

namespace App\Http\Controllers\Badges\Alunos;

use App\Badge;
use App\BadgeUsuario;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class BadgesController extends Controller
{
    public function recompensas()
    {
        $badges = Badge::where([['visibilidade', '=', '1']])->get();

        foreach (BadgeUsuario::with('badge')->whereHas('badge')->where('user_id', '=', Auth::user()->id)->get() as $minha)
        {

            $tem_badge = $badges->contains(function ($value, $key) use ($minha) {
                if($minha->badge != null)
                {
                    return $value->id == $minha->badge->id;
                }
                else
                {
                    return null;
                }
            });

            if ($tem_badge)
            {
                $badges->first(function ($value, $key) use ($minha) {
                    return $value->id == $minha->badge->id;
                })->desbloqueada = true;
            }
            else
            {
                $minha = $minha->badge;
                $minha->desbloqueada = true;
                $badges->push($minha);
            }
        }

        return view('pages.badges.alunos.recompensas')->with(compact('badges'));
    }


    public function desafios()
    {
        return view('pages.badges.alunos.desafios-concluidos');
    }


    public function conquistas()
    {
        $badges = Badge::where([['visibilidade', '=', '1']])->get();

        foreach (BadgeUsuario::with('badge')->whereHas('badge')->where('user_id', '=', Auth::user()->id)->get() as $minha) {
            if ($badges->contains(function ($value, $key) use ($minha) {
                return $value->id == $minha->badge->id;
            })) {
                $badges->first(function ($value, $key) use ($minha) {
                    return $value->id == $minha->badge->id;
                })->desbloqueada = true;
            } else {
                $minha = $minha->badge;
                $minha->desbloqueada = true;
                $badges->push($minha);
            }
        }

        return view('pages.badges.alunos.conquistas')->with(compact('badges'));
    }

}
