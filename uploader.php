<?php
	$error_file = '';
	$success = '';
	
	if (isset($_POST["upload"])) {
		$file = $_FILES['upload_image'];

		//file properities
		$file_name = $file['name'];
		$file_tmp = $file['tmp_name'];
		$file_error = $file['error'];

		//file extensions
		$file_ext = explode('.', $file_name);
		$file_ext = strtolower(end($file_ext));

		//rules for validation
		$allowed = array('jpg', 'jpeg', 'png', 'bmp', 'svg');
		$validSize = array(
				'width' => 400,
				'height' => 400
			);		

		// Image validation by width and height 
		function checkValidSize($file_tmp, $validSize){
		    $sizeImg = getimagesize($file_tmp);
		    if(!$sizeImg) return false;
		    if($validSize['width'] == $sizeImg[0] && $validSize['height'] == $sizeImg[1] ){
		        return true;
		    }
		    return false;
		}
		
		//Upload files
		if (in_array($file_ext, $allowed)) {
			if ($file_error === 0) {	
				if (checkValidSize($file_tmp, $validSize)) {
					
					$file_new_name = uniqid('', true) . '.' . $file_ext;
					$file_destination = 'img/' . $file_new_name;

					if (move_uploaded_file($file_tmp, $file_destination)) {
						$success = $file_destination;
					}
				}
				else {				
					$error_file = '<label class="text-danger">Image size must be 400x400 px!</label>';
				}
			}
		}
		else {
			$error_file = '<label class="text-danger">Image format must be JPG, JPEG, PNG, BMP OR SVG!</label>';
		}
	}
?>