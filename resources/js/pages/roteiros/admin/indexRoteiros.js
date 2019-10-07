var countCreateTopico = 0;

$('.bt-adicionar-topico').on('click', function() {

    if($(this).closest('form').find('.checkbox-topico').length) {
        countCreateTopico = $(this).closest('form').find('.checkbox-topico').length ;
    }

    var myHTML = '';
    var myHTML = myHTML + '<div class="container-input">';
    var myHTML = myHTML + ' <input class="form-check-input checkbox-topico" type="checkbox" name="topico['+countCreateTopico+'][status]" value="0" checked>';
    var myHTML = myHTML + ' <input type="text" class="form-control input-topico" name="topico['+countCreateTopico+'][titulo]" placeholder="Tópico" required="">';
    var myHTML = myHTML + ' <button type="button" class="bt-excluir-topico btn btn-light bg-white box-shadow text-declined"><i class="fas fa-trash"></i></button>';
    var myHTML = myHTML + '</div>';

    $(this).closest('form').find('.container-input-topico').append(myHTML);

    var heightTopicos = $(this).closest('form').find('.col-topicos')[0].scrollHeight;
    $('.col-topicos').animate({ scrollTop: heightTopicos }, 500);

    countCreateTopico = (countCreateTopico+1);
});

$('.col-topicos').on('click', '.checkbox-topico', function() {
    if($(this).val() == 1) {
        $(this).val(0);
    } else {
        $(this).val(1);
    }
});

$('.col-topicos').on('click', '.bt-excluir-topico', function() {
    $(this).parent().remove();
});

$('.lb-percent').each(function() {
    $(this).next().children().css('width', $(this).text());
});

window.ajaxUpdateStatusTopico = function(id) {
    var obj = $('#topico_'+id);

    if(obj.val() == 1) {
        obj.val(0);
        var tempCheckboxValue = 0;
    } else {
        obj.val(1);
        var tempCheckboxValue = 1;
    }

    $.ajax({
        headers: { 'X-CSRF-TOKEN': $('input[name="_token"]').val() },
        type: "POST",
        dataType: 'text',
        data: {
            'id': id,
            'status': obj.val()
        },
        url: "roteiros/updateStatusTopico",
        success: function(response) {
            var roteiroID = obj.data('roteiro-id');
            var cardRoteiro = $('#cardRoteiro_' + roteiroID);
            var editModal = $('#divModalEditRoteiro_' + roteiroID);
            var viewModal = $('#divModalViewRoteiro_' + roteiroID);

            var topicosAtivos = viewModal.find('input:checkbox:checked').length;
            var totalTopicos = viewModal.find('input:checkbox').length;
            var topicosInativos = viewModal.find('input:checkbox:not(":checked")').length;

            console.log('topicosAtivos: ' + topicosAtivos);
            console.log('totalTopicos: ' + totalTopicos);
            console.log('topicosInativos: ' + topicosInativos);

            if(topicosInativos == totalTopicos) {
                topicosInativos = 0;
            }

            if(topicosAtivos == 0) {
                //0%
                viewModal.find('.fill-percent-bg').css('width', '0%');
                var resultPorcentagemTopicos = '0';
            }

            if( (topicosAtivos > 0 && topicosInativos > 0) && (topicosAtivos == topicosInativos) ) {
                //50%
                viewModal.find('.fill-percent-bg').css('width', '50%');
                var resultPorcentagemTopicos = '50';
            }

            if(topicosAtivos > 0 && topicosInativos == 0) {
                //100%
                viewModal.find('.fill-percent-bg').css('width', '100%');
                var resultPorcentagemTopicos = '100';
            }

            if(topicosAtivos > 0 && topicosInativos > 0) {
                if(topicosAtivos !== topicosInativos) {
                    var ta = topicosAtivos;
                    var ti = topicosInativos;
                    var totalTopicos = ta + ti;
                    var vp = (ta * 100) / totalTopicos;
                    var resultPorcentagemTopicos = Math.ceil(vp);
                }
            }

            viewModal.find('.fill-percent-bg').css('width', resultPorcentagemTopicos + '%');
            viewModal.find('.lb-percent').text(resultPorcentagemTopicos + '%');

            cardRoteiro.find('.fill-percent-bg').css('width', resultPorcentagemTopicos + '%');
            cardRoteiro.find('.lb-percent').text(resultPorcentagemTopicos + '%');

            editModal.find('#topico_edit_'+id).val(tempCheckboxValue);
        }
    });
}

window.excluirRoteiro = function(id) {
    if ($("#formExcluirRoteiro" + id).length == 0)
        return;

    swal({
        title: 'Excluir roteiro?',
        text: "Você deseja mesmo excluir este roteiro? Todo seu conteúdo será apagado!",
        icon: "warning",
        buttons: ['Não', 'Sim, excluir!'],
        dangerMode: true,
    }).then((result) => {
        if (result == true) {
            $("#formExcluirRoteiro" + id).submit();
        }
    });
}
