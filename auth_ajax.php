<?php
	//validation for auth form
	session_start();
	$_SESSION['current_user'] = null;
	$_SESSION['current_name'] = null;

	$auth_message = null;
	$auth_error = null;

	$auth_login = $_POST['authLogin'];
	$auth_password = $_POST['authPassword'];

	if (empty($auth_login)) {
		$auth_error = "<label id='text-danger'>Введите логин!</label>";
	}
	else if (preg_match('/[^A-Za-z0-9]/', $auth_login)) {
		$auth_error = "<label id='text-danger'>Логин должен сожержать только латинские символы и буквы!</label>";
	}
	else if (strlen($auth_login) > 16) {
		$auth_error = "<label id='text-danger'>Логин должен содержать максимум 16 символов!</label>";
	}
	else if (empty($auth_password)) {
		$auth_error = "<label id='text-danger'>Введите пароль!</label>";
	}
	else if (strlen($auth_password) < 5) {
		$auth_error = "<label id='text-danger'>Пароль должен содержать не менее 5 символов!</label>";
	}
	else {
		if (file_exists('json/admin_list.json')) {
			$current_data = file_get_contents('json\admin_list.json');
			$array_data = json_decode($current_data, true);
			foreach ($array_data as $check) {
				$check_name = $check['admin_name'];
				$check_password = $check['admin_password'];
				// check authorization
				if (($auth_login == $check_name) && (password_verify($auth_password, $check_password))) {
					$_SESSION['current_user'] = 'admin';
					$_SESSION['current_name'] = $check['admin_name'];

					$auth_message = "<label id='text-success'>Идет авторизация...</label>";
					$auth_error = null;
				}
				else {
					$auth_error = "<label id='text-danger'>Логин и пароль не совпадают!</label>";
				}
			}
		}
		else {
			$auth_error = "<label id='text-danger'>JSON файл не существует!</label>";
		}
	}

	//send ajax response to js
	$result = array(
		'auth_error' => $auth_error,
		'auth_message' => $auth_message
	);

	echo json_encode($result);
?>