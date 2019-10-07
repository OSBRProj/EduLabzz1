<div class="modal fade" id="divModalAtualizaIcon_{{$badge->id}}" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal text-center px-1 px-md-5" role="document">
    <div class="modal-content">
      <div class="modal-body">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>

        <h4 class="mb-5 text-primary">Badge {{ $badge->titulo }}</h4>

        <form action="{{ route('gestao.badges.atualizar.icone', $badge->id) }}" method="post"
              enctype="multipart/form-data">
          @csrf
          <input type="hidden" name="oldIcon" value="{{ $badge->icone }}">

          <div class="form-group">
            @if($badge->icone == null)
              <small>Nenhum ícone configurado para esta badge</small>
            @else
              <img src="{{ asset('uploads/badges/capas/'.$badge->icone) }}" width="200"
                   class="img-thumbnail">
            @endif
          </div>

          <div class="form-group text-left text-primary">
            <label for="icone">Alterar ícone</label>
            <input type="file" class="form-control" name="icone" required>
          </div>

          <div class="row">
            <button type="button" data-dismiss="modal"
                    class="btn btn-lg btn-block outline-button mt-4 mb-0 col-4 ml-auto mr-4 font-weight-bold">
              Cancelar
            </button>
            <button type="submit"
                    class="btn btn-lg bg-primary btn-block signin-button mt-4 mb-0 col-4 ml-4 mr-auto text-white font-weight-bold">
              Atualizar
            </button>
          </div>

        </form>

      </div>

    </div>
  </div>
</div>