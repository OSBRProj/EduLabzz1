<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;

use Illuminate\Support\Facades\Storage;

use Auth;
use Redirect;
use Session;
use Carbon\Carbon;

use App\User;
use App\Notificacao;

class NotificacaoController extends Controller
{
    public function excluirNotificacao($notificaca_id)
    {
        if($notificaca_id == "todas")
        {
            Notificacao::where([['user_id', '=', Auth::user()->id]])->delete();

            return response()->json(['success' => 'Notificações excluídas com sucesso!']);
        }
        else if(Notificacao::where([['user_id', '=', Auth::user()->id], ['id', '=', $notificaca_id]])->first() != null)
        {
            Notificacao::where([['user_id', '=', Auth::user()->id], ['id', '=', $notificaca_id]])->delete();

            return response()->json(['success' => 'Notificação excluída com sucesso!']);
        }
        else
        {
            return response()->json(['error' => 'Notificação não encontrada!']);
        }

    }
}


