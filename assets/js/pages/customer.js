
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
    // $("#birthday").datepicker();
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
let check = "";

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
            { "data": "id" },
            { "data": "fullName" },
            { "data": "birthdayCus" },
            { "data": "email" },
            { "data": "gender" },
            { "data": "jobLevel" },
            { "data": "status" },
            { "data": "timezone" },
            { "data": "nameTimezone" },
            { "data": "relatedDepartment" },
            { "data": "departmentName" },
            { "data": "createdBy" },
            { "data": "createdAt" }
        ],
        "columnDefs": [
            {
                "targets": [0, 7, 9],
                "visible": false
            },

        ],
        select: true
    });
}

function addCus() {
    check = "add";
    clearForm("#create_cus");
    $("#modalCusTitle").html("Add customer")
    $("#modalCus").modal("show");
    let validator = $("#create_cus").validate({
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
            console.log(check);
            callAjax(check, data)
            // console.log('edit')

            // $.ajax({
            //     url: 'data/main.php?action=addCus',
            //     data: data,
            //     type: 'POST',
            //     success: (res) => {
            //         response = JSON.parse(res);
            //         console.log(response);
            //         if (response.status == true) {
            //             $("#tb_customer").DataTable().ajax.reload();
            //             toastr.success(response.msg, 'Info', {
            //                 timeOut: 800, onHidden: function () {
            //                     $('#modalUser').modal('hide');
            //                 }
            //             })
            //         } else {
            //             toastr.error(response.msg, 'Info')
            //         }
            //     }
            // })
        }
    });

}

async function editCus() {
    check = 'edit';
    let table = $("#tb_customer").DataTable();
    let row = getSelectedRow(table);
    if (row == undefined) {
        toastr.warning('Please choose a user!', 'Info')
    } else {


        $("#modalCusTitle").html("Edit customer")
        $("#modalCus").modal("show")

        $("#fullName").val(row.fullName);
        $('#birthday').css('color', 'black');
        $("#birthday").val(moment(row.birthday).format('YYYY-MM-DD'));
        if (row.gender == 'Female') {
            $("#gender").val(0);
        } else {
            $("#gender").val(1);
        }
        $("#email").val(row.email);
        $("#jobPositionLevel").val(row.jobLevel)
        let arrDepartment = row.relatedDepartment.split(',');
        $('#timezone').val(row.timezone);
        $('#timezone').select2().trigger('change');
        $("#relatedDeparment").val(arrDepartment);
        $('#relatedDeparment').select2().trigger('change');
        $('#id_cus').val(row.id)

        let validator = $("#create_cus").validate({
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
                    id: $("#id_cus").val(),
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
                console.log(check);
                callAjax(check, data);
                // $.ajax({
                //     url: 'data/main.php?action=editCus',
                //     data: data,
                //     type: 'POST',
                //     success: (res) => {
                //         response = JSON.parse(res);
                //         console.log(response);
                //         if (response.status == true) {
                //             $("#tb_customer").DataTable().ajax.reload();
                //             toastr.success(response.msg, 'Info', {
                //                 timeOut: 800, onHidden: function () {
                //                     $('#modalUser').modal('hide');
                //                 }
                //             })
                //         } else {
                //             toastr.error(response.msg, 'Info')
                //         }
                //     }
                // })
            }
        });

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
function callAjax(check, data) {
    data.id = $('#id_cus').val();
    $.ajax({
        url: `data/main.php?action=${check}Cus`,
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

function getSelectedRow(table) {
    return table.rows('.selected').data()[0];
}

function clearForm(form) {
    $(form).trigger("reset");
}