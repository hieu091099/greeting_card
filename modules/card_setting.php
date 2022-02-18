<?php require('../sidebar.php'); ?>
<script src="https://cdn.tiny.cloud/1/thramtwvd2ucdnowamix75pt1m9r8p8aacchutk6lqfkdycz/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script>
<!-- [ breadcrumb ] start -->
<style>
    #card {
        border: 1px solid black;
        display: block;
        float: left;
    }

    .control {
        float: left;
        width: 500px;
        height: 500px;
        margin-left: 50px;
    }

    td #text {
        transform: none !important;
    }
</style>
<div class="page-header">
    <div class="page-block">
        <div class="row align-items-center">
            <div class="col-md-12">
                <div class="page-header-title">
                    <h5>Greeting Card Setting</h5>
                </div>
                <ul class="breadcrumb">
                    <li class="breadcrumb-item"><a href="index.php"><i class="feather icon-user"></i></a></li>
                    <li class="breadcrumb-item"><a href="./modules/customer.php">Greeting Card Setting</a></li>
                </ul>
            </div>
        </div>
    </div>
</div>
<!-- [ breadcrumb ] end -->
<h4>
    <!-- List Background -->
    <?php echo 'data:image/jpeg;base64,' . base64_encode(file_get_contents("../assets/images/bg_login.webp")) ?>
</h4>
<!-- [ end title ] -->
<div class="button-function mb-2">
    <!-- Button trigger modal -->
    <a href="./modules/card_edit.php"><button class="btn btn-primary mr-0">Add</button></a>
    <!-- <button class="btn btn-info mr-0" onclick="editUser()">Edit</button> -->
    <button class="btn btn-danger mr-0" onclick="remove()">Remove</button>
</div>


<!-- Modal User Modal Right -->
<div class="modal fade right" id="modalUser" tabindex="-1" role="dialog" aria-labelledby="modalUserTitle" aria-hidden="true">
    <!-- Add class .modal-full-height and then add class .modal-right (or other classes from list above) to set a position to the modal -->
    <div class="modal-dialog modal-full-height modal-right" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title w-100" id="modalUserTitle"></h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <label for="exampleInputEmail1">Year</label>
                    <select class="form-select form-control" name="year" id="year">
                        <?php for ($i = 2022; $i < 2030; $i++) { ?>
                            <option value="<?= $i ?>"><?= $i ?></option>
                        <?php } ?>
                    </select>
                </div>
                <div class="form-group">
                    <label for="exampleInputEmail1">Version</label>
                    <input type="number" class="form-control" name="version" id="version" aria-describedby="emailHelp" placeholder="Enter Version">
                </div>
                <div class="form-group">
                    <label for="exampleInputEmail1">Image</label>
                    <input class="form-control" type="file" id="filebg" name="filebg">
                </div>
                <div class="form-group">
                    <label for="exampleInputEmail1">Is Default</label>
                    <select class="form-select form-control" name="isdefault" id="isdefault">
                        <option value="0">No</option>
                        <option value="1">Yes</option>
                    </select>
                </div>
            </div>
            <div class="modal-footer justify-content-center">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit" id="save" class="btn btn-primary">Save changes</button>
            </div>
        </div>
    </div>
</div>
<!-- Full Height Modal Right -->

<table id="tb_user" class="table table-striped table-bordered" style="width:100%">
    <thead>
        <tr>
            <th>Year</th>
            <th>Version</th>
            <th>Content</th>
            <th>Mail Subject</th>
            <th>Is Default</th>
            <th>Created By</th>
            <th>Created At</th>
            <th></th>



        </tr>
    </thead>
</table>
<?php require('../footer.php'); ?>

<Script>
    $(document).ready(() => {
        loaddata();
    });

    function loaddata() {
        $('#tb_user').DataTable({
            "ajax": {
                url: "data/main.php?action=showcontentcard",
                type: "GET",
                "dataSrc": function(d) {
                    return d;
                }
            },
            "columns": [{
                    "data": "year"
                },
                {
                    "data": "version"
                },
                {
                    "data": "content"
                },
                {
                    "data": "mailSubject"
                }, {
                    "data": "isDefault"
                },
                {
                    "data": "createdBy"
                },
                {
                    "data": "createdAt"
                }
            ],
            select: true,
            "columnDefs": [{
                // The `data` parameter refers to the data for the cell (defined by the
                // `data` option, which defaults to the column being worked with, in
                // this case `data: 0`.
                "render": function(data, type, row) {
                    data = $('<textarea />').html(data).text();
                    return data;
                },
                "targets": 2
            }, {
                "render": function(data, type, row) {
                    return `<a href='./modules/card_edit.php?id=${row.id}' class='btn btn-info text-white'>Edit</a>`;
                },
                "targets": 6
            }, {
                "render": function(data, type, row) {
                    if (row.isDefault == 0) {
                        return ` <button type="button" class="btn btn-secondary" onclick='setdefault(${row.id},${row.year})'>Set Default</button>`;
                    } else {
                        return '';
                    }
                },
                "targets": 7
            }, {
                // The `data` parameter refers to the data for the cell (defined by the
                // `data` option, which defaults to the column being worked with, in
                // this case `data: 0`.
                "render": function(data, type, row) {
                    if (data == 1) {
                        return '✔️';
                    } else {
                        return '❌';
                    }
                    // return `<img class='rvimg' src="./uploads/${data}" />`;
                },
                "targets": 4
            }]
        });
    }

    function setdefault(id, year) {
        $.ajax({
            url: 'data/main.php?action=updatedefaultcontent',
            data: {
                "idbg": id,
                year: year
            },
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
        });
    }

    function getSelectedRow(table) {
        return table.rows('.selected').data()[0];
    }

    function remove() {
        let table = $("#tb_user").DataTable();
        let row = getSelectedRow(table);
        console.log(row);
        $.ajax({
            url: 'data/main.php?action=removeCt',
            data: {
                "id": row.id
            },
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
</Script>