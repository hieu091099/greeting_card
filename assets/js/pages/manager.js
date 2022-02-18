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
    loadManager();
})



function getSelectedRow(table) {
    return table.rows('.selected').data()[0];
}


function addManager() {
    $("#create_manager").removeData("validator");
    $("#create_manager").removeData("unobtrusiveValidation");


    $('#modalManager').modal('show');
    $('#modalManagerTitle').html('Add New Manager');
    $('#input-fullname').val('');
    $('#input-displayName').val('');
    $('#input-email').val('');
    $('#input-department').val('');


    let validator = $('#create_manager').validate({
        onfocusout: false,
        onkeyup: false,
        onclick: false,
        rules: {
            fullName: {
                required: true,
                maxlength: 15
            },
            displayName: {
                required: true,
            },
            email: {
                required: true,
            },
            department: {
                required: true,
            }
        },
        messages: {
            fullName: {
                required: "(*) Vui lòng nhập username!",
                maxlength: "(*) Nhập tối đa 15 ký tự!"
            },
            displayName: {
                required: "(*) Vui lòng nhập display name"
            },
            email: {
                required: "(*) Vui lòng nhập email"
            },
            department: {
                required: "(*) Vui lòng nhập department"
            }
        },
        submitHandler: function () {
            $.ajax({
                url: 'data/main.php?action=addManager',
                data: $('#create_manager').serialize(),
                type: 'POST',
                success: (res) => {
                    response = JSON.parse(res);
                    console.log(response);
                    if (response.status == true) {
                        $("#tb_manager").DataTable().ajax.reload();
                        toastr.success(response.msg, 'Info', {
                            timeOut: 800, onHidden: function () {
                                $('#modalManager').modal('hide');
                            }
                        })
                    } else {
                        toastr.error(response.msg, 'Info')
                    }
                }
            })
        }
    });
    validator.resetForm();
}


function editManager() {
    $("#create_manager").removeData("validator");
    $("#create_manager").removeData("unobtrusiveValidation");
    // $.validator.unobtrusive.parse("#create_manager");
    let table = $("#tb_manager").DataTable();
    let row = getSelectedRow(table);
    console.log(row)
    if (row == undefined) {
        toastr.warning('Please choose a manager!', 'Info')
    } else {
        $('#modalManager').modal('show');
        $('#modalManagerTitle').html('Edit User');
        $('#input-fullname').val(row.fullName);
        $('#input-displayName').val(row.displayName);
        $('#input-email').val(row.email);
        $('#input-department').val(row.department);

        let validator = $('#create_manager').validate({
            onfocusout: false,
            onkeyup: false,
            onclick: false,
            rules: {
                fullName: {
                    required: true,
                    maxlength: 15
                },
                displayName: {
                    required: true,
                },
                email: {
                    required: true,
                },
                department: {
                    required: true,
                }
            },
            messages: {
                fullName: {
                    required: "(*) Vui lòng nhập username!",
                    maxlength: "(*) Nhập tối đa 15 ký tự!"
                },
                displayName: {
                    required: "(*) Vui lòng nhập display name"
                },
                email: {
                    required: "(*) Vui lòng nhập email"
                },
                department: {
                    required: "(*) Vui lòng nhập department"
                }
            },
            submitHandler: function () {

                $.ajax({
                    url: 'data/main.php?action=editManager',
                    data: $('#create_manager').serialize(),
                    type: 'POST',
                    success: (res) => {
                        response = JSON.parse(res);
                        console.log(response);
                        if (response.status == true) {
                            $("#tb_manager").DataTable().ajax.reload();
                            toastr.success(response.msg, 'Info', {
                                timeOut: 800, onHidden: function () {
                                    $('#modalManager').modal('hide');
                                }
                            })
                        } else {
                            toastr.error(response.msg, 'Info')
                        }
                    }
                })
            }
        });
        validator.resetForm();

    }
}





function removeManager() {
    let table = $("#tb_manager").DataTable();
    let row = getSelectedRow(table);
    console.log(row);
    if (row == undefined) {
        toastr.warning('Please choose a manager!', 'Info')
    } else {
        $.ajax({
            url: 'data/main.php?action=removeManager',
            data: { "email": row.email },
            type: 'POST',
            success: (res) => {
                response = JSON.parse(res);
                console.log(response);
                if (response.status == true) {
                    toastr.success(response.msg, 'Info', {
                        timeOut: 800
                    })
                    $("#tb_manager").DataTable().ajax.reload();
                } else {
                    toastr.error(response.msg, 'Info')
                }
            }
        })
    }
}


function loadManager() {
    $('#tb_manager').DataTable({
        "ajax": {
            url: "data/main.php?action=getManager",
            type: "GET",
            "dataSrc": function (d) {
                return d;
            }
        },
        "columns": [
            { "data": "fullName" },
            { "data": "displayName" },
            { "data": "email" },
            { "data": "department" },
            { "data": "createdAt" }
        ],
        select: true
    });
}
