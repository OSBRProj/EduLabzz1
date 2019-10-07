<?php

namespace App\Entities\Glossario;

use Illuminate\Database\Eloquent\Model;

class Glossario extends Model
{
  protected $table = "glossarios";
  protected $guarded = ['id'];
}
