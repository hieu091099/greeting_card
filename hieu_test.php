<?php 

$mail = new PHPMailer(true);
try {
//    $mail->SMTPDebug = 2;  // Enable verbose debug output
//    $mail->isSMTP();  
//    $mail->CharSet  = "utf-8";
//    $mail->Host = 'smtp.gmail.com';  //SMTP servers
//    $mail->SMTPAuth = true; // Enable authentication
//    $mail->Username = 'tainguyen.9089@gmail.com';  // SMTP username
//    $mail->Password = 'lacty123';   // SMTP password
//    $mail->SMTPSecure = 'ssl';  // encryption TLS/SSL 
//    $mail->Port = 465;  // port to connect to                
//    $mail->setFrom('tainguyen.9089@gmail.com', 'Trường Học 8888');
//    $mail->addAddress('hieu.29975@lacty.com.vn', 'Chi Hieu'); //mail và tên người nhận       
//    $mail->isHTML(true);  // Set email format to HTML
//    $mail->Subject = 'Test Sending Mail';                
//    $mail->Body= 'test';
//    $mail->send();  

   $mail->SMTPDebug = 2;  // Enable verbose debug output
   $mail->isSMTP();  
   $mail->CharSet  = "utf-8";
   $mail->Host = '192.168.0.2';  //SMTP servers
   $mail->SMTPAuth = false; // Enable authentication
   $mail->Username = 'laiyih.communications';  // SMTP username
   $mail->Password = '#edc$rfv';   // SMTP password
//    $mail->SMTPSecure = 'ssl';  // encryption TLS/SSL 
   $mail->Port = 25;  // port to connect to                
   $mail->setFrom('laiyih.communications@lacty.com.vn', 'LYG');
   $mail->addAddress('hieu.29975@lacty.com.vn', 'Chi Hieu'); //mail và tên người nhận       
   $mail->isHTML(true);  // Set email format to HTML
   $mail->Subject = 'test';                
   $mail->Body= 'test';
  
   $mail->send();
   
} catch (Exception $e) {
    echo 'Mail không gửi được. Lỗi: ', $mail->ErrorInfo;
}
?>
<!-- [ breadcrumb ] start -->
<div class="page-header">
	<div class="page-block">
		<div class="row align-items-center">
			<div class="col-md-12">
				<div class="page-header-title">
					<h5>Mail Logs</h5>
				</div>
				<ul class="breadcrumb">
					<li class="breadcrumb-item"><a href="index.php"><i class="feather icon-mail"></i></a></li>
					<li class="breadcrumb-item"><a href="./modules/mail_log.php">Mail Logs</a></li>
				</ul>
			</div>
		</div>
	</div>
</div>
