<?php 

/**
 * User class for registration and login
 */
class User {

	private $con; 
	
	function __construct() {
		include_once('../database/db.php');
		$db = new Database(); 
		$this->con = $db->connect();

		// if ($this->con) {
		// 	echo "Connected Successfully";
		// }

	}


	private function emailExist($email) {
		//Using prepared statement to check if email already exist in the DB
		$pre_stmt = $this->con->prepare("SELECT id FROM users WHERE email = ?");
		$pre_stmt->bind_param("s", $email);
		$pre_stmt->execute() or die($this->con->error);
		//get result
		$result = $pre_stmt->get_result();
		if ($result->num_rows > 0) {
			return 1;
		} else {
			return 0;
		}
	}



	public function createUserAccount($username, $email, $password, $role) {

		if ($this->emailExist($email)) {

			return "Email Already Exist :(";

		} else {

				$pass_hash = password_hash($password, PASSWORD_BCRYPT, ["cost" => 8]);
				$register_date = date("Y-m-d");
				$last_login = date("Y-m-d h:m:s");
				$notes = "";

			$pre_stmt = $this->con->prepare("INSERT INTO `users`(`username`, `email`, `password`, `role`, `register_date`, `last_login`, `notes`)
			 VALUES (?, ?, ?, ?, ?, ?, ?)");
			$pre_stmt->bind_param("sssssss", $username, $email, $pass_hash, $role, $register_date, $last_login, $notes );
			$result = $pre_stmt->execute() or die ($this->con->error);

			if ($result) {
				return $this->con->insert_id;
			} else {
				return "REGISTRATION FAILED";
			}

		}

	}



	public function userLogin($email, $password) {

		$pre_stmt = $this->con->prepare("SELECT id, username, password, last_login FROM users WHERE email = ?");
		$pre_stmt->bind_param('s', $email);
		$pre_stmt->execute() or die($this->con->error);
		$result = $pre_stmt->get_result();

		if ($result->num_rows < 1) {
			 return "USER NOT REGISTERED";
		} else {
			$row = $result->fetch_assoc();

			if (password_verify($password, $row['password'])) {
				$_SESSION['id'] = $row['id'];
				$_SESSION['username'] = $row['username'];
				$_SESSION['last_login'] = $row['last_login'];

				$last_login = date("Y-m-d h:m:s");
				//once password is verified, update last login immediately
				$pre_stmt = $this->con->prepare("UPDATE users SET last_login = ? WHERE email = ?");
				$pre_stmt->bind_param("ss", $last_login, $email);
				$result = $pre_stmt->execute() or die($this->con->error);
				 
				if ($result) {
					return 1;
				} else {
					return 0;
				}

			} else {

				return "Password Mismatch Error";
			}
		}
	}



}

// $user = new User();
// echo $user-> createUserAccount("Drey", "drey@gmail.com", "dddddd", "Other");
// echo $user->userLogin("drey@gmail.com", "dddddd");

// echo $_SESSION['username'];

 ?>