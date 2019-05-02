autosize(document.getElementsByClassName('autosizes'));

function find(word) {

    if (word === undefined) {
        var query = $('#autocomplete').val();
    } else {
        var query = word;
    }

    $('.replace-word').html("Возможно вы искали: <span class='find_replace'>" + Auto(query) + "</span>");

    $.ajax({
        url: '/ajax/find.php',
        type: 'POST',
        dataType: 'HTML',
        data: {
            query: query,
            start: 0,
            limit: 50
        },
        success: Success,
        beforeSend: Before
    });

    function Success(data) {
        $('.help_main_result').html(data);
        Prism.highlightAll();
        autosize(document.getElementsByClassName('autosizes'));
    }

    function Before() {
        $('.help_main_result').html('<p class="load">Загрузка...<p>')
    }
}

function message(text){
    $('.msg').fadeIn(500);
    $('.msg').text(text);

    setTimeout(function() {
        $('.msg').fadeOut(1000);
    }, 2000);
   
}

function CopyToClipboard(el) {
    $(el).select();
    var code = $(el).attr('code');
    console.log(code);
    
    document.execCommand("copy");
    message("Код №"+code+" скопирован.");
}

$(document).on('click', '.search', function () {
    find();
});


$('#up').click(function() {
    $('html, body').animate({scrollTop: 0},500);
    return false;
  })


$(document).on('click', '.find_replace', function () {
    var rword = $(".find_replace").text();
    $("#autocomplete").val(rword);
    find(rword);
});

$("#autocomplete").autocomplete({
    source: function (request, response) {
        $.ajax({
            type: 'POST',
            dataType: 'json',
            url: '/ajax/findword.php',
            data: {
                maxRows: 20,
                word: request.term
            },
            success: function (data) {
                console.log(data);
                response(data);
            }
        });
    },
    minLength: 3
});
$(document).on('dblclick', '.listing', function () {
    if ($(this).hasClass('opens')) {
        $(".listing").removeClass("opens");
    } else {
        $(".listing").removeClass("opens");
        $(this).addClass("opens");
    }
    var id = $(this).attr('id');
    var target = document.getElementById(id);
    $('html, body').animate({
        scrollTop: $(target).offset().top
    }, 1000);
});

function Auto(str) {
    var search = new Array(
        "й", "ц", "у", "к", "е", "н", "г", "ш", "щ", "з", "х", "ъ",
        "ф", "ы", "в", "а", "п", "р", "о", "л", "д", "ж", "э",
        "я", "ч", "с", "м", "и", "т", "ь", "б", "ю"
    );
    var replace = new Array(
        "q", "w", "e", "r", "t", "y", "u", "i", "o", "p", "\\[", "\\]",
        "a", "s", "d", "f", "g", "h", "j", "k", "l", ";", "'",
        "z", "x", "c", "v", "b", "n", "m", ",", "\\."
    );

    for (var i = 0; i < replace.length; i++) {
        var reg = new RegExp(replace[i], 'mig');
        str = str.replace(reg, function (a) {
            return a == a.toLowerCase() ? search[i] : search[i].toUpperCase();
        })
    }
    return str
}

$('#autocomplete').keydown(function (e) {
    if (e.keyCode === 13) {
        find();
    }
});