
toastr.options = {
    "closeButton": true,
    "newestOnTop": false,
    "progressBar": true,
    "positionClass": "toast-top-center",
    "preventDuplicates": false,
    "onclick": null,
    "showDuration": "300",
    "timeOut": "2000",

}
$(document).ready(() => {

    // $("#tb_user").DataTable()
    loadUser();

})

function addUser() {
    $('#modalUser').modal('show');
    $('#modalUserTitle').html('Add New User');
    $("#create_user").validate({
        onfocusout: false,
        onkeyup: false,
        onclick: false,
        rules: {
            username: {
                required: true,
                maxlength: 15
            },
            password: {
                required: true,
                minlength: 3
            },
            displayName: {
                required: true,

            },
            email: {
                required: true,

            },
        },
        messages: {
            username: {
                required: "(*) Vui lòng nhập username!",
                maxlength: "(*) Nhập tối đa 15 ký tự!"
            },
            password: {
                required: "(*) Vui lòng nhập password!",
                minlength: "(*) Nhập ít nhất 3 ký tự!"
            },
            displayName: {
                required: "(*) Vui lòng nhập display name!",
            },
            email: {
                required: "(*) Vui lòng nhập email!",
            },
        },
        submitHandler: function () {
            $.ajax({
                url: 'data/main.php?action=register',
                data: $('#create_user').serialize(),
                type: 'POST',
                success: (res) => {
                    response = JSON.parse(res);
                    console.log(response);
                    if (response.status == true) {
                        $("#tb_user").DataTable().ajax.reload();
                        toastr.success(response.msg, 'Info', {
                            timeOut: 800, onHidden: function () {
                                $('#modalUser').modal('hide');
                            }
                        })
                    } else {
                        toastr.error(response.msg, 'Info')
                    }
                }
            })
        }
    });
}

function editUser() {

    let table = $("#tb_user").DataTable();
    let row = getSelectedRow(table);
    console.log(row)
    if (row == undefined) {
        toastr.warning('Please choose a user!', 'Info')
    } else {
        $('#modalUser').modal('show');
        $('#modalUserTitle').html('Edit User');

    }
}
function removeUser() {
    let table = $("#tb_user").DataTable();
    let row = getSelectedRow(table);

    if (row == undefined) {
        toastr.warning('Please choose a user!', 'Info')
    } else {
        $.ajax({
            url: 'data/main.php?action=removeUser',
            data: { "username": row.username },
            type: 'POST',
            success: (res) => {
                response = JSON.parse(res);
                console.log(response);
                if (response.status == true) {
                    toastr.success(response.msg, 'Info', {
                        timeOut: 800
                    })
                    $("#tb_user").DataTable().ajax.reload();
                } else {
                    toastr.error(response.msg, 'Info')
                }
            }
        })
    }

}
function getSelectedRow(table) {
    return table.rows('.selected').data()[0];
}
function loadUser() {
    $('#tb_user').DataTable({
        "ajax": {
            url: "data/main.php?action=getUser",
            type: "GET",
            "dataSrc": function (d) {
                return d;
            }
        },
        "columns": [
            { "data": "username" },
            { "data": "displayName" },
            { "data": "email" },
            { "data": "userCreated" },
            { "data": "createdAt" }
        ],
        select: true
    });
}