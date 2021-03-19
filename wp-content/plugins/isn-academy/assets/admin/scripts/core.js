$ = jQuery;

/* Side navigation */
$(document).on('click', '#as_content .content-tabs li a', function (e) {
    e.stopImmediatePropagation();

    var target = $(this).attr('href');
    var el = $(this).parents('ul:first').hasClass('inner') ? $(this).parents('div:first') : $(this).parents('div.postbox:first');
    el.find('.tabs').removeClass('tabs');
    $(this).parent().addClass('tabs');
    el.find('.tabs-panel').addClass('hidden');
    $(target).removeClass('hidden');
    return false;
});

function ec_reload(save) {
    save = typeof save === 'undefined' ? false : save;
    if (save) {
        $('#post').find('[type="submit"]').trigger('click');
    }
    else {
        window.location.reload(false);
    }
}

$(document).on('click', '#as_content h2 .button.danger', function (e) {
    e.stopImmediatePropagation();
    if (confirm('This will delete this content, are you sure?')) {

        var id = $(this).data('id');
        if (id !== '0') {
            $.post(
                ajaxurl,
                {
                    action: 'as_update',
                    do: 'delete',
                    ID: id
                })
                .done(function () {
                    $('#as_' + id).remove();
                });
        }
        else {
            $(this).parents('div.postbox').remove();
        }
    }
    return false;
});

/* Toggle open/close .postbox */
$(document).on('click', '.as-toggle', function (e) {
    e.stopPropagation();
    var target = $(this).data('target').replace('#', '');
    $('#as_content').find('> div.postbox').attr('class', (function () {
        if ($(this).attr('id') === target) {
            return $(this).is(".open") ? 'postbox closed' : 'postbox open';
        }
        return 'postbox closed';
    }));
});

/* Add an Extended Content post */
$(document).on('click', '#add_child', function (e) {
    e.stopPropagation();
    var _btn = $(this);
    var type_name = $('#as_add').find('option:selected').text();
    if( ! type_name ) {
        alert("Please select content type");
        return false;
    }
    var title = prompt("Please enter content title");
    $.get(ajaxurl,
        {
            action: 'as_add_child',
            extended_content_type: type_name,
            post_parent: $('#post_ID').val(),
            post_title: title,
            beforeSend: function () {
                _btn.attr('disabled', 'disabled').text('Loading');
            }
        }
    ).success(function (result) {
        if (parseInt(result.substring(0, 10)) > 1) {
            ec_reload(false);
        }
        else {
            $('#as_content').append(result);
            _btn.removeAttr('disabled').text('Add');
        }
    });
});
$('form').bind('form-pre-serialize', function (e) {
    //tinyMCE.triggerSave();
});

/**
 * action buttons Publish, save draft & delete
 */
$(document).on('click', '.as_action_buttons button', function (e) {
    function processformfields( formfields, data ) {
        $.each( formfields, function(i) {
            if (typeof formfields[i].name !== 'undefined' && formfields[i].name !== '') {
                if (formfields[i].name.indexOf('[]') > 0) {
                    if (!$.isArray(data[formfields[i].name])) {
                        data[formfields[i].name] = [];
                    }
                    data[formfields[i].name].push(formfields[i].value);
                }
                else {
                    var $field = $('[name="'+formfields[i].name+'"]');
                    if( $field.length && $field.attr('id') !== undefined ) {
                        var $el = $('#'+$field.attr('id') );
                        data[ formfields[i].name ] = $el.hasClass('wp-editor-area') && !$el.is(':visible') && tinyMCE.get($el.attr('id')) !== null
                            ? tinyMCE.get($el.attr('id')).getContent()
                            : formfields[i].value;
                    } else {
                        data[formfields[i].name] = formfields[i].value;
                    }
                }
            }
        });

        return data;
    }

    e.stopPropagation();
    var _form = $(this).parents('fieldset.extended_content');
    var _btn = $(this);
    var _text = _btn.text();
    var data = {
        action: 'as_update',
        do: $(this).data('action'),
        ID: _form.find('input[name="ID"]').val()
    };

    if ($(this).data('action') !== 'delete') {
        data = processformfields( _form.serializeArray(), data );
    }

    $.ajax({
        method: 'POST',
        url: ajaxurl,
        data: data,
        beforeSend: function () {
            _btn.attr('disabled', 'disabled').text('Saving...');
        }
    })
        .error(function (msg) {
            if (msg !== '') {
                alert('Error: ' + msg);
            }
        })
        .success(function () {
            if ($(this).data('action') === 'publish') {
                ec_reload(true);
            }
        })
        .always(function () {
            _btn.removeAttr('disabled').text(_text);
        });

    return false;
});

$(document).ready(function () {
    $('#as_save').on('click', function (e) {
        e.stopImmediatePropagation();
        $('#as_save').attr('disabled', 'disabled').text('Saving...');
        var ids = [];
        $('#as_content').find('> .postbox').each(function () {
            ids.push($(this).data('id'));
        });
    });
});


/**
 * Add functionality - to add a new option OR question to the quiz
 */
$(document).on('click', '.js-as-quiz__add', function (e) {
    'use strict';
    e.stopPropagation();
    let $this = jQuery(this);
    let type = $this.data('type');

    let $quiz = jQuery('#as-quiz-' + jQuery(this).closest('.js-as-quiz').data('id'));
    let $parent = type === 'option'
        ? jQuery('.as-quiz__question[data-q="' + $this.data('q') + '"] ul')
        : jQuery('.js-as-quiz__' + type + 's');

    let position = $parent.find('> li').length;
    let html = $quiz.find('.js-as-quiz__' + type + '--new').html();

    html = type === 'option'
        ? html.replace(/#q#/g, $this.data('q')).replace(/#o#/g, position)
        : html.replace(/#q#/g, position).replace(/#o#/g, 0);

    jQuery(html).hide().attr('class', 'as-quiz__' + type + ' js-as-quiz__' + type)
        .appendTo($parent)
        .slideDown('fast')
        .find('.as-quiz__option--new')
        .attr('class', 'as-quiz__option');
});

/**
 * Remove option btn
 */
$(document).on('click', '.js-as-quiz__option-remove-btn', function (e) {
    'use strict';
    e.stopPropagation();
    let targetSelector = jQuery(this).data('target');
    let $targetElement = $(this).parents(targetSelector);
    $targetElement.slideUp('fast');
    setTimeout(function () {
        $targetElement.remove();
    }, 300);
});

/**
 * Remove question btn
 */
$(document).on('click', '.js-as-quiz__question-remove-btn', function (e) {
    'use strict';
    e.stopPropagation();
    let $question = jQuery(this).parents('.as-quiz__question');
    $question.slideUp('fast');
    setTimeout(function () {
        $question.remove();
    }, 400);
});

$(document).on('click', '.js-as-quiz-collapse', function (e) {
    'use strict';
    e.stopPropagation();
    let $container = jQuery(this).parent();
    if ($container.hasClass('in')) {
        $container.removeClass('in');
    } else {
        $container.addClass('in');
    }
});