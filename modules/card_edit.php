<?php require('../sidebar.php');
require('../connect.php');


// $id = $_GET['id']
if (isset($_GET['id'])) {
	$sql = "SELECT * FROM GC_CardContent WHERE id =" . $_GET['id'];
	$rs = odbc_exec($con, $sql);
	$rs = odbc_fetch_object($rs);
	$imgdf = getImageDefault($rs->year);
	$imgdf = json_decode($imgdf);
	print_r($imgdf[0]->image);
}
?>
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

	#text {
		-moz-user-select: none !important;
		-webkit-touch-callout: none !important;
		-webkit-user-select: none !important;
		-khtml-user-select: none !important;
		-moz-user-select: none !important;
		-ms-user-select: none !important;
		user-select: none !important;

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
<label for="exampleInputEmail1">Mail Subject</label>
<input type="text" class="form-control mb-2" name="mailsubj" id="mailsubj" placeholder="Enter Mail Subject" require value="<?= isset($rs) ? $rs->mailSubject : '' ?>">
<Textarea id="textarea">
	<?= isset($rs) ? $rs->content : '' ?>
</Textarea>
<div id="card" style="width: 800px;height: 500px;overflow: hidden;background-image: url('<?= isset($imgdf) ? './uploads/' . $imgdf[0]->image : '' ?>');">
	<?php
	if (isset($rs)) {
		echo html_entity_decode($rs->box . $rs->content);
	} else {
	?>
		<div id="text" class="text" style="width: 400px; 
        height: 200px;background-color: rgba(0, 0, 0, 0.267);overflow: hidden;padding: 20px;overflow-wrap: break-word;"></div>
	<?php

	} ?>

</div>
<div class="control">
	<h1>Control Box</h1>
	<div class="form-group">
		<label for="exampleInputEmail1">Year</label>
		<select class="form-select form-control" name="year" id="year">
			<?php for ($i = 2022; $i < 2030; $i++) { ?>
				<option value="<?= $i ?>" <?= isset($rs) ? ($rs->year == $i) ? 'selected' : '' : '' ?>><?= $i ?></option>
			<?php } ?>
		</select>
	</div>
	<div class="form-group">
		<label for="exampleInputEmail1">Version</label>
		<input type="number" class="form-control" name="version" id="version" placeholder="Enter Version" value="<?= isset($rs) ? $rs->version : '' ?>">
	</div>
	<div class="form-group">
		<label for=""> CHỌN MÀU :</label>
		<input type="color" class="form-control-color" id="favcolor" name="favcolor" value="#ff0000">
	</div>
	<div class="form-group">
		<label for=""> Opacity :</label>
		<input type="range" min="0" max="1" step="0.1" id="opacity" value="1">
	</div>
	<div class="form-group">
		<label for=""> Width :</label>
		<input type="range" min="10" max="1000" step="10" id="cd" value="400">
	</div>
	<div class="form-group">
		<label for=""> Height :</label>
		<input type="range" min="10" max="1000" step="10" id="cr" value="400">
	</div>
	<button type="button" class="btn btn-success m-0 w-50" id="<?= isset($rs) ? 'sua' : 'luu' ?>" idcont="<?= isset($rs) ? $rs->id : '' ?>">Lưu</button>
</div>
<div style="display: none;" id="rv"></div>
<script>
	tinymce.init({
		selector: 'textarea',
		plugins: 'advlist autolink lists link image charmap print preview hr anchor pagebreak',
		toolbar_mode: 'floating',
		content_style: "@import url('https://fonts.googleapis.com/css2?family=Gabriela'); body { font-family: Gabriela; }",
		setup: function(editor) {
			editor.on('change', function(e) {
				let myContent = tinymce.get("textarea").getContent();
				// myContent = myContent.replace('{Customer_Name}', 'Trung Nam');
				// myContent = myContent.replace('{Date}', '2001');
				$('#text').html(myContent);

			});
			editor.on('keyup', function(e) {
				let myContent = tinymce.get("textarea").getContent();
				// myContent = myContent.replace('{Customer_Name}', 'Trung Nam');
				// myContent = myContent.replace('{Date}', '2001');

				$('#text').html(myContent);

			});
		}
	});



	// 
	const projects = document.querySelectorAll("#text");
	// const drop = document.querySelector(".drop");
	const showcase = document.querySelector("#card");

	let start,
		offsetY,
		offsetX,
		targetRect,
		target,
		dropped = false,
		expanded = false;

	const stopped = () => {
		start = false;
		if (target) {
			showcase.classList.remove("is-dragging");
			target.classList.remove("is-selected");

		}
		if (dropped) {
			showcase.classList.add("is-preview");
			target.classList.add("is-expanded");

			expanded = true;
		} else {

			showcase.classList.remove("is-preview");
			target.classList.remove("is-expanded");
			expanded = false;
		}
	};

	const started = (e, type) => {
		start = true;
		target = e.target;
		if (type === "touch") {
			offsetY = target.offsetWidth / 2 + target.offsetTop;
			offsetX = target.offsetWidth / 2 + target.offsetLeft;
		} else {
			offsetY = e.offsetY + target.offsetTop;
			offsetX = e.offsetX + target.offsetLeft;
		}
	}

	projects.forEach(project => {
		project.addEventListener("mousedown", e => {
			started(e, "mouse");
		});
		project.addEventListener("touchstart", e => {
			started(e, "touch");
		});
	});

	const docUp = () => {
		if (!expanded && target) {
			stopped();
		}
	};

	document.addEventListener("mouseup", () => {
		docUp();
	});
	document.addEventListener("touchend", () => {
		docUp();
	});

	const docMove = (e, type) => {
		let clientX = 0,
			clientY = 0;

		if (type === "touch") {
			clientX = e.touches[0].clientX;
			clientY = e.touches[0].clientY;
		} else {
			clientX = e.clientX - 300;
			clientY = e.clientY;
		}



		if (start && !expanded) {
			if (target.id == 'text') {
				$("#text").css('transform', `translateY(${clientY -
			        offsetY}px) translateX(${clientX - offsetX}px)`);
			}

		}
	};

	document.addEventListener("mousemove", e => {
		docMove(e, "mouse");
	});
	document.addEventListener("touchmove", e => {
		docMove(e, "touch");
	});
</script>
<?php require('../footer.php'); ?>
<script src="assets/js/pages/card_edit.js"></script>