jQuery(document).ready(function ($) {
    $('.nxt-course').on('click', function (e) {
        var post_id = $(this).attr('id');

        $.ajax({
            type: 'POST',
            url: isn_ajax_count_object.ajaxurl,
            _ajax_nonce: isn_ajax_count_object.nonce,
            data: {
                action: isn_ajax_count_object.action,
                post_id: post_id
            },
            success: function (data) {
                location.href = isn_ajax_count_object.redirecturl;
            },
            error: function (errorThrown) {
                console.log(errorThrown);
                console.log("fail");
            }
        });
        e.preventDefault();
    });

    $('#getCertificate').on('click', function (e) {
        var post_id = $(this).attr('id');
        var modals = $('#contents')[0];
        $.ajax({
            type: 'POST',
            url: isn_ajax_count_object.ajaxurl,
            _ajax_nonce: isn_ajax_count_object.nonce,
            data: {
                action: isn_ajax_count_object.action,
                post_id: post_id
            },
            success: function (data) {
                modals.css('display', 'block');
            },
            error: function (errorThrown) {
                console.log(errorThrown);
            }
        });
        e.preventDefault();
    });
});