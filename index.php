<?php
	session_start();
	include 'comands.php';
	include 'uploader.php';
?>
<!DOCTYPE html>
<html>
<head>
	<title>Система управления для одностраничных сайтов</title>
	<link rel="stylesheet" type="text/css" href="css/style.css">
	<link rel="stylesheet" type="text/css" href="css/bootstrap.css">
	<script type="text/x-jquery-tmpl" id="data">	
		<p>${id}</p>
		<p>${admin_name}</p>
		<p>${admin_password}</p>
	</script>
</head>
<body>

	<h1>Название сайта</h1>
	<?php if ($_SESSION['current_user'] == 'admin'): ?>
		<h4>Здравствуйте, <?php echo $_SESSION['current_name']; ?>!</h4>
		<a href="logout.php">Выйти</a>
		<br />
		<!-- Open modal -->
		<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#add_admin_modal">Activate modal</button>

		<div class="modal fade" id="add_admin_modal">
			<div class="modal-dialog">
				<div class="modal-content">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal">&times;</button>
						<h3 class="modal-title">Добавление пользователя</h3>
					</div>
					<div class="modal-body">
						<!-- Start form -->
						<form class="form-horizontal" id="add_admin_form" method="post">
						    <div class="form-group">
						      	<label for="admin_name" class="col-lg-2 control-label">Введите логин</label>
						      	<div class="col-lg-10">
						        	<input type="text" name="admin_name" class="form-control" id="admin_name" required="true" maxlength="16">
						      	</div>
						    </div>
						    <div class="form-group">
						      	<label for="admin_password" class="col-lg-2 control-label">Введите пароль</label>
								<div class="col-lg-10">
						        	<input type="password" name="admin_password" class="form-control" id="admin_password" required="true" minlength="5">
						      	</div>
						    </div>
						    <div class="form-group">
						    	<p id="msg"></p>
					    	</div>
						    <div class="form-group">
						      	<div class="col-lg-10 col-lg-offset-2">
						      		<input type="submit" name="add_admin1" value="Добавить" class="btn btn-primary">
						      	</div>   
						    </div>						    
						</form>
					</div>
				</div>
			</div>
		</div>
		<!-- <div class="admin_create">
			<form method="post">
			<?php 
				if (isset($error)) {
					echo $error;
				}
			?>
			<br />
				<label>Login - </label>
				<input type="text" name="admin_name" id="admin_name" required="true" maxlength="16"> <br />
				<label>Password - </label>
				<input type="password" name="admin_password" id="admin_password" required="true" minlength="5"> <br />
				<input type="submit" name="add_admin" value="Add admin" class="btn btn-primary">
			<?php
				if (isset($message)) {
					echo $message;
				}
			?>
			</form>
		</div> -->
	<?php endif; ?>

	<h1>Add partner</h1>
	<form method="post" enctype="multipart/form-data">
		<label>Enter company name</label>
		<input type="text" maxlength="32" name="company_name" id="company_name" required="true"></input> <br />
		<label>Enter text about company</label>
		<textarea name="company_about" id="company_about" required="true"></textarea> <br />
		<label>Upload company img. Only 400x400!</label>
		<input type="file" name="upload_image" id="upload_image" required="true"></input> <br />
		<input type="submit" name="upload" value="Upload"></input>

		<?php
			if (isset($success)) {
				echo $success;
			} 
			if (isset($error_file)) {
				echo $error_file;
				$error_file = null;
			}
		?>
	</form>

	<h1>Admin List</h1>	
	<div id="adminList"></div>
	<br />
	
	<script src="js/jquery-3.1.1.min.js"></script>
	<script src="js/jquery-tmpl.js"></script>
	<script src="js/site.js"></script>
	<script src="js/bootstrap.min.js"></script>
</body>
</html>