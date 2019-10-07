@extends('layouts.master')

@section('title', 'J. PIAGET - Glossário')

@section('content')

  <main id="main">

    <div class="container">


      <div class="row">
        <div class="col-12 col-md-11 mx-auto">

        <div class="col-12 title pl-0 mb-4">
            <h2>Glossário</h2>
        </div>

        <form action="{{ route('glossario.search') }}" method="post">
          @csrf
          <div class="input-group input-group-lg mb-4">
            <input type="text" class="form-control shadow-sm" placeholder="Digite o que está procurando."  value="{{ \Request::get('word') }}" name="word" required>
            <div class="input-group-append">
              <button type="submit" class="bg-primary border-0 text-light px-4 shadow-sm"><i class="fas fa-search"></i></button>
            </div>
          </div>
        </form>

        <h5>Glossário</h5>

        <section class="words-container">
          <ul>
            <a href="{{ route('glossario.palavra', 'A') }}">
              <li class="{{ $word =='A' ? 'active' : '' }}">A</li>
            </a>
            <a href="{{ route('glossario.palavra', 'B') }}">
              <li class="{{ $word =='B' ? 'active' : '' }}">B</li>
            </a>
            <a href="{{ route('glossario.palavra', 'C') }}">
              <li class="{{ $word =='C' ? 'active' : '' }}">C</li>
            </a>
            <a href="{{ route('glossario.palavra', 'D') }}">
              <li class="{{ $word =='D' ? 'active' : '' }}">D</li>
            </a>
            <a href="{{ route('glossario.palavra', 'E') }}">
              <li class="{{ $word =='E' ? 'active' : '' }}">E</li>
            </a>
            <a href="{{ route('glossario.palavra', 'F') }}">
              <li class="{{ $word =='F' ? 'active' : '' }}">F</li>
            </a>
            <a href="{{ route('glossario.palavra', 'G') }}">
              <li class="{{ $word =='G' ? 'active' : '' }}">G</li>
            </a>
            <a href="{{ route('glossario.palavra', 'H') }}">
              <li class="{{ $word =='H' ? 'active' : '' }}">H</li>
            </a>
            <a href="{{ route('glossario.palavra', 'I') }}">
              <li class="{{ $word =='I' ? 'active' : '' }}">I</li>
            </a>
            <a href="{{ route('glossario.palavra', 'J') }}">
              <li class="{{ $word =='J' ? 'active' : '' }}">J</li>
            </a>
            <a href="{{ route('glossario.palavra', 'L') }}">
              <li class="{{ $word =='L' ? 'active' : '' }}">L</li>
            </a>
            <a href="{{ route('glossario.palavra', 'M') }}">
              <li class="{{ $word =='M' ? 'active' : '' }}">M</li>
            </a>
            <a href="{{ route('glossario.palavra', 'N') }}">
              <li class="{{ $word =='N' ? 'active' : '' }}">N</li>
            </a>
            <a href="{{ route('glossario.palavra', 'O') }}">
              <li class="{{ $word =='O' ? 'active' : '' }}">O</li>
            </a>
            <a href="{{ route('glossario.palavra', 'P') }}">
              <li class="{{ $word =='P' ? 'active' : '' }}">P</li>
            </a>
            <a href="{{ route('glossario.palavra', 'Q') }}">
              <li class="{{ $word =='Q' ? 'active' : '' }}">Q</li>
            </a>
            <a href="{{ route('glossario.palavra', 'R') }}">
              <li class="{{ $word =='R' ? 'active' : '' }}">R</li>
            </a>
            <a href="{{ route('glossario.palavra', 'S') }}">
              <li class="{{ $word =='S' ? 'active' : '' }}">S</li>
            </a>
            <a href="{{ route('glossario.palavra', 'T') }}">
              <li class="{{ $word =='T' ? 'active' : '' }}">T</li>
            </a>
            <a href="{{ route('glossario.palavra', 'U') }}">
              <li class="{{ $word =='U' ? 'active' : '' }}">U</li>
            </a>
            <a href="{{ route('glossario.palavra', 'V') }}">
              <li class="{{ $word =='V' ? 'active' : '' }}">V</li>
            </a>
            <a href="{{ route('glossario.palavra', 'W') }}">
              <li class="{{ $word =='W' ? 'active' : '' }}">W</li>
            </a>
            <a href="{{ route('glossario.palavra', 'X') }}">
              <li class="{{ $word =='X' ? 'active' : '' }}">X</li>
            </a>
            <a href="{{ route('glossario.palavra', 'Y') }}">
              <li class="{{ $word =='Y' ? 'active' : '' }}">Y</li>
            </a>
            <a href="{{ route('glossario.palavra', 'Z') }}">
              <li class="{{ $word =='Z' ? 'active' : '' }}">Z</li>
            </a>
          </ul>
        </section>

        @if(\Request::has('word'))
          <section>
            <h2 class="title-main">Resultados de busca por: "{{ \Request::get('word') }}"</h2>
          </section>
        @endif

        <section class="words-description-container">
            @forelse($glossarios as $glossario)
            <div class="words-description-box mb-0" style="border-bottom:0!important;">
                    <hr>

                    <h6><strong> {{ ucwords($glossario->word) }} </strong></h6>
                    <p class="description">{{ ucfirst($glossario->description) }}</p>

                    @if($glossario->relacionados != null ? count($glossario->relacionados) > 0 : false)
                            <a class="btn btn-link" data-toggle="collapse" href="#collapseExample" role="button" aria-expanded="false" aria-controls="collapseExample">
                                Ver conteúdo relacionado
                                <i class="fa fa-chevron-down fa-fw" aria-hidden="true"></i>
                            </a>
                        <div class="collapse ml-3" id="collapseExample">
                            <section>
                                <div class="row my-2">
                                    <div class="col-md-6 text-center text-md-left mb-3 mb-md-0">
                                        <h6>
                                            Conteúdo relacionado
                                        </h6>
                                    </div>
                                </div>
                                <div class="py-2">
                                    <div class="row">

                                        @foreach ($glossario->relacionados as $conteudo)
                                            <div class="col-12 col-sm-6 col-md-4 col-lg-3 mb-3">
                                                <div class="card rounded-10 text-decoration-none h-100 border-0">
                                                    <div class="py-3 px-4 h-100">
                                                        <span class="d-block mb-2">
                                                            {{ ucfirst($conteudo->titulo) }}
                                                        </span>
                                                        <span class="d-block font-weight-bold">
                                                            <i class="fas {{ $conteudo->tipo_icon }} fa-fw mr-1"></i>
                                                            {{ ucfirst($conteudo->tipo_nome) }}
                                                        </span>
                                                    </div>
                                                    <div class="py-2 mx-2 ">
                                                        <a href="{{ route('conteudo.play', ['idConteudo' => $conteudo->id]) }}" class="btn btn-primary d-block">
                                                            Acessar
                                                        </a>
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach

                                    </div>
                                </div>
                            </section>
                        </div>
                    @endif

                </div>
            @empty
                <p class="text-secondary">Nenhuma palavra encontrada</p>
            @endforelse
        </section>

        </div>
      </div>


    </div>

  </main>
@endsection
