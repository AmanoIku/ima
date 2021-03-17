<?php
session_start();
include "db_conn.php";

if (isset($_POST['cname'])) {

	// ？？？？？？これはいるのか？
	function validate($data){
       $data = trim($data);
	   $data = stripslashes($data);
	   $data = htmlspecialchars($data);
	   return $data;
	}

	$id = validate($_POST['cid']);
	$cname = validate($_POST['cname']);
	$intro = validate($_POST['cintro']);
	$location = validate($_POST['pref_name']);	// $location = validate($_POST['clocation']);
	$uname = $_COOKIE["cookie"];
	$creator_icondri = "./ ".$uname.'/ '.$cname;
	$creator_icondri = str_replace(array(" ", "　"), "", $creator_icondri);	// $creator_icondri内の半角、全角スペースを全て消去

	//各データの有無のチェック
	// if (empty($id)){
	// 		header("Location: creatorRegist.php?error=クリエイターIDが空欄です。");
	// 		exit();
	// }else
	if(empty($cname)) {
		header("Location: creatorRegist.php?error=クリエイター名が空欄です。");
		exit;
	}else{

		$sql1 = "SELECT * FROM creator WHERE creator_name='$cname'";

		$result1 = dbc()->query($sql1);

		if ($result1 -> rowCount() > 0) {
			header("Location: creatorRegist.php?error=同じクリエイター名が存在します。");
		}else{
			$sql2 = "INSERT INTO creator(creator_name, user_name, introduction, location)
									VALUES('$cname', '$uname', '$intro', '$location')";
			$result2 = dbc()->query($sql2);

			$sql3 = "INSERT INTO creator_fav(creator_name, fav_user, fav_state) VALUES('$cname', '$uname', '0')";
			$result3 = dbc()->query($sql3);

			if ($result2 || $result3) {
				header("Location: creatoricon_regist.php?success=プロジェクトの作成の完了");
				// 0128にクリエイター名でディレクトリを作成するプログラムを追加
				// クリエイター名のディレクトリを作成：用途は画像の保存
				setcookie($uname,$cname ,time()+60*60*24*14);
				mkdir($creator_icondri, 0777);
				exit;
			}else{
				header("Location: creatorRegist.php?error=予期せぬエラーです。");
				exit;
			}
		}
	}
}else{
	header("Location: creatorRegist.php");
	exit;
}