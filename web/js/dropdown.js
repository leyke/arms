$(document).ready(function () {
    var csrfToken = $('meta[name="csrf-token"]').attr("content");

    var createBtn = $('.js-create-btn');
    var updateBtn = $('.js-update-btn');
    var viewBtn = $('.js-view-btn');

    var modal = $('.modal');
    var modalHeader = $('.modal-header');

    createBtn.on('click', function () {
        var dropdown = $(this).parent().find('.js-dropdown');
        var className = dropdown.attr('data-type');
        modalHeader.html('<h2>Создание</h2>');

        send(className);
    });

    updateBtn.on('click', function () {
        var dropdown = $(this).parent().find('.js-dropdown');
        var className = dropdown.attr('data-type');
        var id = dropdown.val();
        modalHeader.html('<h2>Редактирование</h2>');

        send(className, id);
    });

    viewBtn.on('click', function () {
        var dropdown = $(this).parent().find('.js-dropdown');
        var className = dropdown.attr('data-type');
        var id = dropdown.val();

        $.ajax({
            method: "POST",
            url: "/rule/modal/",
            data: {'csrfToken': csrfToken, 'className': className, 'id': id, 'action': 'view'}
        }).done(function (answer) {
            var html = JSON.parse(answer);
            modalHeader.html('<h2>' + html.title + '</h2>');
            $('#pjax-wrap').html(html.body);
            modal.modal('show');
        })
    });

    function send(className, id) {
        var data = {'csrfToken': csrfToken, 'className': className};

        if (id) {
            data['id'] = id;
        }

        $.ajax({
            method: "POST",
            url: "/rule/modal/",
            data: data
        }).done(function (answer) {
            $('#pjax-wrap').html(answer);
            modal.modal('show');
        })
    }

    $("#pjax-wrap").on("pjax:end", function () {
        var result = $(this).find('.result');

        if (result.length) {
            var className = result.attr('data-model-type');
            var id = result.attr('data-newModelID');
            var dropdown = $('.js-dropdown[data-type =' + className + ']');

            dropdown.html('');
            result.find('option').each(function () {
                $(this).clone().appendTo(dropdown);
            });

            if (id) {
                dropdown.val(id);
            }
            $(this).html('');
            modal.modal('hide');
        }
    });
});