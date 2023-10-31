$(document).ready(function() {
    $('#statusmodal').on('show.bs.modal', function(event) {
        var button = $(event.relatedTarget);
        var id = button.data('whatever')

        var modal = $(this)
        modal.find('#id').val(id)
    })
})

$(document).ready(function() {
    $('#user_update_modal').on('show.bs.modal', function(event) {
        var button = $(event.relatedTarget);

        var id = button.data('whatever')
        var email = button.data('email')
        var role = button.data('role')
        var birthdate = button.data('birthdate')
        var fname = button.data('firstname')
        var lname = button.data('lastname')
        var gender = button.data('gender')

        var modal = $(this)
        modal.find('#user-id').val(id)
        modal.find('#emailadd').val(email)
        modal.find('#privilege').val(role)
        modal.find('#firstname').val(fname)
        modal.find('#lastname').val(lname)
        modal.find("#birthdate").val(birthdate)
        modal.find('#gender').val(gender)

    })
})

$(document).ready(function() {
    $('#user_delete_modal').on('show.bs.modal', function(event) {
        var button = $(event.relatedTarget);
        var id = button.data('whatever')

        var modal = $(this)
        modal.find('#id').val(id)
    })
})
