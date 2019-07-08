// function Edit POST
var basic_slider = document.getElementById('basic_slider');

noUiSlider.create(basic_slider, {
    start: 0,
    step: 1,
    behaviour: 'tap',
    connect: 'lower',
    tooltips: true,
    range: {
        'min':  0,
        'max':  100
    },
    format: {
        to: function (value) {
            return value;
        },
        from: function (value) {
            return (value);
        }
    }
});

var taskProgress = document.getElementById('task-progress');

basic_slider.noUiSlider.on('update', function (values, handle) {

    var value = values[handle];

    taskProgress.value = value;

});

taskProgress.addEventListener('change', function () {
    basic_slider.noUiSlider.set([null, this.value]);
});


$(document).on('click', '.progress-modal', function() {
    $('#footer_action_button').text(" Save");
    $('#footer_action_button').addClass('fa fa-check-square-o');
    $('.actionBtn').addClass('btn-success');
    $('.actionBtn').addClass('set-progress');
    $('.modal-title').text('Set Progress : '.concat($(this).data('title')));
    $('.form-horizontal').show();
    $('#task-id').val($(this).data('id'));
    $('#task-progress').val($(this).attr('data-progress'));
    basic_slider.noUiSlider.set($(this).attr('data-progress'));
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
            console.log(data['task'].progress);
            console.log(data['project_progress']);
            $('tr.task-' + data['task'].id + ' .progress-modal').attr('data-progress', data['task'].progress);
            $('tr.task-' + data['task'].id + ' div.progress div.task-progress').attr({
                'aria-valuenow': data['task'].progress,
                'style': 'width:' + data['task'].progress + '%'
            });
            $('div.project-' + data['task'].project_id + ' .progress-bar').attr({
                'aria-valuenow': data['project_progress'],
                'style': 'width:' + data['project_progress'] + '%'
            });
            swal({
                type: 'success',
                title: 'The task has been set progress to ' + data['task'].progress + '%',
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
