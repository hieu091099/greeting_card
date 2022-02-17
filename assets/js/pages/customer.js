
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
    loadCus();
    $('.js-example-basic-multiple').select2();
    $('.js-example-basic-single').select2();
    $('.my-select').select2({
        dropdownParent: $('#modalCus')
    });
    $.ajax({
        url: 'data/timezone.json',
        type: 'GET',
        success: (data) => {
            $.each(data, function (i, item) {
                $('#timezone').append($('<option>', {
                    value: item.value,
                    text: item.label
                }));
            })
        }
    })

})


function loadCus() {
    $('#tb_customer').DataTable({
        "ajax": {
            url: "data/main.php?action=getCus",
            type: "GET",
            "dataSrc": function (d) {
                return d;
            }
        },
        "columns": [
            { "data": "fullName" },
            { "data": "birthday" },
            { "data": "email" },
            { "data": "gender" },
            { "data": "jobLevel" },
            { "data": "status" },
            { "data": "nameTimezone" },
            { "data": "departmentName" },
            { "data": "createdBy" },
            { "data": "createdAt" }
        ],
        select: true
    });
}

function addCus() {
    clearForm("#create_cus");
    $("#modalCusTitle").html("Add customer")
    $("#modalCus").modal("show");
    $("#create_cus").validate({
        onfocusout: false,
        onkeyup: false,
        onclick: false,
        rules: {
            fullName: {
                required: true,
                maxlength: 30
            },
            birthday: {
                required: true,
            },
            email: {
                required: true,

            },
            gender: {
                required: true,
            },
            timezone: {
                required: true,
            },
            jobLevelPosition: {
                required: true,
            },
            relatedDepartment: {
                required: true,
            }
        },
        messages: {
            fullName: {
                required: "(*) Vui lòng nhập full name!",
                maxlength: "(*) Nhập tối đa 30 ký tự!"
            },
            birthday: {
                required: "(*) Vui lòng nhập birthday!",
                minlength: "(*) Nhập ít nhất 3 ký tự!"
            },
            email: {
                required: "(*) Vui lòng nhập email!",
            },
            gender: {
                required: "(*) Vui lòng nhập gender!",
            },
            timezone: {
                required: "(*) Vui lòng nhập timezone!",
            },
            jobLevelPosition: {
                required: "(*) Vui lòng nhập job position level!",
            },
            relatedDepartment: {
                required: "(*) Vui lòng nhập related department!",
            },
        },
        submitHandler: function () {

            let department = $('#relatedDeparment').select2("val");
            let selected = $('#relatedDeparment').select2("data");
            let departmentName = [];
            for (var i = 0; i <= selected.length - 1; i++) {
                departmentName.push(selected[i].text);
            }
            let data = {
                fullName: $("#fullName").val(),
                birthday: $("#birthday").val(),
                email: $("#email").val(),
                gender: $("#gender").val(),
                jobPositionLevel: $("#jobPositionLevel").val(),
                timezone: $("#timezone").val(),
                nameTimezone: $("#timezone option:selected").text(),
                relatedDepartment: department.toString(),
                departmentName: departmentName.toString()
            };

            console.log({ data });
            $.ajax({
                url: 'data/main.php?action=addCus',
                data: data,
                type: 'POST',
                success: (res) => {
                    response = JSON.parse(res);
                    console.log(response);
                    if (response.status == true) {
                        $("#tb_customer").DataTable().ajax.reload();
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

async function editCus() {

    let table = $("#tb_customer").DataTable();
    let row = getSelectedRow(table);
    if (row == undefined) {
        toastr.warning('Please choose a user!', 'Info')
    } else {


        $("#modalCusTitle").html("Edit customer")
        await $("#modalCus").modal("show")


        console.log({ row })
        for (let item in row) {
            if (item == 'gender') {
                if (row[item] == "Female") {
                    // console.log('1');
                    // $(`#${item} option[value='0']`).attr('selected', 'selected');
                    $(`#gender`).val(0);
                } else {
                    // $(`#${item} option[value='1']`).attr('selected', 'selected');
                    $(`#gender`).val(1);

                }
            }
            $(`#${item}`).val(row[item]);
        }
        $("#birthday").val('2022/02/17')
    }

}


function removeCus() {
    let table = $("#tb_customer").DataTable();
    let row = getSelectedRow(table);

    if (row == undefined) {
        toastr.warning('Please choose a user!', 'Info')
    } else {
        $.ajax({
            url: 'data/main.php?action=removeCus',
            data: { "fullName": row.fullName, "birthday": row.birthday, "email": row.email },
            type: 'POST',
            success: (res) => {
                response = JSON.parse(res);
                console.log(response);
                if (response.status == true) {
                    toastr.success(response.msg, 'Info', {
                        timeOut: 800
                    })
                    $("#tb_customer").DataTable().ajax.reload();
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

function clearForm(form) {
    $(form).trigger("reset");
}