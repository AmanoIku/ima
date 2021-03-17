<?php

//session_start();//セッションスタート
include "upload_icon.php";

//ファイル関連の取得
$file = $_FILES['img'];
//ディレクトリトラバーサル（basename）
$filename = basename($file['name']);
$tmp_path = $file['tmp_name'];
$file_err = $file['error'];
$filesize = $file['size'];
$upload_dir = $_COOKIE["cookie"].'/';
// ユーザー名のディレクトリを作成する：$_COOKIE["cookie"]
//ファイル名に日付をつける
$save_filename = date('YmdHis') . $filename;
$err_message = array();
// $save_path = $upload_dir.$save_filename;
// $save_path = $_COOKIE["cookie"].$save_filename;'/'
$save_path = $upload_dir.$save_filename;



//ファイルのバリデーション
//ファイルサイズが1MB未満か
if($filesize > 1048576 || $file_err == 2) {
    array_push($err_message, "ファイルサイズは1MB未満にしてください。");
    echo "<br>";
}

//拡張は画像形式かどうか
$allow_ext = array("jpg", "jpeg", "png");
//拡張子の取得（PATHINFO_EXTENSION）
$file_ext = pathinfo($filename, PATHINFO_EXTENSION);

//配列内に存在するかどうか（strtolowerですべて小文字化）
if(!in_array(strtolower($file_ext), $allow_ext)) {
    array_push($err_message, "画像ファイルを添付してください。");
    echo "<br>";
}

if(count($err_message) === 0){
// is_uploaded_file — HTTP POST でアップロードされたファイルかどうかを調べる
    if(is_uploaded_file($tmp_path)) {
        // move_uploaded_file — アップロードされたファイルを新しい位置に移動する
        if(move_uploaded_file($tmp_path, $save_path)) {
            // DBに保存する fileSave(ファイル名、ファイルパス）
            // fileSaveメソッド：ファイルを保存できた場合はTrue
            $result = fileSave($save_filename, $save_path);

            if($result){
                //$_SESSION['$upload_btn'] ="アップロード完了";//セッション変数に登録
                header("Location: upload.php");
                exit;
            }else{
                echo "データベースへの保存が出来ませんでした。";
            }
        }else{
            echo "ファイルが保存できませんでした。";
        }
    } else {
        echo "ファイルが選択されていません。";
        echo "<br>";
    }
} else {
    foreach($err_message as $msg){
        echo $msg;
        echo "<br>";
    }
}

?>