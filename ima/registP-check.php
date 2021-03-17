<?php
session_start();
include "db_conn.php";

if (isset($_POST['pname'])) {

	// ？？？？？？これはいるのか？
	function validate($data){
       $data = trim($data);
	   $data = stripslashes($data);
	   $data = htmlspecialchars($data);
	   return $data;
	}

	$id = validate($_POST['pid']);
	$pname = validate($_POST['pname']);
	$intro = validate($_POST['pexplan']);
	$occupation = validate($_POST['poccupation']);
	$location = validate($_POST['plocation']);
	$reward = validate($_POST['preward']);
	$deadline = validate($_POST['pdeadline']);
	$other = validate($_POST['pother']);
	$uname = $_COOKIE["cookie"];
	$project_icondri = $uname.'/ '.$pname;
	$project_icondri = str_replace(array(" ", "　"), "", $project_icondri);	// $project_icondri内の半角、全角スペースを全て消去

	//各データの有無のチェック
	if(empty($pname)) {
		header("Location: projectRegist.php?error=プロジェクト名が空欄です。");
		exit();
	}else{

		$sql1 = "SELECT * FROM project WHERE project_name='$pname'";

		$result1 = dbc()->query($sql1);

		if ($result1 -> rowCount() > 0) {
			header("Location: projectRegist.php?error=同じプロジェクト名が存在します。");
		}else{
			$sql2 = "INSERT INTO project(project_id, project_name, user_name, explanation, occupation, location, reward, deadline, other)
								  	VALUES('$id', '$pname', '$uname', '$intro', '$occupation', '$location', '$reward', '$deadline', '$other')";
			$result2 = dbc()->query($sql2);

			$sql3 = "INSERT INTO project_fav(project_name, fav_user, fav_state) VALUES('$pname', '$uname', '0')";
			$result3 = dbc()->query($sql3);

			if ($result2 || $result3) {
				// 0128にプロジェクト名でディレクトリを作成するプログラムを追加
				// アカウント名のディレクトリを作成：用途は画像の保存
				setcookie($uname,$pname ,time()+60*60*24*14);
				mkdir($project_icondri, 0777); 	// $project_icondri = $uname.'\ '.$pname;
				header("Location: projecticon_regist.php?success=プロジェクトの作成の完了");
				exit;
			}else{
				header("Location: projectRegist.php?error=予期せぬエラーです。");
				exit;
			}
		}
	}
}else{
	header("Location: projectRegist.php");
	exit;
}