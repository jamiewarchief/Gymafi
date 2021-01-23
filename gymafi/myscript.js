

$(function () {

    console.log('DOM loaded');

    $('.loginbutton').mouseover(function () {
        $(this).attr("src", "/gymafi/img/gymafi_logo_circle_invert.svg");
        // $('.mymenu').slideToggle();
    });
    $('.loginbutton').mouseleave(function () {
        $(this).attr("src", "/gymafi/img/gymafi_logo_circle.svg");
        // $('.mymenu').slideToggle();
    });

    $(window).scroll(function () {
        var threshold = 100; // number of pixels before bottom of page that you want to start fading
        var op = (($(document).height() - $(window).height()) - $(window).scrollTop()) / threshold;
        if (op <= 0) {
            $(".loginbutton").hide();
        } else {
            $(".loginbutton").show();
        }
        $(".loginbutton").css("opacity", op);
    });

    $(window).scroll(function () {
        var threshold = 200; // number of pixels before bottom of page that you want to start fading
        var op = (($(document).height() - $(window).height()) - $(window).scrollTop()) / threshold;
        if (op <= 0) {
            $(".myheader").hide();
            $(".floaty").hide();
        } else {
            $(".myheader").show();
            $(".floaty").show();
        }
        $(".myheader").css("opacity", op);
        $(".floaty").css("opacity", op);
    });

    $(window).scroll(function () {
        var threshold = $(window).height(); // number of pixels before bottom of page that you want to start fading
        var op = (($(document).height() - $(window).height()) - $(window).scrollTop()) / threshold;
        if (op <= 0) {
            $('.mycard').hide();
        } else {
            $('.mycard').show();
        }
        $(".mycard").css("opacity", op);
    });

    $('#exampleModal').on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget) // Button that triggered the modal
        var recipient = button.data('whatever') // Extract info from data-* attributes
        var modal = $(this)
        modal.find('.modal-title').text('New message to ' + recipient)
        modal.find('.modal-body input').val(recipient)
    })

    $(window).resize(function () {

        if ($(window).width() >= 600) {
            // if larger or equal
            $('.navbar-toggler').toggleClass('is-medium');
        } else {
            // if smaller
            $('.navbar-toggler').toggleClass('is-fullwidth');
        }
    }).resize();


    $('.mymenubutton').click(function () {
        $('.mymenu').slideToggle('slow');
    });

});