
$(document).ready(() => {
    $('.js-example-basic-multiple').select2();

    $.ajax({
        url: 'http://worldtimeapi.org/api/timezone',
        type: 'GET',
        success: (data) => {
            // data = JSON.parse(data);
            console.log(data);
        }
    })
})


function loadCus() {
    $('#tb_user').DataTable({
        "ajax": {
            url: "data/main.php?action=getCus",
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

function addCus() {
    $("#modalCusTitle").html("Add customer")
    $("#modalCus").modal("show");
    $("#create_cus").validate({
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
                url: 'data/main.php?action=createCus',
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