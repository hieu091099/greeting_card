
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


    loadUser();

    $("#register").on('click', (e) => {
        e.preventDefault();
        $.ajax({
            url: 'data/main.php?action=register',
            data: $('#register_form').serialize(),
            type: 'POST',
            success: (res) => {
                console.log(JSON.parse(res))
            }
        })
    })
    $("#login_form").validate({
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
        },
        submitHandler: function () {
            $.ajax({
                url: 'data/main.php?action=login',
                data: $('#login_form').serialize(),
                type: 'POST',
                success: (res) => {
                    response = JSON.parse(res);
                    console.log(response);
                    if (response.status == true) {
                        window.location.href = 'index.php';
                    }
                }
            })
        }
    });


})

function chooseLanguage(lang) {
    let path = window.location.pathname;
    let urlParam = new URLSearchParams(window.location.search);
    urlParam.set('lang', lang);
    if (path.indexOf('?') > 0) {
        window.location.href = path + '&' + urlParam.toString();
    } else {
        window.location.href = path + '?' + urlParam.toString();
    }
    // $.get("http://localhost:8088/GreetingCard/index.php?lang=" + lang, () => window.location.reload());
}
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
    $('#modalUser').modal('show');
    $('#modalUserTitle').html('Edit User');
    let tblData = tableUser.rows('.selected').data();
    toastr.success('Are you the 6 fingered man?', 'Miracle Max Says')
}
function removeUser() {
    let table = $("#tb_user").DataTable();
    let row = getSelectedRow(table);
    console.log(row);
    // let tblData = tableUser.rows('.selected').data();
    // console.log(tblData[0][1]);
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