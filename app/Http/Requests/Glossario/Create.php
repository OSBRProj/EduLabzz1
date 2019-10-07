<?php

namespace App\Http\Requests\Glossario;

use Illuminate\Foundation\Http\FormRequest;

class Create extends FormRequest
{
  /**
   * Determine if the user is authorized to make this request.
   *
   * @return bool
   */
  public function authorize()
  {
    return true;
  }
  
  /**
   * Get the validation rules that apply to the request.
   *
   * @return array
   */
  public function rules()
  {
    return [
      'word'        => 'required',
      'description' => 'required'
    ];
  }
  
  public function messages()
  {
    return [
      'word.required'        => 'O campo Palavra é obrigatório.',
      'description.required' => 'O campo Descrição é obrigatório.',
    ];
  }
}
