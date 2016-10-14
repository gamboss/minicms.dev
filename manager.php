<!DOCTYPE html>
<html>
<head>
	<title>Авторизация</title>
	<link rel="stylesheet" type="text/css" href="css/auth.css">
</head>
<body>
	<form class="form-auth" method="post">
		<h1>Авторизация</h1>
	    <p class="clearfix">
	        <label for="login">Имя пользователя</label>
	        <input type="text" name="auth_login" id="auth_login" placeholder="Имя пользователя" required="true" maxlength="16">
	    </p>
	    <p class="clearfix">
	        <label for="password">Пароль</label>
	        <input type="password" name="auth_password" id="auth_password" placeholder="Пароль" required="true" minlength="5"> 
	    </p>

    	<div id="msg"></div>

	    <class="clearfix">
	        <input type="submit" name="sign_up" value="Войти">
	    </p>    
	</form>
	
	<script src="js/jquery-3.1.1.min.js"></script>
	<script src="js/site.js"></script>
</body>
</html>
