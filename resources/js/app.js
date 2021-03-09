require('./bootstrap');

$('#deleteModal').on('show.bs.modal', function (event) {
    var button = $(event.relatedTarget)
    var id = button.data('id');
    var modal = $(this)
    modal.find('.confirm_delete').data('id', id)
});

$('.confirm_delete').on('click', function (event) {
    var id = $(this).data('id');
    var button = $(this);

    button.addClass('disabled');

    $.ajax({
        url: `/publication/${id}`,
        type: 'DELETE',
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        success: function (result) {
            location.reload();
        },
        error: () => {
            button.removeClass('disabled');
        }
    });
});