"use strict";

//console.log("App url: " + appurl);

function proximoModal(element)
{
    var qtPaginas = $(element).find('.form-page').length;
    // console.log(qtPaginas);

    if(qtPaginas > 1)
    {
        var idPaginaAtual = $(element).find('.form-page:not(.d-none)').attr('id');
        // console.log(idPaginaAtual);

        var paginaAtual = $(element).find('.form-page:not(.d-none)').attr('id').replace("page","");
        // console.log(paginaAtual);

        var preenchido = true;

        $(element).find('#page' + paginaAtual + ' :input[required]').each(function() {
            if( $(this).val() == "")
            {
                $(this).focus();
                preenchido = false;
                return false;
            }
        });

        if(!preenchido)
        {
            console.log("Preencha tudo nesta pagina!");

            swal('Atenção!', "Você deve preencher todos os campos obrigatórios!", "warning");

            return;
        }

        if( $(element).find("#page" + (Number(paginaAtual) + 1)).length >= 1 )
        {
            $(element).find("#" + idPaginaAtual).addClass("d-none");
            $(element).find("#page" + (Number(paginaAtual) + 1)).removeClass("d-none");
        }
        else
        {
            console.log("Não há próxima página. (" + (Number(paginaAtual) + 1) + ")");
        }
    }
    else
    {
        console.log("Sem páginas");
    }
}

function anteriorModal(element)
{
    var qtPaginas = $(element).find('.form-page').length;
    // console.log(qtPaginas);

    if(qtPaginas > 1)
    {
        var idPaginaAtual = $(element).find('.form-page:not(.d-none)').attr('id');
        // console.log(idPaginaAtual);

        var paginaAtual = $(element).find('.form-page:not(.d-none)').attr('id').replace("page","");
        // console.log(paginaAtual);

        if( $(element).find("#page" + (Number(paginaAtual) - 1)).length >= 1 )
        {
            $(element).find("#" + idPaginaAtual).addClass("d-none");
            $(element).find("#page" + (Number(paginaAtual) - 1)).removeClass("d-none");
        }
        else
        {
            console.log("Não há página anterior. (" + (Number(paginaAtual) - 1) + ")");
        }
    }
    else
    {
        console.log("Sem páginas");
    }
}

//Multiple items inputs
function showInputMultiple(element)
{
    $(element).addClass('d-none');
    $(element.parentNode).find("#txtInputMultiple").removeClass('d-none');
    $(element.parentNode).find("#txtInputMultiple").focus();

    // $("#" + element.parentNode.id + " > #divInputAutor").addClass('d-none');
    // $("#" + element.parentNode.id + " > #txtInputAutor").removeClass('d-none');

    // $("#" + element.parentNode.id + " > #txtInputAutor").focus();
}

function endInputMultiple(element)
{
    $(element).addClass('d-none');
    $(element.parentNode).find("#divInputMultiple").removeClass('d-none');

    var inputValue = element.value;

    if(inputValue.indexOf(",") > 0)
    {
        var valores = inputValue.split(', ');

        valores.forEach(val =>
        {
            if(val.indexOf(", ") > 0)
                val = val.replace(", ", "");
            else
                val = val.replace(",", "");

            var novoValor = '<span class="tag-autor mr-2 p-1 px-3">'+
            '<span class="autor-name">' + val + '</span>'+
            '<button type="button" onclick="removerValor(this)" class="btn p-0 m-0 ml-1 text-white bg-transparent"><i class="far fa-times-circle"></i></button>'+
            '</span>';

            $(element.parentNode).find("#divInputMultiple").append( novoValor );
        });
    }
    else
    {
        var novoValor = '<span class="tag-autor mr-2 p-1 px-3">'+
        '<span class="autor-name">' + element.value + '</span>'+
        '<button type="button" onclick="removerValor(this)" class="btn p-0 m-0 ml-1 text-white bg-transparent"><i class="far fa-times-circle"></i></button>'+
        '</span>';

        $(element.parentNode).find("#divInputMultiple").append( novoValor );
    }

    element.value = "";

    AtualizarInputMultiple(element.parentNode);
}

function removerValor(element)
{
    var divMain = element.parentNode.parentNode.parentNode;

    if($(divMain).first().find(".autor-name").length == 1)
    {
        $(divMain).find("#divInputMultiple").addClass('d-none');
        $(divMain).find("#txtInputMultiple").removeClass('d-none');
    }

    $(element.parentNode).remove();

    AtualizarInputMultiple(divMain);

    if (!e) var e = window.event;
    e.cancelBubble = true;
    if (e.stopPropagation) e.stopPropagation();
}

function AtualizarInputMultiple(element)
{
    if($(element).find("#txtResultMultiple").length >= 1)
    {
        $(element).find("#txtResultMultiple").val("");

        var valores = [];

        $(element).find("#divInputMultiple .autor-name").each(function()
        {
            valores.push( $( this ).text() );
        });

        $(element).find("#txtResultMultiple").val( JSON.stringify(valores) )

        console.log($(element).find("#txtResultMultiple").val());

        console.log("Não sumario");
    }
    else if($(element.parentNode.parentNode.parentNode).find("#txtResultSumario").length >= 1 )
    {
        console.log("É sumario");

        var divItensSumario = element.parentNode.parentNode.parentNode;

        $(divItensSumario).find("#txtResultSumario").val();

        var sumario = [];

        $(divItensSumario).find(".item-sumario").each(function(index)
        {
            var autores = [];

            $(this).find(".autores .input-autor .autor-name").each(function(index2)
            {
                autores.push($(this).text());
            });

            var palavras = [];

            $(this).find(".palavras .input-autor .autor-name").each(function(index2)
            {
                palavras.push($(this).text());
            });

            sumario.push({ 'titulo' : $(this).find("#txtTituloItemSumario").val(),
                'autores' : autores,
                'palavras' : palavras,
                'pagina' : $(this).find("#txtPaginaItemSumario").val()
            });
        });

        console.log("Itens do sumário: ", sumario);

        $(divItensSumario).find("#txtResultSumario").val( JSON.stringify(sumario) );

        // console.log( $(divItensSumario).find("#txtResultSumario").val() );
    }

}


function confirmLogout()
{
    swal({
        title: "Saindo",
        text: "Deseja sair da plataforma?",
        icon: "warning",
        buttons: ["Não", "Sim"],
        dangerMode: true,
    })
    .then((willLogout) =>
    {
        if (willLogout)
        {
            if(document.getElementById("logout-form") != null)
            {
                document.getElementById("logout-form").submit();
            }
            else
            {
                console.error('Error: logout-form not found!');
            }
        }
    });
}

function mudouArquivoCapa(input)
{
    // if(input.value.substring(input.value.length - 4).toLowerCase() != ".pdf")
    if(input.accept.toString().indexOf(input.value.substring(input.value.length - 3).toLowerCase()) < 0)
    {
        input.value = null;
        swal('Atenção!', "Selecione um arquivo do tipo correto!", "warning");
    }

    var imgIcon = "";

    if(input.id.indexOf("capa") >= 0)
    {
        imgIcon = '<i class="far fa-image fa-2x text-darkmode mr-2" style="vertical-align:sub;"></i>';
    }

    if(input.value != null && input.value != "")
    {
        $("#" + input.parentNode.id + " #placeholder").addClass('d-none');
        $("#" + input.parentNode.id + " #file-name").html( imgIcon + input.value.split(/(\\|\/)/g).pop() );
        $("#" + input.parentNode.id + " #file-name").removeClass('d-none');
    }
    else
    {
        $(input.parentNode).css('background', '#207adc');
        $("#" + input.parentNode.id + " #placeholder").removeClass('d-none');
        $("#" + input.parentNode.id + " #file-name").addClass('d-none');
    }

    if(input.id.indexOf("capa") >= 0)
    {
        if (input.files &&input.files[0])
        {
            var reader = new FileReader();

            reader.onload = function(e)
            {
                $(input.parentNode).attr('style', 'color:white; background: url(\'' + e.target.result + '\');background-size: contain;background-position: 50% 50%;background-repeat: no-repeat;');
            }

            reader.readAsDataURL(input.files[0]);
        }
    }
}

function mudouArquivoInput(input)
{
    // if(input.accept.toString().indexOf(input.value.substring(input.value.length - 3).toLowerCase()) < 0)
    // {
    //     input.value = null;
    //     swal("Ops!", "Selecione um arquivo do tipo correto!", "warning");
    // }

    if(input.value != null && input.value != "")
    {
        $(input.parentNode).find('.file-name').text( input.value.split(/(\\|\/)/g).pop() );
    }
    else
    {
        $(input.parentNode).find('.file-name').text( "Selecionar arquivo" );
    }
}

function enviouArquivo(input)
{
    if(input.accept.toString().indexOf(input.value.substring(input.value.length - 3).toLowerCase()) < 0)
    {
        input.value = null;
        swal("Ops!", "Selecione um arquivo do tipo correto!", "warning");
    }

    if(input.value != null && input.value != "")
    {
        $(input.parentNode).find('#placeholder').addClass('d-none');
        $(input.parentNode).find('.file-name').removeClass('d-none');
        $(input.parentNode).find('.file-name').text( input.value.split(/(\\|\/)/g).pop() );
    }
    else
    {
        $(input.parentNode).find('.file-name').addClass('d-none');
        $(input.parentNode).find('#placeholder').removeClass('d-none');
    }
}

function excluirNotificacao(id)
{
    $.ajax({
        url: appurl + '/notificacao/' + id + '/excluir',
        type : 'get',
        dataType: 'json',
        success : function(_response) {

                console.log(_response);

                if(_response.success != null)
                {
                    if(id == "todas")
                    {
                        $(".box-notificacao").remove();
                    }
                    else
                    {
                        $("#divNotificacao" + id).remove();
                    }

                    if(parseInt($("#lblQtNotificacoes").text()) > 1)
                    {
                        $("#lblQtNotificacoes").text((parseInt($("#lblQtNotificacoes").text()) - 1));
                    }
                    else
                    {
                        $("#lblQtNotificacoes").addClass('d-none');
                    }

                    if($("#divNotificacoes .dropdown-item").length == 0)
                    {
                        $("#divNotificacoes").append(`<div class="dropdown-item px-4 py-3" style="color: #60748A;min-width:  340px;border-bottom:  2px solid #E3E5F0;">
                            Você não possui notificações.
                        </div>`);
                    }
                }
        },
        error : (err) =>
        {
            console.log(err);
        }
    });
}

function toggleSideMenu()
{
    // if($("#divSideMenu").length > 0)
    // {
    //     console.log($("#divSideMenu").css("width"));
    //     if($("#divSideMenu").css("margin-left") != "0px")
    //     {
    //         $("#divMainMenu").css("max-width", "calc(100% - " + $("#divSideMenu").css("width") + ")");
    //         setTimeout(() => {
    //             $("#divSideMenu").css("margin-left", "0px");
    //         }, 100);
    //     }
    //     else
    //     {
    //         $("#divSideMenu").css("margin-left", "-" + $("#divSideMenu").css("width"));
    //         setTimeout(() => {
    //             $("#divMainMenu").css("max-width", "100%");
    //         }, 100);
    //     }
    // }

    if($(".sidebar").hasClass("show"))
    {
        $(".sidebar").removeClass("show");
    }
    else
    {
        $(".sidebar").addClass("show");
    }
}

function mostrarBarraPesquisa()
{
    if($(".navbar #txtPesquisaPrincipal").hasClass('d-none'))
    {
        $(".navbar #txtPesquisaPrincipal").removeClass('d-none');
    }
    else
    {
        $(".navbar #txtPesquisaPrincipal").addClass('d-none');

        $(".navbar #formPesquisar").submit();
    }
}

function findValueWhere(_array, _match, _needle)
{
    // iterate over each element in the array
    for (var i = 0; i < _array.length; i++)
    {
        if (_array[i][_match] == _needle)
        {
            return _array[i];
        }
    }
}

function showCodigoAula()
{
    if(!$(".sidebar").hasClass('show'))
    {
        toggleSideMenu();
    }

    $(".sidebar #lblInserirCodigoAula").addClass('d-none');

    $(".sidebar #formInserirCodigoAula").removeClass('d-none');

    $(".sidebar [name='codigo']").focus();
}
