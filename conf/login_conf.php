<?php  
	session_start();

	include 'conn.php';
	include 'function.php';

	if(isset($_POST['login'])){
		
		$username = words($_POST['username']);
		$password = encryptIt(words($_POST['password']));

		$identify=$link->query("SELECT * From gy_user Where gy_username='$username' AND gy_password='$password'");
		$count=$identify->num_rows;
		$row=$identify->fetch_array();

		if($count > 0){

			if ($row['gy_user_status'] == "1") {
				session_destroy();
				echo "
					<script>
						window.alert('Suspended Account!');
						window.location.href = '../'
					</script>
				";
			}else{

				if($row['gy_user_type'] == "0"){
					$_SESSION['ascu_online_user_id'] = $row['gy_user_id'];
					$_SESSION['ascu_online_user_type'] = $row['gy_user_type'];

		            my_notify("Login Notification", $row['gy_full_name']);
					header("location: ../content/admin/index");
				}else{
					session_destroy();
					echo "
						<script>
							window.alert('Undifined People!');
							window.location.href = '../?uname=$username'
						</script>
					";
				}
			}

		}else{
			session_destroy();
			echo "
				<script>
					window.alert('Access Failed!');
					window.location.href = '../?uname=$username'
				</script>
			";
		}
	}
?>