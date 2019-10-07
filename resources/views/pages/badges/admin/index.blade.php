@extends('layouts.master')

@section('title', 'J. PIAGET - Gestão de conteúdo')

@section('headend')

  <!-- Custom styles for this template -->
  <style>

    header {
      padding: 154px 0 100px;
    }

    @media (min-width: 992px) {
      header {
        padding: 156px 0 100px;
      }
    }

    .card {
      min-height: 120px;
    }

    .icon-thumb {
      display: flex;
      justify-content: center;
      align-items: center;
      width: 100%;
      height: 100%;
      background-color: #191d5a;
      overflow: hidden;
      color: #ffffff;
    }


  </style>

@endsection

@section('content')

  <main role="main">

    <div class="container">

    <div class="px-3 px-md-5 w-100">

      <div class="col-12 mb-3 title pl-0">
          <h2>Gestão de badges</h2>
      </div>

        <div class="row my-3">
          <div class="col-auto text-center text-md-right mb-3 mb-md-0">
            <button type="button" class="btn btn-primary text-white font-weight-normal" data-toggle="modal"
                    data-target="#divModalNovaBadge">
              <i class="fas fa-plus fa-fw mr-2"></i>
              Nova badge
            </button>
          </div>

        </div>

        <section class="row">
          @forelse($badges as $badge)
            <div class="col-lg-6 col-lg-4 mb-4">
              <div class="card rounded shadow-sm border-0 h-100">
                <div class="card-body">
                  <button class="btn btn-link text-gray float-right p-2" type="button" data-toggle="dropdown"
                          aria-haspopup="true" aria-expanded="false">
                    <i class="fas fa-ellipsis-v"></i>
                  </button>
                  <div class="px-3">
                    <div class="dropdown-menu">
                      <button type="button" data-toggle="modal" class="btn btn-link dropdown-item text-primary"
                              data-target="#divModalAtualizaIcon_{{$badge->id}}">
                        <i class="fas fa-image"></i>
                        Administrar ícone
                      </button>
                      <button type="button" data-toggle="modal" class="btn btn-link dropdown-item text-warning"
                              data-target="#divModalAtualizaBadge_{{$badge->id}}">
                        <i class="fas fa-edit"></i>
                        Editar badge
                      </button>
                      <button type="button" onclick="excluirBadge({{ $badge->id }});"
                              class="btn btn-link dropdown-item text-danger" href="#"><i class="fas fa-trash-alt"></i>
                        Excluir badge
                      </button>
                    </div>

                  </div>
                  <div class="row h-100">
                    <div class="col-lg-4">
                      <div class="icon-thumb">
                        @if($badge->icone == null)
                          <i class="far fa-image"></i>
                        @else
                          <img src="{{ asset('uploads/badges/capas/'.$badge->icone) }}" class="img-fluid">
                        @endif
                      </div>
                    </div>
                    <div class="col-lg-8">
                      <h5>{{ $badge->titulo }}</h5>
                      <small> {{ $badge->descricao }}</small>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <!-- Modal atualiza badge -->
            @include('pages.badges.admin._edit')

          <!-- Modal atualiza ícone da badge -->
            @include('pages.badges.admin._icon')
          @empty
            <p class="text-dark">Nenhuma badge cadastrada</p>
          @endforelse
        </section>

        <form id="formExcluirBadge" action="{{ route('gestao.badges.excluir') }}" method="post">@csrf
          <input id="idBadge" name="idBadge" hidden>
        </form>

      </div>

      <!-- Modal nova badge -->
      @include('pages.badges.admin._create')


    </div>

  </main>

@endsection

@section('bodyend')

  <script>
    function excluirBadge(id) {
      $("#formExcluirBadge #idBadge").val(id);

      swal({
        title: 'Excluir badge?',
        text: "Você deseja mesmo excluir esta badge?",
        icon: "warning",
        buttons: ['Não', 'Sim, excluir!'],
        dangerMode: true,
      }).then((result) => {
        if (result == true) {
          $("#formExcluirBadge").submit();
        }
      });
    }
  </script>

@endsection
