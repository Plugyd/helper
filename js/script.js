$(document).on('click', '.search', function () {
    
    event.preventDefault();
    error = 0;

    var query = $('#autocomplete').val();

    $.ajax({
        url: '/ajax/find.php',
        type: 'POST',
        dataType: 'HTML',
        data: {
            query: query,
            start: 0,
            limit: 25
        },
        success: Success,
        beforeSend: Before
    });

    function Success(data) {
     

        console.log(data);
    }

    function Before() {
    console.log(query);
    }



});


var availableTags = [
    "ActionScript",
    "AppleScript",
    "Asp",
    "BASIC",
    "C",
    "C++",
    "Clojure",
    "COBOL",
    "ColdFusion",
    "Erlang",
    "Fortran",
    "Groovy",
    "Haskell",
    "Java",
    "JavaScript",
    "Lisp",
    "Perl",
    "PHP",
    "Python",
    "Ruby",
    "Scala",
    "Scheme"
];

$("#autocomplete").autocomplete({
    source: availableTags
});

$(".listing").dblclick(function () {




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

// $(".open").on('click', function () {
//     $(this).toggleClass("opens")
//     if ($(this).hasClass('opens')) {
//         $(this).parent().css({
//             "height": "500px"
//         });
//     } else {
//         $(this).parent().css({
//             "height": "auto"
//         });
//     }


// });