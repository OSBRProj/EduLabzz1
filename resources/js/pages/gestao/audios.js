window.enviarAudio = function () {
    $("#formNovoAudio #divLoading").addClass("d-none");
    $("#formNovoAudio #divEditar").addClass("d-none");

    $("#formNovoAudio #divEnviando").removeClass("d-none");
}

window.atualizarAudio = function () {
    $("#formEditarAudio #divLoading").addClass("d-none");
    $("#formEditarAudio #divEditar").addClass("d-none");

    $("#formEditarAudio #divEnviando").removeClass("d-none");
}
