$(document).ready(function() {
    $('#lesson_delete_modal').on('show.bs.modal', function(event) {
        var button = $(event.relatedTarget);
        var id = button.data('lessonid')

        var modal = $(this)
        modal.find('#id').val(id)
    })
})