window.excluirAudioInteracao = function (id) {
    if ($("#formExcluirAudioInteracao" + id).length == 0)
        return;

    swal({
        title: 'Excluir interação?',
        text: "Você deseja mesmo excluir esta interação? Todo seu conteúdo será apagado!",
        icon: "warning",
        buttons: ['Não', 'Sim, excluir!'],
        dangerMode: true,
    }).then((result) => {
        if (result == true) {
            $("#formExcluirAudioInteracao" + id).submit();
        }
    });
}    

/*
function readableDuration(seconds) {
    sec = Math.floor( seconds );    
    min = Math.floor( sec / 60 );
    min = min >= 10 ? min : '0' + min;    
    sec = Math.floor( sec % 60 );
    sec = sec >= 10 ? sec : '0' + sec;    

    return min + ':' + sec;
}
*/

function formatTime(seconds) {
    return [
        parseInt(seconds / 60 / 60),
        parseInt(seconds / 60 % 60),
        parseInt(seconds % 60)
    ]
        .join(":")
        .replace(/\b(\d)\b/g, "0$1")
}   

function hmsToSecondsOnly(str) {
    var p = str.split(':'),
        s = 0, m = 1;

    while (p.length > 0) {
        s += m * parseInt(p.pop(), 10);
        m *= 60;
    }

    return s;
}  

if($('.container-seekbar').length) {
    var audioplayer = document.createElement("audio");
    audioplayer.src = document.getElementById('audio_url').value;

    audioplayer.onloadedmetadata = function () {
        $('.end-timer-view').text(formatTime(audioplayer.duration));
    }
}

/* SEEKBAR COMPONENT */ 
function createSeekBarComponent(id) { 
    var seekbar = document.createElement('input');
        seekbar.id = id + "_seekbar";
        seekbar.type = 'range';
        seekbar.value = '';
        seekbar.step = 'any';

    $('#'+id).find('.container-seekbar').html(seekbar);

    var audioplayer = document.createElement("audio");
    audioplayer.src = document.getElementById('audio_url').value;

    if($('#'+id).find('.txtTempoAudioInteracao').val()) {
        seekbar.value = hmsToSecondsOnly($('#'+id).find('.txtTempoAudioInteracao').val());      
    }

    audioplayer.addEventListener("canplaythrough", function () {
        //alert('The file is loaded and ready to play!');
    }, false);

    audioplayer.onloadedmetadata = function () {
        seekbar.setAttribute('max', audioplayer.duration);
        $('#' + id).find('.end-timer').text(formatTime(audioplayer.duration));
    }

    seekbar.onchange = function() {
        audioplayer.currentTime = seekbar.value;
    }

    seekbar.oninput = function() {
        audioplayer.currentTime = seekbar.value;
        $('#' + id).find('.txtTempoAudioInteracao').val(formatTime(audioplayer.currentTime));
    }

    audioplayer.ontimeupdate = function() {
        seekbar.value = audioplayer.currentTime;      
    }
}

window.novaInteracaoAudio = function(id) {
    createSeekBarComponent(id);
};

window.editarInteracaoAudio = function(id) {
    createSeekBarComponent(id);
}
/* */