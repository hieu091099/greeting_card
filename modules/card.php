<?php
require('../sidebar.php');
require('../connect.php');
?>

<!-- [ breadcrumb ] start -->
<div class="page-header">
    <div class="page-block">
        <div class="row align-items-center">
            <div class="col-md-12">
                <div class="page-header-title">
                    <h5>Background GreetingCard</h5>
                </div>
                <ul class="breadcrumb">
                    <li class="breadcrumb-item"><a href="index.php"><i class="feather icon-user"></i></a></li>
                    <li class="breadcrumb-item"><a href="./modules/user.php">Card</a></li>
                </ul>
            </div>
        </div>
    </div>
</div>
<!-- [ breadcrumb ] end -->
<!-- [ title ] -->
<h4>
    <!-- List Background -->
    <?php echo 'data:image/jpeg;base64,' . base64_encode(file_get_contents("../assets/images/bg_login.webp")) ?>
</h4>
<!-- [ end title ] -->
<?php
$sql = "SELECT * FROM GC_Background";
$rs  = odbc_exec($con, $sql);
?>
<div class="button-function mb-2">
    <!-- Button trigger modal -->
    <button class="btn btn-primary mr-0" onclick="add()">Add</button>
    <button class="btn btn-info mr-0" onclick="editUser()">Edit</button>
    <button class="btn btn-danger mr-0" onclick="remove()">Remove</button>

</div>


<!-- Modal User Modal Right -->
<div class="modal fade right" id="modalUser" tabindex="-1" role="dialog" aria-labelledby="modalUserTitle" aria-hidden="true">
    <form id="create_user" action="data/main.php?action=registerbg" method="post" enctype="multipart/form-data">
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
                        <select class="form-select form-control" name="isDefault" id="isdefault">
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
    </form>
</div>
<!-- Full Height Modal Right -->

<table id="tb_user" class="table table-striped table-bordered" style="width:100%">
    <thead>
        <tr>
            <th>Year</th>
            <th>Version</th>
            <th>Photo</th>
            <th>Is Default</th>
            <th>Created By</th>
            <th>Created At</th>

        </tr>
    </thead>
</table>
<?php require('../footer.php'); ?>
<script src="assets/js/pages/cardbg.js"></script>