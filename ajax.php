<?php
	$message = null;
	$error = null;

	//validation for add admin form
	$admin_login = $_POST['postLogin'];
	$admin_password = $_POST['postPassword'];
	$hash = null;

	if (empty($admin_login)) {
		$error = "<p class='text-danger'>Введите логин!</p>";
	}
	else if (preg_match('/[^A-Za-z0-9]/', $admin_login)) {
		$error = "<p class='text-danger'>Логин должен сожержать только латинские символы и буквы!</p>";
	}
	else if (strlen($admin_login) > 16) {
		$error = "<p class='text-danger'>Логин должен содержать максимум 16 символов!</p>";
	}
	else if (empty($admin_password)) {
		$error = "<p class='text-danger'>Введите пароль!</p>";
	}
	else if (strlen($admin_password) < 5) {
		$error = "<p class='text-danger'>Пароль должен содержать не менее 5 символов!</p>";
	}
	else {
		if (file_exists('json/admin_list.json')) {
			$current_data = file_get_contents('json\admin_list.json');
			$array_data = json_decode($current_data, true);				
			
			//login check exist
			foreach ($array_data as $check) {
				$check_name = $check['admin_name'];
				if ($admin_login == $check_name) {
					$error = "<p class='text-danger'>Пользователь с таким именем уже существует!</p>";
				}
			}				

			if ($error == null) {
				// Generate auto increment ID
				$tmp = 0;
				foreach ($array_data as $value) {
					$output = $value['id'];
					if ($tmp < $output) {
						$tmp = $output;
					}
				}
				$new_id = $tmp + 1;

				//password hash
				$hash = password_hash($admin_password, PASSWORD_BCRYPT, array(
					'cost' => 12
				));
				
				$extra = array(
					'id' => 			$new_id,
					'admin_name' => 	$admin_login,
					'admin_password' =>	$hash
				);

				$array_data[] = $extra;
				$final_data = json_encode($array_data);

				if (file_put_contents('json\admin_list.json', $final_data)) {
					$message = "<p class='text-success'>Пользователь добавлен</p>";
				}
			}
		}
		else {
			$error = "<p class='text-danger'>JSON-файл не существует</p>";
		}			
	}

	//send ajax response to js
	$result = array(
		'error' => $error,
		'message' => $message
	);

	echo json_encode($result);
?>
