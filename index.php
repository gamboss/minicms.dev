<?php
	session_start();
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
		<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#add_admin_modal">Добавить пользователя</button>

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
						      		<input type="submit" name="add_admin" value="Добавить" class="btn btn-primary">
						      	</div>   
						    </div>						    
						</form>
					</div>
				</div>
			</div>
		</div>
	<?php endif; ?>
	<br />
		<input type="submit" name="add_block_partner" id="add_block_partner" value="Добавить элемент">
		<!-- BEGIN of block -->
		<div class="new_partners_block"></div>
		<input type="text" id="counter" style="display: none;">
		<!-- END of block -->

	<h1>Admin List</h1>	
	<div id="adminList"></div>
	<br />
	
	<script src="js/jquery-3.1.1.min.js"></script>
	<script src="js/jquery-tmpl.js"></script>
	<script src="js/site.js"></script>
	<script src="js/bootstrap.min.js"></script>
</body>
</html>
