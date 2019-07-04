// function Edit POST
$(document).on('click', '.progress-modal', function() {
    $('#footer_action_button').text(" Save");
    $('#footer_action_button').addClass('fa fa-check-square-o');
    $('.actionBtn').addClass('btn-success');
    $('.actionBtn').addClass('set-progress');
    $('.modal-title').text('Set Progress : '.concat($(this).data('title')));
    $('.form-horizontal').show();
    $('#task-id').val($(this).data('id'));
    $('#task-progress').val($(this).attr('data-progress'));
    $('#progressModal').modal('show');
});

$('.modal-footer').on('click', '.set-progress', function() {
    $.ajax({
        type: 'POST',
        url: 'task/progress',
        data: {
            '_token': $('input[name=_token]').val(),
            'id': $("#task-id").val(),
            'progress': $('#task-progress').val()
        },

        success: function(data) {
            $('tr.task-' + data.id + ' .progress-modal').attr('data-progress', data.progress);
            $('tr.task-' + data.id + ' div.progress div.progress-bar').attr({
                'aria-valuenow': data.progress,
                'style': 'width:' + data.progress + '%'
            });
            swal({
                type: 'success',
                title: 'The task has been set progress to ' + data.progress + '%',
                showConfirmButton: false,
                timer: 2000
            });

        },
        error: function (xhr, ajaxOptions, thrownError) {
            swal({
                    type: 'error',
                    title: xhr.responseJSON.error,
                    showConfirmButton: false,
                    timer: 2000
                });
        }
    });
});