<?php 
	session_start();
	$_SESSION['message'] = null;
	$message = '';
	$error = '';
	$hash = null;	

	//Write new data into JSON file
	if (isset($_POST["add_admin"])) {
		if (empty($_POST["admin_name"])) {
			$error = "<p class='text-danger'>Введите логин</p>";
		}
		else if (empty($_POST["admin_password"])) {
			$error = "<p class='text-danger'>Введите пароль</p>";
		}
		else {
			if (file_exists('json/admin_list.json')) {
				$current_data = file_get_contents('json\admin_list.json');
				$array_data = json_decode($current_data, true);				
				
				//login check exist
				foreach ($array_data as $check) {
					$check_name = $check['admin_name'];
					if ($_POST['admin_name'] == $check_name) {
						$error = "<p class='text-danger'>Пользователь с таким именем уже существует!</p>";
					}
					else {
						$error = null;
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
					$hash = password_hash($_POST['admin_password'], PASSWORD_BCRYPT, array(
						'cost' => 12
					));
					
					$extra = array(
						'id' => 			$new_id,
						'admin_name' => 	$_POST['admin_name'],
						'admin_password' =>	$hash
					);

					$array_data[] = $extra;
					$final_data = json_encode($array_data);

					if (file_put_contents('json\admin_list.json', $final_data)) {
						$message = "<p class='text-success'>Пользователь добавлен</p>";
						header("Location: http://test.dev:1025/index.php");
						die();
					}
				}
			}
			else {
				$error = "<p class='text-danger'>JSON-файл не существует</p>";
			}			
		}
	}
?>