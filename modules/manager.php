<?php require('../sidebar.php'); ?>
<!-- [ breadcrumb ] start -->
<div class="page-header">
	<div class="page-block">
		<div class="row align-items-center">
			<div class="col-md-12">
				<div class="page-header-title">
					<h5>Managers</h5>
				</div>
				<ul class="breadcrumb">
					<li class="breadcrumb-item"><a href="index.php"><i class="feather icon-mail"></i></a></li>
					<li class="breadcrumb-item"><a href="./modules/manager.php">Managers</a></li>
				</ul>
			</div>
		</div>
	</div>
</div>

<div class="button-function mb-2">
	<!-- Button trigger modal -->
	<button class="btn btn-primary mr-0" onclick="addManager()">Add</button>
	<button class="btn btn-info mr-0" onclick="editManager()">Edit</button>
	<button class="btn btn-danger mr-0" onclick="removeManager()">Remove</button>
</div>

<!-- Modal User Modal Right -->
<div class="modal fade right" id="modalManager" tabindex="-1" role="dialog" aria-labelledby="modalManagerTitle"
  aria-hidden="true">
  <form id="create_manager">
  <!-- Add class .modal-full-height and then add class .modal-right (or other classes from list above) to set a position to the modal -->
  <div class="modal-dialog modal-full-height modal-right" role="document">
    <div class="modal-content">
	
      <div class="modal-header">
        <h4 class="modal-title w-100" id="modalManagerTitle"></h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
	 
      <div class="modal-body">
	 
	  	<div class="form-group">
			<label for="exampleInputManager">Name</label>
			<input type="text" class="form-control" name="fullName" id="input-fullname" aria-describedby="emailHelp" placeholder="Enter name">
		</div>
		<div class="form-group">
			<label for="exampleInputManager">Display Name</label>
			<input type="text" class="form-control" name="displayName" id="input-displayName" aria-describedby="emailHelp" placeholder="Enter display name">
		</div>
		<div class="form-group">
			<label for="exampleInputManager">Email</label>
			<input type="email" class="form-control" name="email" id="input-email" aria-describedby="emailHelp" placeholder="Enter email">
		</div>

		<div class="form-group">
			<label for="exampleInputManager">Department</label>
			<select class="form-control" name="department" id="input-department">
				<option selected></option>
				<option value="LYG">LYG</option>
				<option value="QIP">QIP</option>
				<option value="ME">ME</option>
				<option value="DC">DC</option>
				<option value="SEA">SEA</option>
				<option value="Plan">Plan</option>
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

<table id="tb_manager" class="table table-striped table-bordered " style="width:100%">
        <thead>
            <tr>
                <th>Name</th>
                <th>Display Name</th>
                <th>Email</th>
                <th>Department</th>
                <th>User Date</th>
            </tr>
        </thead>
</table>
<!-- [ breadcrumb ] end -->
<?php require('../footer.php'); ?>
<script src="assets/js/pages/manager.js"></script>