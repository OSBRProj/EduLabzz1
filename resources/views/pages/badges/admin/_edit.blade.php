<div class="modal fade" id="divModalAtualizaBadge_{{$badge->id}}" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal text-center px-1 px-md-5" role="document">
    <div class="modal-content">
      <div class="modal-body">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>

        <h5 class="my-4">Editar badge {{ $badge->titulo }}</h5>

        <form action="{{ route('gestao.badges.atualizar', $badge->id) }}" method="post">
          @csrf

          {{--<div class="form-group">--}}
          {{--<select name="user_id" class="form-control">--}}
          {{--@foreach($alunos as $aluno)--}}
          {{--@if($badge->user_id == $aluno->id)--}}
          {{--<option value="{{ $aluno->id }}" selected>{{ $aluno->name }}</option>--}}
          {{--@else--}}
          {{--<option value="{{ $aluno->id }}">{{ $aluno->name }}</option>--}}
          {{--@endif--}}
          {{--@endforeach--}}
          {{--</select>--}}
          {{--</div>--}}

          <div class="form-group text-left">
            <label for="visibilidade" class="font-weight-bold">Visibilidade da badge</label>
            <select name="visibilidade" class="form-control" required>
              @if($badge->visibilidade == 0)
                <option value="0" selected>Oculta</option>
                <option value="1">Listada</option>
              @else
                <option value="0">Oculta</option>
                <option value="1" selected>Listada</option>
              @endif
            </select>
          </div>

          <div class="form-group">
            <input type="text" name="titulo" value="{{ $badge->titulo }}" class="form-control" placeholder="Título"
                   required>
          </div>

          <div class="form-group">
            <textarea name="descricao" class="form-control" rows="5"
                      placeholder="Descrição">{{ $badge->descricao }}</textarea>
          </div>

          <div class="row">
            <button type="button" data-dismiss="modal"
                    class="btn btn-danger mt-4 mb-0 col-4 ml-auto mr-4 font-weight-bold">
              Cancelar
            </button>
            <button type="submit"
                    class="btn btn-primary mt-4 mb-0 col-4 ml-4 mr-auto text-white font-weight-bold">
              Atualizar
            </button>
          </div>

        </form>

      </div>

    </div>
  </div>
</div>