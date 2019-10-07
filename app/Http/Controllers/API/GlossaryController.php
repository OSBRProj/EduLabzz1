<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Entities\Glossario\Repository;

class GlossaryController extends Controller
{
  protected $repository;

  public function __construct(Repository $repository) {
    $this->repository = $repository;
  }

  public function show($letter = "A")
  {
    if (strlen($letter) == 1) {
        $glossarios = $this->repository->all($letter);
    } else {
        $glossarios = $this->repository->search($letter);
    }

    return response()->json(["data" => $glossarios]);

  }
}
