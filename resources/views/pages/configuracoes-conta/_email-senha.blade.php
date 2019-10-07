<div class="tab-pane fade show active" id="conta" role="tabpanel"
     aria-labelledby="v-pills-home-tab">

    <h5 class="mb-4 font-weight-bold" style="color: #60748A;">
        Trocar endereço de e-mail
    </h5>

    <form id="formTrocarEmail" action="{{ route('configuracao.trocar-email') }}"
          method="post" class="mb-5">
        @csrf
        <div class="input-group mb-4">
            <input type="email" name="email" value="{{ $user->email }}"
                   class="form-control bg-lightgray px-5 py-3 border-0 rounded-10"
                   placeholder="E-mail"
                   required onchange="alterouEmail()">
        </div>
        <button type="submit" onclick="window.onbeforeunload = null;"
                id="btnSalvarAlteracoesEmail"
                class="btn bg-primary border-0 rounded-10 font-weight-bold text-white btn-block px-5 py-3 mb-2 d-none">
            Salvar alterações
        </button>
    </form>


    <form id="formTrocarSenha" action="{{ route('configuracao.trocar-senha') }}"
          method="post" class="mb-2">
        @csrf

        <h5 class="my-4 font-weight-bold" style="color: #60748A">
            Alterar senha
        </h5>

        <div class="input-group mb-4">
            <input type="password" name="senha_atual" id="txtSenhaAntiga" value
                   class="form-control border-0 bg-lightgray rounded-10 px-5 py-3"
                   placeholder="Senha atual" required>
        </div>

        <div class="input-group mb-4">
            <input type="password" name="senha_nova" id="txtNovaSenha" value
                   class="form-control border-0 bg-lightgray rounded-10 px-5 py-3"
                   placeholder="Nova senha" required>
        </div>

        <div class="input-group mb-4">
            <input type="password" name="senha_confirmacao" id="txtConfirmarSenha" value
                   class="form-control border-0 bg-lightgray rounded-10 px-5 py-3"
                   placeholder="Confirmar nova senha" required>
        </div>

        <button type="button" onclick="salvarSenha();"
                class="btn bg-primary border-0 rounded-10 text-white font-weight-bold btn-block px-5 py-3">
            Salvar alterações
        </button>

    </form>

</div>
