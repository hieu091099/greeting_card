<?php require('../sidebar.php');
$year = getyearhavecard();
$year = json_decode($year);
$cus = getCustomer();
$cus = json_decode($cus);

?>
<!-- [ breadcrumb ] start -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/1.4.1/html2canvas.js" integrity="sha512-sn/GHTj+FCxK5wam7k9w4gPPm6zss4Zwl/X9wgrvGMFbnedR8lTUSLdsolDRBRzsX6N+YgG6OWyvn9qaFVXH9w==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="http://danml.com/js/download.js"></script>
<div class="page-header">
	<div class="page-block">
		<div class="row align-items-center">
			<div class="col-md-12">
				<div class="page-header-title">
					<h5>Send Mail Manually</h5>
				</div>
				<ul class="breadcrumb">
					<li class="breadcrumb-item"><a href="index.php"><i class="feather icon-mail"></i></a></li>
					<li class="breadcrumb-item"><a href="./modules/mail_handle.php">Manually</a></li>
				</ul>
			</div>
		</div>
	</div>
</div>

<!-- [ breadcrumb ] end -->
<div class="form-inline mb-2">
	<label>Person:</label>
	<select class="form-select form-control ml-2" name="person" id="person">
		<option selected disabled>Chọn Person</option>
		<?php
		foreach ($cus as $cus) {
		?>
			<option value="<?= $cus->fullName ?>" fullname="<?= $cus->fullName ?>"><?= $cus->fullName ?></option>
			<?php
		}
			?>>
	</select>
	<label for="pwd" class="ml-2">Year:</label>
	<select class="form-select form-control ml-2" name="year" id="year">
		<option selected disabled>Chọn năm</option>
		<?php
		foreach ($year as $year) {
		?>
			<option value="<?= $year->year ?>"><?= $year->year ?></option>
		<?php
		}
		?>
	</select>
	<button type="button" class="btn btn-primary" id="generate">Generate</button>
</div>
<div id="cards" style="width: 1000px;height: 600px">
	<div id="card" style="width: 1000px;height: 600px;overflow: hidden;background-image: url('<?= isset($imgdf) ? './uploads/' . $imgdf[0]->image : '' ?>');background-size: 100% 100%;">


	</div>
</div>

<img id='previewImage' />

<button type="button" class="btn btn-primary" id="download">Gửi</button>

<?php require('../footer.php'); ?>
<script>
	$(document).ready(function() {
		$('#generate').click(() => {
			// console.log($('#year').val());
			// console.log($('#person').attr('fullname'));
			$.ajax({
				url: 'data/main.php?action=getImageDefault',
				data: {
					year: $('#year').val()
				},
				type: 'POST',
				success: (res) => {
					res = JSON.parse(res)[0];
					$('#card').css('background-image', `url('../uploads/${res.image}')`)

				}
			});
			$.ajax({
				url: 'data/main.php?action=getContentDefault',
				data: {
					year: $('#year').val()
				},
				type: 'POST',
				success: (res) => {
					res = JSON.parse(res)[0];
					var today = new Date();
					var dd = String(today.getDate()).padStart(2, '0');
					var mm = String(today.getMonth() + 1).padStart(2, '0');
					var yyyy = today.getFullYear();

					today = dd + '/' + mm + '/' + yyyy;
					data = $('<textarea />').html(res.box + res.content).text();
					data = data.replace('{Customer_Name}', $('#person').val());
					data = data.replace('{Date}', '2001');
					$('#card').html(data);

				}
			});
		});
		jQuery.fn.outerHTML = function() {
			return jQuery('<div />').append(this.eq(0).clone()).html();
		};


		$("#download").on('click', function() {
			// // img
			// // 
			// // contents
			// console.log($("#cards").html());
			html2canvas(document.querySelector("#cards")).then(canvas => {
				var data = canvas.toDataURL();
				// $("#previewImage").attr('src', data);
				console.log(data);
			});
		});
	});
</script>