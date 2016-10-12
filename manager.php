<?php 
	session_start();
	$_SESSION['current_user'] = null;
	$_SESSION['current_name'] = null;
	
	$message = '';
	$error = '';

	if (isset($_POST["sign_up"])) {
		if (empty($_POST["admin_name"])) {
			$error = "<label class='text-danger'>Enter Login</label>";
		}
		else if (empty($_POST["admin_password"])) {
			$error = "<label class='text-danger'>Enter password</label>";
		}
		else {
			if (file_exists('json/admin_list.json')) {
				$current_data = file_get_contents('json\admin_list.json');
				$array_data = json_decode($current_data, true);
				foreach ($array_data as $check) {
					$check_name = $check['admin_name'];
					$check_password = $check['admin_password'];
					// check authorization
					if (($_POST['admin_name'] == $check_name) && (password_verify($_POST['admin_password'], $check_password))) {
						$_SESSION['current_user'] = 'admin';
						$_SESSION['current_name'] = $check['admin_name'];
						header("Location: http://minicms.dev:1025/index.php");
						die();
					}
					else {
						$error = "<label class='text-danger'>Please enter the correct login and password!</label>";
					}
				}
			}
			else {
				$error = "<label class='text-danger'>JSON file does not exist</label>";
			}
		}
	}
?>
<!DOCTYPE html>
<html>
<head>
	<title>Sign up</title>
	<link rel="stylesheet" type="text/css" href="css/style.css">
</head>
<body>
	<h1>Authorize</h1>
	<div class="auth">
		<form method="post">
		<?php 
			if (isset($error)) {
				echo $error;
			}
		?>
		<br />
			<label>Enter Login - </label>
			<input type="text" name="admin_name" id="admin_name"> <br />
			<label>Enter Password - </label>
			<input type="password" name="admin_password" id="admin_password"> <br />
			<input type="submit" name="sign_up" value="Sign up">
		<?php 
			if (isset($message)) {
				echo $message;
			}
		?>
		</form>
	</div>
</body>
</html>