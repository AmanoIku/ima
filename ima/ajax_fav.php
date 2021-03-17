<?php
//データベース接続
include "db_conn.php";

$msg = "";
$account = $_COOKIE['cookie'];
if(isset($_POST['cfavbtn'])){
    $moji1 = $_POST['cfavbtn'];
}else if(isset($_POST['cremove'])){
    $moji2 = $_POST['cremove'];
}else if(isset($_POST['pfavbtn'])){
    $moji3 = $_POST['pfavbtn'];
}else if(isset($_POST['premove'])){
    $moji4 = $_POST['premove'];
}else{
    exit;
}


if(isset($moji1)){
    // 初めて登録する際にinsert
    $sql1 = "SELECT * FROM creator_fav WHERE creator_name='$moji1' AND fav_user='$account'";
    $result1 = dbc()->query($sql1);

    if ($result1 -> rowCount() > 0) {
        // 既に登録されている時の処理
        // SQL記述欄（クリエイターfavstateを1⇒0）
        $sql2 ="UPDATE creator_fav SET creator_fav.fav_state = 1 WHERE creator_name='$moji1' AND fav_user='$account'";
        $result2 = dbc()->query($sql2);

        if(!$result2) {
            echo dbc()->error;
            exit;
        }else{
            $msg = "done";
        }

    }else{
        // まだ登録されていない時の処理
        // SQL記述欄（クリエイターfavstateを0⇒1）
        $sql3 = "INSERT INTO creator_fav(creator_name, fav_user, fav_state) VALUES('$moji1', '$account', '1')";
        $result3 = dbc()->query($sql3);
        if(!$result3) {
            echo dbc()->error;
            exit;
        }else{
            $msg = "done";
        }
    }
}else if(isset($moji2)){
    // 初めて登録する際にinsert文
    $sql4 = "SELECT * FROM creator_fav WHERE creator_name='$moji2' AND fav_user='$account'";
    $result4 = dbc()->query($sql4);

    if ($result4 -> rowCount() > 0) {
        // 既に登録されている時の処理
        // SQL記述欄（クリエイターfavstateを1⇒0）
        $sql5 = "UPDATE creator_fav SET creator_fav.fav_state = 0 WHERE creator_name='$moji2' AND fav_user='$account'";
        $result5 = dbc()->query($sql5);

        if(!$result5) {
            echo dbc()->error;
            exit;
        }else{
            $msg = "fav";
        }
    }else{
        // まだ登録されていない時の処理
        // SQL記述欄（クリエイターfavstateを0⇒1）
        $sql6 = "INSERT INTO creator_fav(creator_name, fav_user, fav_state) VALUES('$moji2', '$account', '0')";
        $result6 = dbc()->query($sql6);
        if(!$result6) {
            echo dbc()->error;
            exit;
        }else{
            $msg = "done";
        }
    }
}else if(isset($moji3)){
    // 初めて登録する際にinsert
    $sql7 = "SELECT * FROM project_fav WHERE project_name='$moji3' AND fav_user='$account'";
    $result7 = dbc()->query($sql7);

    if ($result7 -> rowCount() > 0) {
        // 既に登録されている時の処理
        // SQL記述欄（クリエイターfavstateを1⇒0）
        $sql8 ="UPDATE project_fav SET project_fav.fav_state = 1 WHERE project_name='$moji3' AND fav_user='$account'";
        $result8 = dbc()->query($sql8);

        if(!$result8) {
            echo dbc()->error;
            exit;
        }else{
            $msg = "done";
        }

    }else{
        // まだ登録されていない時の処理
        // SQL記述欄（クリエイターfavstateを0⇒1）
        $sql9 = "INSERT INTO project_fav(project_name, fav_user, fav_state) VALUES('$moji3', '$account', '1')";
        $result9 = dbc()->query($sql9);
        if(!$result9) {
            echo dbc()->error;
            exit;
        }else{
            $msg = "done";
        }
    }
}else if(isset($moji4)){
    // 初めて登録する際にinsert文
    $sql10 = "SELECT * FROM project_fav WHERE project_name='$moji4' AND fav_user='$account'";
    $result10 = dbc()->query($sql10);

    if ($result10 -> rowCount() > 0) {
        // 既に登録されている時の処理
        // SQL記述欄（クリエイターfavstateを1⇒0）
        $sql11 = "UPDATE project_fav SET project_fav.fav_state = 0 WHERE project_name='$moji4' AND fav_user='$account'";
        $result11 = dbc()->query($sql11);

        if(!$result11) {
            echo dbc()->error;
            exit;
        }else{
            $msg = "fav";
        }
    }else{
        // まだ登録されていない時の処理
        // SQL記述欄（クリエイターfavstateを0⇒1）
        $sql12 = "INSERT INTO project_fav(project_name, fav_user, fav_state) VALUES('$moji4', '$account', '0')";
        $result12 = dbc()->query($sql12);

        if(!$result12) {
            echo dbc()->error;
            exit;
        }else{
            $msg = "done";
        }
    }
}else{
    $msg = "error";
}

// JSON形式でデータを返すためには、PHPとして連想配列でデータをまとめる
$array = array("message"=>$msg);

// 連想配列をJSONにencodeする
echo json_encode($array);
?>