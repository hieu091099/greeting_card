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
					<h5>User</h5>
				</div>
				<ul class="breadcrumb">
					<li class="breadcrumb-item"><a href="index.php"><i class="feather icon-user"></i></a></li>
					<li class="breadcrumb-item"><a href="./modules/user.php">User</a></li>
				</ul>
			</div>
		</div>
	</div>
</div>
<!-- [ breadcrumb ] end -->
 <!-- [ title ] -->
 <!-- <h4>
	 List User
 </h4> -->
 <!-- [ end title ] -->
<?php
$sql = "SELECT * FROM GC_Users";
$rs  = odbc_exec($con, $sql);	
 ?>
<div class="button-function mb-2">
	<!-- Button trigger modal -->
	<button class="btn btn-primary mr-0" onclick="addUser()">Add</button>
	<button class="btn btn-info mr-0" onclick="editUser()">Edit</button>
	<button class="btn btn-danger mr-0" onclick="removeUser()">Remove</button>
</div>


<!-- Modal User Modal Right -->
<div class="modal fade right" id="modalUser" tabindex="-1" role="dialog" aria-labelledby="modalUserTitle"
  aria-hidden="true">
  <form id="create_user">
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
			<label for="exampleInputEmail1">Username</label>
			<input type="text" class="form-control" name="username" aria-describedby="emailHelp" placeholder="Enter username">
		</div>
		<div class="form-group">
			<label for="exampleInputEmail1">Password</label>
			<input type="password" class="form-control" name="password" aria-describedby="emailHelp" placeholder="Enter password">
		</div>
		<div class="form-group">
			<label for="exampleInputEmail1">Display Name</label>
			<input type="text" class="form-control" name="displayName" aria-describedby="emailHelp" placeholder="Enter display name">
		</div>
		<div class="form-group">
			<label for="exampleInputEmail1">Email</label>
			<input type="email" class="form-control" name="email" aria-describedby="emailHelp" placeholder="Enter email">
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

<table id="tb_user" class="table table-striped table-bordered table-responsive-md" style="width:100%">
        <thead>
            <tr>
                <th>Username</th>
                <th>Display Name</th>
                <th>Email</th>
                <th>Created By</th>
                <th>Created At</th>
            </tr>
        </thead>
		<!-- <?php while(odbc_fetch_row($rs)){ 
			$username = odbc_result($rs, 'username');
			$email = odbc_result($rs, 'email');
			$displayName = odbc_result($rs, 'displayName');
			$userCreated = odbc_result($rs, 'userCreated');
			$createdAt = odbc_result($rs, 'createdAt');
		?>
		<tbody>
			<td><?php echo $username; ?></td>
			<td><?php echo $displayName; ?></td>
			<td><?php echo $email; ?></td>
			<td><?php echo $userCreated; ?></td>
			<td><?php echo $createdAt; ?></td>

		</tbody>
		<?php } ?> -->
    </table>
<?php require('../footer.php'); ?>
<script src="assets/js/pages/user.js"></script>