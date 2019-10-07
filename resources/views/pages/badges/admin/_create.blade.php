<div class="modal fade" id="divModalNovaBadge" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal text-center px-3 px-md-5" role="document">
    <div class="modal-content">
      <div class="modal-body">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>

        <h5 class="my-4">Cadastrar nova badge</h5>

        <form action="{{ route('gestao.badges.cadastrar') }}" method="post" enctype="multipart/form-data">
          @csrf

          {{--<div class="form-group">--}}
          {{--<select name="user_id" class="form-control">--}}
          {{--@foreach($alunos as $aluno)--}}
          {{--<option value="{{ $aluno->id }}">{{ $aluno->name }}</option>--}}
          {{--@endforeach--}}
          {{--</select>--}}
          {{--</div>--}}

          <div class="form-group text-left">
            <label for="icone" class="font-weight-bold">Ícone da badge</label>
            <input type="file" class="form-control" name="icone">
          </div>

          <div class="form-group text-left">
            <label for="visibilidade" class="font-weight-bold">Visibilidade da badge</label>
            <select name="visibilidade" class="form-control" required>
              <option value="0">Oculta</option>
              <option value="1">Listada</option>
            </select>
          </div>

          <div class="form-group">
            <input type="text" name="titulo" value="{{ old('titulo') }}" class="form-control" placeholder="Título"
                   required>
          </div>

          <div class="form-group">
            <textarea name="descricao" class="form-control" rows="5" placeholder="Descrição"></textarea>
          </div>

          <div class="row mb-1">
            <button type="button" data-dismiss="modal"
                    class="btn btn-danger mt-4 mb-0 col-4 ml-auto mr-4 font-weight-bold">
              Cancelar
            </button>
            <button type="submit"
                    class="btn btn-primary mt-4 mb-0 col-4 ml-4 mr-auto text-white font-weight-bold">
              Cadastrar
            </button>
          </div>

        </form>

      </div>

    </div>
  </div>
</div>