$(document).ready(function() {
    $('#contactForm').validate({
        rules: {
            name: {
                required: true,
            },
            phone: {
                required: true,
            },
            email: {
                required: true,
                email: true,
            },

        },
        errorPlacement: function(error,element) {
            return true;
        }
    });

    $('#contactForm').submit(function(e) {
        e.preventDefault();
        if ($(this).valid()) {
            $.ajax({
                    type: 'POST',
                    url: 'php/form.php',
                    data: $(this).serialize()
                })
                .done(function() {
                    formSuccess();
                })
                .fail(function() {
                    formError();
                })
        }
        else {
            formError();
        }
    });
});

function formError() {
    $("#contactForm").removeClass().addClass('shake animated').one('webkitAnimationEnd mozAnimationEnd MSAnimationEnd oanimationend animationend', function() {
        $(this).removeClass();
    });
}

function formSuccess() {
    $('#contactForm')[0].reset();
    $('#contactForm').removeClass().addClass('bounceOutDown animated').one('webkitAnimationEnd mozAnimationEnd MSAnimationEnd oanimationend animationend', function() {
        $(this).removeClass();
    });
    setTimeout(function () {
        $('.blur').css({
            visibility: 'visible',
            zIndex: '9999'
        });
    }, 1000);
}
