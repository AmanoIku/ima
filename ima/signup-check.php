<?php
session_start();
include "db_conn.php";
dbc();

if (isset($_POST['uname']) && isset($_POST['password'])) {

	function validate($data){
       $data = trim($data);
	   $data = stripslashes($data);
	   $data = htmlspecialchars($data);
	   return $data;
	}

	// $id = validate($_POST['uid']);
	$uname = validate($_POST['uname']);
	$pass = validate($_POST['password']);
	$re_pass = validate($_POST['re_password']);
	$mail = validate($_POST['umail']);
	// 以下ユーザー登録時に作成するディレクトリ
	$user_icondri = $uname."/ "."user_icon";
	$user_icondri = str_replace(array(" ", "　"), "", $user_icondri);	// $user_icondri内の半角、全角スペースを全て消去
	// $user_project_icondri = $uname."/project_icon";
	// $user_creator_icondri = $uname."/creator_icon";

	if (empty($uname)) {
		header("Location: signup.php?error=ユーザー名を入力してください。");
	    exit();
	}else if(empty($pass)){
        header("Location: signup.php?error=パスワードを入力してください。");
	    exit();
	}else if(empty($re_pass)){
        header("Location: signup.php?error=パスワード(確認)を入力してください。");
	    exit();
	}else if($pass !== $re_pass){
        header("Location: signup.php?error=パスワードが一致しません。");
	    exit();
	}else{

		// パスワードのハッシュ化
        // $pass = md5($pass);

		$sql1 = "SELECT * FROM users WHERE user_name='$uname'";
		$result1 = dbc()->query($sql1);

		if ($result1 -> rowCount() > 0) {
			header("Location: signup.php?error=アカウントは既に存在してます。");
	        exit();
		}else{
			$sql2 = "INSERT INTO users(user_name, password, mail) VALUES('$uname', '$pass', '$mail')";

			$result2 = dbc()->query($sql2);
			if ($result2) {
				setcookie("cookie",$uname,time()+60*60*24*14);
				header("Location: signup.php");
				// アカウント名のディレクトリを作成：用途は画像の保存
				mkdir($uname, 0777);
				mkdir($user_icondri, 0777);				//$user_icondri = $uname."\ user_icon";
				// mkdir($user_project_icondri, 0777);		//$user_project_icondri = $uname."\ project_icon";
				// mkdir($user_creator_icondri, 0777);		//$user_creator_icondri = $uname."\ creator_icon";
				exit();
			}else{
				header("Location: signup.php?error=予期せぬエラーです。");
				exit();
			}
		}
	}
}else{
	header("Location: signup.php");
	exit();
}