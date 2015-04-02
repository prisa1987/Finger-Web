<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<?php echo css_asset('forgotpassword-css.css');?>
</head>
<body>
	<div id="container">
	<!-- 	<?php echo $header;?> -->
		<div id="body">
			<div id="content">
				<?php echo form_open("auth/forgot_password");?>
				<div id="forgot">
					<h2>Forgot Password</h2>
					<fieldset>
					    <p>
					      <label for="email">E-mail address: </label>
					      <input  type="email" name="email" id="email" >
					    </p>
					    <p>
					      <input type="submit" id="submitbtn" value="Submit">
					    </p>
					</fieldset>
				</div>
				<?php echo form_close();?>
			</div>
		</div>
	</div>
</body>
</html>

