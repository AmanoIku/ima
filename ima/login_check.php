<?php
session_start();
include "db_conn.php";

if (isset($_POST['uname'],$_POST['password'])) {

	function validate($data){
       $data = trim($data);
	   $data = stripslashes($data);
	   $data = htmlspecialchars($data);
	   return $data;
	}

	$uname = validate($_POST['uname']);
	$pass = validate($_POST['password']);

	if (empty($uname)) {
		header("Location: login.php?error=ユーザー名を入力してください");
	    exit();
	}else if(empty($pass)){
        header("Location: login.php?error=パスワードを入力してください");
	    exit();
	}else{
		// パスワードのハッシュ化
        // $pass = md5($pass);

		$sql = "SELECT * FROM users WHERE user_name='$uname' AND password='$pass'";

		$result = dbc()->query($sql);

		$count = $result -> rowCount();
		if ($count === 1) {
			$row = $result -> fetch(PDO::FETCH_ASSOC);
            if ($row['user_name'] === $uname && $row['password'] === $pass) {
            	$_SESSION['user_name'] = $row['user_name'];
				$_SESSION['user_id'] = $row['user_id'];

            	header("Location: home.php");
		        exit();
            }else{
				header("Location: index.php?error=ユーザー名または、パスワードが正しくありません。");
		        exit();
			}
		}else{
			header("Location: index.php?error=ユーザー名または、パスワードが正しくありません。");
	        exit();
		}
	}
}else{
	header("Location: index.php?error=空欄があります。");
	exit();
}