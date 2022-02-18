<?php require('../sidebar.php'); ?>
<?php require('../connect.php'); ?>

<!-- [ breadcrumb ] start -->
<div class="page-header">
	<div class="page-block">
		<div class="row align-items-center">
			<div class="col-md-12">
				<div class="page-header-title">
					<h5>Customer</h5>
				</div>
				<ul class="breadcrumb">
					<li class="breadcrumb-item"><a href="index.php"><i class="feather icon-user"></i></a></li>
					<li class="breadcrumb-item"><a href="./modules/customer.php">Customer</a></li>
				</ul>
			</div>
		</div>
	</div>
</div>
<!-- [ breadcrumb ] end -->
<div class="button-function mb-2">
	<!-- Button trigger modal -->
	<button class="btn btn-primary mr-0" onclick="addCus()">Add</button>
	<button class="btn btn-info mr-0" onclick="editCus()">Edit</button>
	<button class="btn btn-danger mr-0" onclick="removeCus()">Remove</button>
	<div>


	</div>
</div>

<?php  ?>
<!-- Modal User Modal Right -->
<div class="modal fade right" id="modalCus" tabindex="-1" role="dialog" aria-labelledby="modalCusTitle" aria-hidden="true">
	<form id="create_cus">
		<!-- Add class .modal-full-height and then add class .modal-right (or other classes from list above) to set a position to the modal -->
		<div class="modal-dialog modal-full-height modal-right" role="document">
			<div class="modal-content">

				<div class="modal-header">
					<h4 class="modal-title w-100" id="modalCusTitle"></h4>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>

				<div class="modal-body">

					<div class="form-group">
						<label for="exampleInputEmail1">Full Name</label>
						<input type="text" class="form-control" name="fullName" id="fullName" aria-describedby="emailHelp" placeholder="Enter full name">
					</div>
					<div class="form-group">
						<label for="exampleInputEmail1" id="birthdaylabel">Birthday</label>
						<input type="date" class="form-control" name="birthday" id="birthday">
					</div>
					<div class="form-group">
						<label for="exampleInputEmail1">Email</label>
						<input type="email" class="form-control" name="email" id="email" aria-describedby="emailHelp" placeholder="Enter email">
					</div>
					<div class="form-group">
						<label for="exampleInputEmail1">Gender</label>
						<select class="form-control" name="gender" id="gender">
							<option value="0">Female</option>
							<option value="1">Male</option>
						</select>
					</div>
					<div class="form-group">
						<label for="exampleInputEmail1">Job Position Level</label>
						<select class="form-control" name="jobPositionLevel" id="jobPositionLevel">
							<option value="Senior">Senior</option>
							<option value="Junior">Junior</option>
						</select>
					</div>
					<div class="form-group">
						<label for="exampleInputEmail1">Timezone</label>
						<select class="my-select js-example-basic-single" name="timezone" id="timezone">
						</select>
					</div>
					<div class="form-group">
						<label for="exampleInputEmail1">Related Deparment</label>
						<select class="my-select js-example-basic-multiple form-control" name="relatedDeparment[]" id="relatedDeparment" multiple="multiple">
							<!-- <option value="" disabled>Choose Department</option> -->
							<?php $sql_deparment = "SELECT * FROM Data_Department";
							$rs = odbc_exec($con, $sql_deparment);
							while (odbc_fetch_row($rs)) { ?>
								<option value="<?php echo odbc_result($rs, 'Department_ID'); ?>"><?php echo odbc_result($rs, 'Department_Name'); ?></option>
							<?php } ?>
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

<table id="tb_customer" class="table table-striped table-bordered table-responsive-md" style="width:100%">
	<thead>
		<tr>
			<th>Full Name</th>
			<th>Birthday</th>
			<th>Email</th>
			<th>Gender</th>
			<th>Job Position Level</th>
			<th>Status</th>
			<th>Timezone</th>
			<th>Related Deparment</th>
			<th>Created By</th>
			<th>Created At</th>
		</tr>
	</thead>
</table>
<?php require('../footer.php'); ?>
<script src="assets/js/pages/customer.js"></script>