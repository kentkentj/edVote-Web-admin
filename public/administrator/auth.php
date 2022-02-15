<?php 
session_start();
include '../../loginConfig.php';

if (isset($_POST['email']) && isset($_POST['password'])) {
	
	$email = $_POST['email'];
	$password = $_POST['password'];

	if (empty($email)) {
		header("Location: login.php?error=Email is required");
	}else if (empty($password)){
		header("Location: login.php?error=Password is required&email=$email");
	}else {
		$stmt = $conn->prepare("SELECT * FROM admin_account WHERE admin_employee_id=?");
		$stmt->execute([$email]);

		if ($stmt->rowCount() === 1) {
			$user = $stmt->fetch();

			$user_id = $user['admin_user_id'];
			$user_email = $user['admin_employee_id'];
			$user_password = $user['password'];
			$user_full_name = $user['full_name'];
            $user_department = $user['depatment_name'];
            $user_school = $user['school_name'];
            $user_profile = $user['account_profile'];
            $user_account_status = $user['account_status'];
            $user_admin_type = $user['admin_type'];
			if ($email === $user_email) {
				if (password_verify($password, $user_password)) {
					if($user_account_status == 'active' && $user_admin_type == 'administrator'){
						$_SESSION['user_id'] = $user_id;
						$_SESSION['user_email'] = $user_email;
						$_SESSION['user_full_name'] = $user_full_name;
						$_SESSION['depatment_name'] = $user_department;
						$_SESSION['school_name'] = $user_school;
						$_SESSION['account_status'] = $user_account_status;
						$_SESSION['admin_type'] = $user_admin_type;
						
						header("Location: /edVoteAdmin/public/administrator/");
					} elseif($user_account_status != 'active'){
						header("Location: login.php?error= Your account has been deactivated");
					} elseif($user_admin_type != 'admin'){
						header("Location: login.php?error= Ops! your are not System Administrator");
					} 

				}else {
					header("Location: login.php?error=Incorect User name or password&email=$email");
				}
			}else {
				header("Location: login.php?error=Incorect User name or password&email=$email");
			}
		}else {
			header("Location: login.php?error=Incorect User name or password&email=$email");
		}
	}
}