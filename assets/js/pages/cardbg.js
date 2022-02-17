
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
let imgbase64;
$(document).ready(() => {
    loaddata();
    $("#filebg").change(function (e) { 
        if (this.files && this.files[0]) {
            var FR= new FileReader();
            FR.addEventListener("load", function(e) {
            imgbase64 = e.target.result;
            console.log(e.target.result);
            }); 
            FR.readAsDataURL( this.files[0] );
          }
    });

})

function add() {
    $('#modalUser').modal('show');
    $('#modalUserTitle').html('Add New User');
    $("#create_user").validate({
        onfocusout: false,
        onkeyup: false,
        onclick: false,
        rules: {
            version: {
                required: true
            },
            filebg: {
                required: true
            },
            isdefault: {
                required: true

            },
        },
        messages: {
            version: {
                required: "(*) Vui lòng nhập Version"
            },
            filebg: {
                required: "(*) Vui lòng tải hình ảnh"
            },
            isdefault: {
                required: "(*) Vui lòng chọn hình mặc định"

            },
        },
        // submitHandler: function () {

            // let data={
            //     year:$('#year').val(),modules/card.php
            //     version:$('#version').val(),
            //     image:imgbase64,
            //     isdefault:$('#year').val(),

            // };
            //     $.ajax({
            //     url: 'data/main.php?action=registerbg',
            //     data:data,
            //     type: 'POST',
            //     success: (res) => {
            //         response = JSON.parse(res);
            //         console.log(response);
            //         if (response.status == true) {
            //             $("#tb_user").DataTable().ajax.reload();
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
        // }
    });
}

// function editUser() {
//     $('#modalUser').modal('show');
//     $('#modalUserTitle').html('Edit User');
//     let tblData = tableUser.rows('.selected').data();
//     toastr.success('Are you the 6 fingered man?', 'Miracle Max Says')
// }
function remove() {
    let table = $("#tb_user").DataTable();
    let row = getSelectedRow(table);
    console.log(row);
    $.ajax({
        url: 'data/main.php?action=removeBg',
        data: { "idbg": row.id },
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
function loaddata() {
    $('#tb_user').DataTable({
        "ajax": {
            url: "data/main.php?action=showbg",
            type: "GET",
            "dataSrc": function (d) {
                return d;
            }
        },
        "columns": [
            { "data": "year" },
            { "data": "version" },
            { "data": "image" },
            { "data": "isDefault" },
            { "data": "createdBy" },
            { "data": "createdAt" }
        ],
        select: true
        ,"columnDefs": [
            {
                // The `data` parameter refers to the data for the cell (defined by the
                // `data` option, which defaults to the column being worked with, in
                // this case `data: 0`.
                "render": function ( data, type, row ) {
                    return `<img class='rvimg' src="./uploads/${data}" />`;
                },
                "targets": 2
            },
        ]
    });


}