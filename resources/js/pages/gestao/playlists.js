window.enviarPlaylist = function () {
    $("#formNovaPlaylist #divLoading").addClass("d-none");
    $("#formNovaPlaylist #divEditar").addClass("d-none");

    $("#formNovaPlaylist #divEnviando").removeClass("d-none");
}

window.atualizarPlaylist = function () {
    $("#formEditarPlaylist #divLoading").addClass("d-none");
    $("#formEditarPlaylist #divEditar").addClass("d-none");

    $("#formEditarPlaylist #divEnviando").removeClass("d-none");
}
