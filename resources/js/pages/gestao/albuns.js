window.enviarAlbum = function () {
    $("#formNovoAlbum #divLoading").addClass("d-none");
    $("#formNovoAlbum #divEditar").addClass("d-none");

    $("#formNovoAlbum #divEnviando").removeClass("d-none");
}

window.atualizarAlbum = function () {
    $("#formEditarAlbum #divLoading").addClass("d-none");
    $("#formEditarAlbum #divEditar").addClass("d-none");

    $("#formEditarAlbum #divEnviando").removeClass("d-none");
}
