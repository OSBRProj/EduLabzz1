window.enviarRoteiro = function () {
    $("#formNovoRoteiro #divLoading").addClass("d-none");
    $("#formNovoRoteiro #divEditar").addClass("d-none");

    $("#formNovoRoteiro #divEnviando").removeClass("d-none");
}

window.atualizarRoteiro = function () {
    $("#formEditRoteiro #divLoading").addClass("d-none");
    $("#formEditRoteiro #divEditar").addClass("d-none");

    $("#formEditRoteiro #divEnviando").removeClass("d-none");
}
