// require('./pages/gestao/turmas/mural')

// require('../../node_modules/@fortawesome/fontawesome-pro/js/all')

// import fontawesome from '../../node_modules/@fortawesome/fontawesome-pro/js/all';

// fontawesome.config = { autoReplaceSvg: false }

// window.FontAwesomeConfig = { autoReplaceSvg: false }

require('./pages/gestao/audios-interacoes/admin/viewAudioInteracoes')
require('./pages/roteiros/admin/indexRoteiros')

console.log("Hello world from app.js!");

$('form').submit(function(){
    $(':submit', this)
      .text('Enviando...').val('Enviando...')
      .attr('disabled', 'disabled');
    return true;
});

window.checarPreenchimento = function (elemento)
{
    var preenchido = true;

    var primeiro = null;

    $(elemento).find(':input[required], :input.required').each(function() {

        if ($(this).val() == "" || $(this).val() == null)
        {
            $(this).addClass('is-invalid');

            $(this).append('<p class="campo-obrigatorio">Campo obrigatório*</p>');

            if (primeiro == null)
            {
                primeiro = this;
            }

            preenchido = false;
        }
        else
        {
            if ($(this).hasClass('is-invalid'))
            {
                $(this).removeClass('is-invalid');
            }

            $(this).find('.campo-obrigatorio').remove();
        }

        if (primeiro != null)
        {
            $(primeiro).focus();
        }
    });

    return preenchido;
}
