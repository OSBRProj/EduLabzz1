<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;

use App\User;
use App\HelperClass;

use App\Transacao;
use App\ProdutoTransacao;

use Auth;

class FinanceiroController extends Controller
{

    public function index()
    {
        if(Input::get('qt') == null)
            $amount = 10;
        else
            $amount = Input::get('qt');

        $transacoes = Transacao::with('user', 'produtos')->orderBy('created_at', 'desc')->get();        
        
        foreach ($transacoes as $transacao)
        {
            switch ($transacao->status)
            {
                case 2:
                $transacao->status_name = "Processando pagamento";
                break;
                case 3:
                $transacao->status_name = "Paga";
                break;
                case 4:
                $transacao->status_name = "Concluída";
                break;
                case 5:
                $transacao->status_name = "Em disputa";
                break;
                case 6:
                $transacao->status_name = "Devolvida";
                break;
                case 7:
                $transacao->status_name = "Cancelada";
                break;
                case 8:
                $transacao->status_name = "Debitado";
                break;
                case 9:
                $transacao->status_name = "Retenção temporária";
                break;
                
                default:
                $transacao->status_name = "Aguardando pagamento";
                break;
            }
        }

        $saldoReceber = Transacao::where('status', '<', 3)->sum('total');
        $saldoDisponivel = Transacao::where('status', '=', 3)->orWhere('status', '=', 4)->sum('total');
        $totalFaturado = Transacao::where('status', '<', 5)->sum('total');

        return view('dashboard.financeiro')->with(compact('amount', 'transacoes', 'saldoReceber', 'saldoDisponivel','totalFaturado'));

    }
}
