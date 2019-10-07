<style>
    .profile {
        /* margin: 100px auto 0; */
    }

    .profile-menu {
        margin: 20px auto;
    }

    .profile-menu > hr {
        width: 100%;
        margin: 0 auto;
    }

    .title-menu {
        margin: 0 25px;
        color: #0D1033;
        font-size: 20px;
    }

    .title-menu-active {
        margin: 0 25px;
        color: #207adc;
        font-size: 20px;
        padding-bottom: 10px;
        border-bottom: 4px solid #207adc;
    }

    .title-menu:hover {
        color: #207adc;
        font-size: 20px;
        padding-bottom: 10px;
        border-bottom: 4px solid #207adc;
    }

    .input-search > input {
        border: 2px solid #207adc;
        border-top-left-radius: 10px;
        border-bottom-left-radius: 10px;
        border-right: 0;
        padding: 5px 15px;
        background: transparent;
    }

    .input-search > input::placeholder {
        color: #207adc;
        font-weight: bold;
    }

    .input-search > button {
        border: 2px solid #207adc;
        border-top-right-radius: 10px;
        border-bottom-right-radius: 10px;
        border-left: 0;
        background: transparent;
        padding: 5px 10px;
        color: #207adc;
    }

</style>

<div class="row justify-content-center">
    <div class="px-0">

        <section class="profile">
            <div class="profile-menu mb-4">
                <div class="d-flex justify-content-center">
                    <a href="{{ route('perfil.recompensas') }}"
                       class="{{ (\Request::is('perfil/recompensas') ? 'title-menu-active' : 'title-menu') }}">
                        Recompensas
                    </a>
                    <a href="{{ route('perfil.desafios') }}"
                       class="{{ (\Request::is('perfil/desafios-concluidos') ? 'title-menu-active' : 'title-menu') }}">
                        Desafios concluídos
                    </a>
                    <a href="{{ route('perfil.conquistas') }}"
                       class="{{ (\Request::is('perfil/conquistas') ? 'title-menu-active' : 'title-menu') }}">
                        Conquistas
                    </a>
                </div>
            </div>

        </section>

    </div>
</div>
