<div id="divLevelUpPopUp" style="position: fixed;bottom: -500px;left: 0px;background-color: rgba(32, 32, 32, .9);z-index: 999;margin: 30px;padding: 15px 20px;border-radius: 10px;flex-direction: row;display: flex;justify-content: space-evenly;align-items: center; transition: 0.3s all ease-in-out;">

    <div class="d-inline-block" style="border: 5px dashed #008CC9;background-color: #00628D;height: 54px;width: 54px;display: flex !important;justify-content: center;align-items: center;flex-direction: column;border-radius: 100%;color: white;font-weight: bold;font-size: 26px;">
        {{ $new_level }}
    </div>

    <audio controls autoplay hidden>
        <source src="" type="audio/mpeg">
        Your browser does not support the audio element.
    </audio>

    <script>

        $(document).ready( function () {

            setTimeout(() => {

                var audio = new Audio('{{ env('APP_LOCAL') }}/assets/audio/level_up_sound.mp3');
                audio.play();

                $("#divLevelUpPopUp").css('bottom', '0px');

                setTimeout(() => {

                    $("#divLevelUpPopUp").css('bottom', '-500px');

                }, 2500);

                setTimeout(() => {

                    $("#divLevelUpPopUp").remove();

                }, 10000);

            }, 1500);

        });

    </script>

    <h5 class="text-white ml-3 mb-0">
        Novo nível alcançado
        <small class="d-block">
            NÍVEL {{ $new_level }}
        </small>
    </h5>
</div>
