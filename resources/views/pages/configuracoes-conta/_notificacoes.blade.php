<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/icheck-material@1.0.0/icheck-material.min.css">
<style>
    .notifications-content {
        min-height: 600px;
        display: flex;
        flex-direction: column;
        justify-content: space-between;
    }

    .notifications-content > form > div > div > span {
        color: #525870;
        font-weight: bold;
    }

    .icheck-material-indigo > input:first-child:checked + label::before, .icheck-material-indigo > input:first-child:checked + input[type="hidden"] + label::before {
        background-color: #207adc;
        border-color: #207adc;
        border-radius: 50%;
        width: 30px;
        height: 30px;
    }

    [class*="icheck-material"] > input:first-child {
        width: 30px;
        height: 30px;
    }

    [class*="icheck-material"] > input:first-child + label::before, [class*="icheck-material"] > input:first-child + input[type="hidden"] + label::before {
        border: 4px solid #B7B7B7;
        border-radius: 50%;
        width: 30px;
        height: 30px;
    }

    [class*="icheck-material"] > label {
        min-height: 30px;
        line-height: 30px;
    }


    [class*="icheck-material"] > input:first-child:not(:checked):not(:disabled):hover + label::before, [class*="icheck-material"] > input:first-child:not(:checked):not(:disabled):hover + input[type="hidden"] + label::before {
        border-width: 4px;
    }

    [class*="icheck-material"] > input[type="checkbox"]:first-child:checked + label::after, [class*="icheck-material"] > input[type="checkbox"]:first-child:checked + input[type="hidden"] + label::after {
        width: 20px;
        height: 20px;
        border-radius: 50%;
        background: #207adc !important;
    }

    [class*="icheck-material"] > input:first-child:checked + label::after, [class*="icheck-material"] > input:first-child:checked + input[type="hidden"] + label::after {
        display: inline-block;
        position: absolute;
        top: 3px;
        left: -2px;
        border: 5px solid #F3F3F3 !important;
    }


</style>

<div class="tab-pane fade" id="notificacoes" role="tabpanel"
     aria-labelledby="v-pills-settings-tab">

    <h5 class="mb-4 font-weight-bold" style="color: #60748A;">
        Notificações por e-mail
    </h5>

    <div class="notifications-content">

        <form action="{{ route('configuracao.notificacoes') }}" , method="post">
            @csrf
            <div>

                <div class="mb-3 bg-lightgray p-3 rounded-10 d-flex justify-content-between align-items-center">
                    <span>Receber notificações quando houver uma resposta do professor</span>
                    <div class="icheck-material-indigo">
                        <input type="checkbox" id="noteRespProf" name="rcb_notif_resp_professor" {{ $user->notificacoes->rcb_notif_resp_professor === true ? 'checked' : '' }} />
                        <label for="noteRespProf"></label>
                    </div>
                </div>
                <div class="mb-3 bg-lightgray p-3 rounded-10 d-flex justify-content-between align-items-center">
                    <span>Receber notificações quando houver uma resposta do aluno</span>
                    <div class="icheck-material-indigo">
                        <input type="checkbox" id="noteRespAluno" name="rcb_notif_resp_aluno" {{ $user->notificacoes->rcb_notif_resp_aluno === true ? 'checked' : '' }} />
                        <label for="noteRespAluno"></label>
                    </div>
                </div>

                <div class="mb-3 bg-lightgray p-3 rounded-10 d-flex justify-content-between align-items-center">
                    <span>Receber notificações</span>
                    <div class="icheck-material-indigo">
                        <input type="checkbox" id="noteRespOther" name="rcb_notif" {{ $user->notificacoes->rcb_notif === true ? 'checked' : '' }} />
                        <label for="noteRespOther"></label>
                    </div>
                </div>

            </div>


            <div>
                <button type="submit"
                        class="btn bg-primary border-0 rounded-10 font-weight-bold text-white btn-block px-5 py-3 mb-2">
                    Salvar alterações
                </button>
            </div>

        </form>

    </div>


</div>
