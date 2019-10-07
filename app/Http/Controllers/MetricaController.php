<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;

use Illuminate\Support\Facades\Storage;

use Auth;
use Redirect;
use Session;
use Carbon\Carbon;

use App\Escola;
use App\User;
use App\Turma;
use App\AlunoTurma;
use App\Metrica;

class MetricaController extends Controller
{
    public function getMetricas()
    {
        $metricas = Metrica::query();

        // $metricas->when( Auth::user()->permissao == "Z", function ($q) {
        //     return $q->where('likes', '>', request('likes_amount', 0));
        // });

        $metricas->when( Auth::user()->permissao == "G" || Auth::user()->permissao == "P", function ($q) {
            return $q->whereHas('user', function ($q) {
                $q->where('escola_id', Auth::user()->escola_id);
            });
        });

        $metricas = $metricas->pluck('titulo')->unique();


        return response()->json(["success" => "Métricas listadas com sucesso.", "metricas" => $metricas]);
    }

    public function getMetrica($titulo, Request $request)
    {
        $request->metrica = $titulo;

        if($request->metrica == null || $request->metrica == "")
        {
            return response()->json(["error" => "Métrica não especificada."]);
        }

        if(Metrica::where([['titulo', $request->metrica]])->exists() == false)
        {
            return response()->json(["error" => "Métrica não encontrada."]);
        }

        // $request->startDateRange = "2018";
        // $request->endDateRange = "2018-11-30";

        if($request->startDateRange != null && $request->startDateRange != "")
        {
            if($this->validateDate($request->startDateRange, "Y") == false && $this->validateDate($request->startDateRange, "Y-m") == false && $this->validateDate($request->startDateRange, "Y-m-d") == false)
            {
                unset($request->startDateRange);
            }
        }
        if($request->endDateRange != null && $request->endDateRange != "")
        {
            if($this->validateDate($request->endDateRange, "Y") == false && $this->validateDate($request->endDateRange, "Y-m") == false && $this->validateDate($request->endDateRange, "Y-m-d") == false)
            {
                unset($request->endDateRange);
            }
        }

        $metrica = Metrica::query();

        $metrica = $metrica->where('titulo', '=', $request->metrica);

        $metrica->when( isset($request->startDateRange), function ($q) use ($request) {
            return $q->where([['created_at', '>=', $request->startDateRange]]);
        });

        $metrica->when( isset($request->endDateRange), function ($q) use ($request) {
            return $q->where([['created_at', '<=', $request->endDateRange]]);
        });

        $metrica->when( Auth::user()->permissao == "Z" && ($request->has('escola') ? $request->escola != null : false), function ($q) use ($request) {
            return $q->whereHas('user', function ($q2) use ($request) {
                $q2->where('escola_id', '=', $request->escola);
            });
        });

        $metrica->when( $request->has('turma') ? $request->turma != null : false, function ($q) use ($request) {
            return $q->whereHas('aluno_turma', function ($q2) use ($request) {
                $q2->where('turma_id', '=', $request->turma);
            });
        });

        $metrica->when( $request->has('aluno') ? $request->aluno != null : false, function ($q) use ($request) {
            // echo $request->aluno; die();
            return $q->whereHas('user', function ($q2) use ($request) {
                $q2->where('user_id', '=', $request->aluno);
            });
        });

        $metrica = $metrica->whereHas('user', function ($q) {
            $q->where('escola_id', Auth::user()->escola_id);
        })
        ->orderBy('created_at', 'asc')
        ->get(['created_at'])
        ->groupBy( function ($item) {
            return Carbon::parse($item->created_at)->format('d/m/Y');
        });

        foreach ($metrica as $key => $item)
        {
            $metrica[$key] = count($item);
        }

        return response()->json(["success" => "Métrica listada com sucesso.", "metrica" => $metrica]);
    }

    private function validateDate($date, $format = 'Y-m-d')
    {
        $d = \DateTime::createFromFormat($format, $date);
        // The Y ( 4 digits year ) returns TRUE for any integer with any number of digits so changing the comparison from == to === fixes the issue.
        return $d && $d->format($format) === $date;
    }
}


