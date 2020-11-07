<html>
<head><title> Login </title>
<?php session_start(); ?>
</head>


<?php
	require "connection.php";
	header('Content-Type: text/html; charset=utf-8');



	if(isset($_POST['login_btn'])){ //otan patithei to login button
		$login_username=!empty($_POST['uname']) ? trim($_POST['uname']):null;
		$login_password=!empty($_POST['psw']) ? trim($_POST['psw']):null;
		$message='';
		echo '<b>Δωσατε για username:</b>' .$login_username;
		echo'</br>';
		echo '<b>Δωσατε για password:</b>'.$login_password;
		echo'</br>';echo'</br>';

		if(empty($login_username) || empty($login_password)){
			$message = "Username/Password δεν μπορει να ειναι κενά!";
		}

		$sql = "SELECT username ,password, id_role, id_user
						FROM users
						WHERE username= '$login_username' ";

		$stmt = $conn ->prepare ($sql);

		$stmt->bindParam(':username',$login_username);
		$stmt->execute();


		$userRow1 = $stmt->fetch(PDO::FETCH_ASSOC);//true or false
		$isPasswordCorrect = password_verify($login_password, $userRow1['password']);

		if($stmt->rowCount() >= 1){ //ean yparxei



				//if($login_password==$userRow1['password']){
				if($isPasswordCorrect){
					$_SESSION['user_session']= $userRow1['username'];
					//$_SESSION['user_id']= $userRow1['id_user'];
					$_SESSION['user_role']= $userRow1['id_role'];

				  $_SESSION['user_id']=!empty($userRow1['id_user'])?trim($userRow1['id_user']):null;

					switch ($_SESSION['user_role']) {
						case "1":
							echo "tameio";
							header("Location: index_kouzina.php");
							break;
						case "2":
							echo "servitoros";
							  header("Location: index_serv.php");
							break;
						case "3":
							echo "marka";
							header("Location: index_marka.php");
							break;
						case "4":
							echo "idiokthths";
							header("Location: index_owner.php");
							break;
						default:
							echo "missing_role";
							header("Location: logout.php");
					}


				}else{
						die('Λαθος  username/password </br><INPUT TYPE="button" VALUE="Προσπαθήστε ξανά!" onClick="history.go(-1);">');
				}

		}else{//ean den yparxei
			echo 'den yparxei';
		}
	}

echo $_SESSION['user_id'];
echo $_SESSION['user_session'];

	?>
	</html>
