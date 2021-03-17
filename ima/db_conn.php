<?php

function dbc(){
	// 1. 変数の宣言(ローカル環境)
	// $dsn  = "mysql:dbname=hew2020_95100;host=localhost;charset=utf8mb4";
	// $uname = "root";
	// $password = "";

	// 1. 変数の宣言
	// データベースサーバ
	$host = "mysql57.chichester2021.sakura.ne.jp";
	// データベース名
	$dbName = "chichester2021_ima";
	// ユーザ名
	$uname = "chichester2021";
	// 接続先パスワード
	// $password = "";
	$password = "hal2021hal";
	$dsn = "mysql:host={$host};dbname={$dbName};charset=utf8mb4";

	// 2. データベース接続
	try{
		$pdo = new PDO($dsn,$uname,$password,
		[
			PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
			PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
		]);
		return $pdo;
	} catch (PDOException $e) {
		exit("データベースに接続できませんでした" . $e->getMessage());
	}
}

/*
	ファイルデータの保存
	@param string $filename ファイル名
	@param string $save_path 保存先
	@return bool   $result
*/
function fileSave($save_filename, $save_path){
	$result = false;

	$sql ="INSERT INTO file_table(file_name, file_path) VALUE(?,?)";

	try{
		//sqlの準備
		$stmt = dbc()->prepare($sql);
		//内に以下を順に代入（悪意のある入力があった際にエスケープしてくれる）
		$stmt->bindValue(1, $save_filename);
		$stmt->bindValue(2, $save_path);
		$result = $stmt->execute();

		return $result;
	}catch(\Exeception $e){
		echo "データベースに接続できませんでした。" . $e->getMessage();
		return $result;
	}
}

/*
	ファイルデータを取得
	@return array  $fileData
*/
function getAllFile(){
	$sql = "SELECT * FROM file_table ORDER BY insert_time DESC LIMIT 1";

	$fileData = dbc()->query($sql);

	return $fileData;
}

function h($s){
	return htmlspecialchars($s, ENT_QUOTES, "UTF-8");
}