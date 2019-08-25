<?php
		//Alert Vars
		$msg = '';
		$msgClass = '';

		//check for submit
		if(filter_has_var(INPUT_POST, 'submit')){
			$name = htmlspecialchars($_POST['name']);
			$email = htmlspecialchars($_POST['email']);
			$website = htmlspecialchars($_POST['website']);
			$message = htmlspecialchars($_POST['message']);

			//check reqd fields
			if(!empty($name) && !empty($email)){
				//pass
				//Check Email
				if(filter_var($email,FILTER_VALIDATE_EMAIL) === false){
					//FAIL
					$msg = 'Please use a valid email';
					$msgClass = 'alert-danger';					

				}else{
					//PASS
					$toEmail = 'info@jsnetware.com';
					$subject = 'Query from JSNETware: ' .$name;
					$body = '<h2>Contact Request</h2>
							 <h4>Name: </h4> <p>'.$name.'</p>
							 <h4>Email: <p>'.$email.'</p></h4>
							 <h4>Website: <p>'.$website.'</p></h4>
							 <h4>Message: </h4><p>'.$message.'</p>';

					$headers = "MIME-Version: 1.0" . "\r\n";
					$headers .="Content-Type:text/html;charset=UTF-8" . "\r\n";

					$headers .= "From: " .$name. "<".$email.">". "\r\n";

					if(mail($toEmail, $subject, $body, $headers)){
						$msg = 'Your Email has been sent.';
						$msgClass = 'alert-success';
					}else{
						$msg = 'Oops, There was a problem...';
						$msgClass = 'alert-danger';						
					}
				}


			}else{
			//fail
			$msg = 'Please fill in required fields';
			$msgClass = 'alert-danger';

			}

		}

?>

<!DOCTYPE html>
<html lang="en">
<head>

	<?php require 'COMPONENTS/HEAD/CONTACT.php'; ?>

</head>

<body>

	</div>

	<?php require 'COMPONENTS/HEADER/header.php'; ?>

	<?php require 'COMPONENTS/NAVBAR/navbar.php'; ?>

	<div class="container-fluid p-0">

		<div class="row mt-5">

			<div class="px-5 col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12 text-center">

				<p class="titleB" style="font-weight:600;">Contact</p>

			</div>

			<div class="px-5 col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12 text-center">

				<p class="titleB" style="font-weight:600;">Need help with a web app or website? Please contact us!</p>

			</div>


	</div>

<div class="container-fluid mb-4">	

	<div class="row align-items-center justify-content-center">

			<?php if($msg != ''): ?>

			 <div class="alert <?php echo $msgClass; ?>"><?php echo $msg; ?></div>

			 <?php endif; ?>

	</div>

</div>

<div class="container-fluid mb-4">

	<div class="row justify-content-center">

			<form style="width:60%" method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">

				<div class="form-group">	

					<label style="font-weight:600; font-size:3vh;">Name: <span style="color:red;">*Required</span></label>
					<input type="text" name="name" class="form-control" value="<?php echo isset($_POST['name']) ? $name : ''; ?>">

				</div>

				<div class="form-group">	

					<label style="font-weight:600; font-size:3vh;">Email <span style="color:red;">*Required</span></label>
					<input type="text" name="email" class="form-control" value="<?php echo isset($_POST['email']) ? $email : ''; ?>">

				</div>

				<div class="form-group">	

					<label style="font-weight:600; font-size:3vh;">Website/ Web App Address</label>
					<input type="text" name="website" class="form-control" value="<?php echo isset($_POST['website']) ? $website : ''; ?>">

				</div>

				<div class="form-group">	

					<label style="font-weight:600; font-size:3vh;">What service(s) do you need?</label>
					<textarea name="message" class="form-control" value="" rows="6"><?php echo isset($_POST['message']) ? $message : ''; ?></textarea>

				</div>	

				<br>

				<button type="submit" name="submit" class="btn btn-primary">Submit</button>	

			</form>


	</div>

</div>