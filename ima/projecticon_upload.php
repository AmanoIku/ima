<?php

include "upload_icon.php";

//ファイル関連の取得
$file = $_FILES['img'];
//ディレクトリトラバーサル（basename）
$filename = basename($file['name']);
$tmp_path = $file['tmp_name'];
$file_err = $file['error'];
$filesize = $file['size'];
$account = $_COOKIE["cookie"];
$upload_dir = $_COOKIE["cookie"].'/ '.$_COOKIE[$account].'/ ';  // sample/project_icon/画像.jpg
$upload_dir = str_replace(array(" ", "　"), "", $upload_dir);   // $upload_dir内の半角、全角スペースを全て消去
$save_filename = date('YmdHis') . $filename;    // ファイル名に日付をつける
$err_message = array();
$save_path = $upload_dir.$save_filename;
$project_name = $_COOKIE[$account];



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
    if(is_uploaded_file($tmp_path)){
        // move_uploaded_file — アップロードされたファイルを新しい位置に移動する
        if(move_uploaded_file($tmp_path, $save_path)) {
            // DBに保存する fileSave(ファイル名、ファイルパス）
            // fileSaveメソッド：ファイルを保存できた場合はTrue
            $result = fileSave($save_filename, $save_path);
            if($result){

                // $sql2 = "INSERT INTO '$_COOKIE[$account]'.project(project_iconname) VALUE('$save_filename')";
                $sql2 = "UPDATE project SET project_iconname ='$save_filename' WHERE project_name = '$project_name'";

                $result2 = dbc()->query($sql2);
                if ($result2) {
                    header("Location: project.php");
                    exit;
                }else{
                    echo "データベースへの保存が出来ませんでした。";
                }
            }else{
                echo "データベースへの保存が出来ませんでした。";
            }
        }else{
            echo "ファイルが保存できませんでした。";
        }
    }else{
        echo "ファイルが選択されていません。";
        echo "<br>";
    }
}else{
    foreach($err_message as $msg){
        echo $msg;
        echo "<br>";
    }
}

?>