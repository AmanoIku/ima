<?php
//データベース接続
include "db_conn.php";

$files = getAllFile();
$account = $_COOKIE["cookie"];

// ？？？？？？users.が冗長かも
$sql = "SELECT * FROM users WHERE users.user_name = '$account'";
$result = dbc()->query($sql);
// // creator.user_name = '$account'
// $sql1 = "SELECT creator.creator_name, creator.user_name FROM creator WHERE creator.user_name = '$account'";
// $result1 = dbc()->query($sql1);
// // project.user_name = '$account'
// $sql2 = "SELECT project.creator_name, FROM project WHERE project.user_name = '$account'";
// $result2 = dbc()->query($sql2);
// SQL記述欄（クリエイター）
$sql1 = "SELECT * FROM creator WHERE creator.user_name = '$account'";
$result1 = dbc()->query($sql1);
// SQL記述欄（プロジェクト）
$sql2 = "SELECT * FROM project WHERE project.user_name = '$account'";
$result2 = dbc()->query($sql2);
// creator_nameが同じだったら表示
$sql3 = "SELECT * FROM creator_fav WHERE creator_fav.creator_name = '$account'";
$result3 = dbc()->query($sql3);
// project_nameが同じだったら表示
$sql4 = "SELECT * FROM project_fav WHERE project_fav.project_name = '$account'";
$result4 = dbc()->query($sql4);

// クエリー失敗時
if(!$result) {
    echo dbc()->error;
    exit();
}
if(!$result1) {
    echo dbc()->error;
    exit();
}
if(!$result2) {
    echo dbc()->error;
    exit();
}
if(!$result3) {
    echo dbc()->error;
    exit();
}
if(!$result4) {
    echo dbc()->error;
    exit();
}

//連想配列で取得
while($row = $result->fetch(PDO::FETCH_ASSOC)){
    $rows[] = $row;
}
while($row1 = $result1->fetch(PDO::FETCH_ASSOC)){
    $rows1[] = $row1;
}
while($row2 = $result2->fetch(PDO::FETCH_ASSOC)){
    $rows2[] = $row2;
}
while($row3 = $result3->fetch(PDO::FETCH_ASSOC)){
    $rows3[] = $row3;
}
while($row4 = $result4->fetch(PDO::FETCH_ASSOC)){
    $rows4[] = $row4;
}

//結果セットを解放
$row = null;
$row1 = null;
$row2 = null;
$row3 = null;
$row4 = null;

// データベース切断
$pdo = null;
?>

<!DOCTYPE html>
<html>
<head>
	<title>ima</title>
     <meta charset="utf-8">
     <meta http-equiv="X-UA-Compatible" content="IE=edge">
     <meta name="viewport" content="width=device-width, initial-scale=1">
     <!-- BootstrapのCSS読み込み -->
     <link href="css/bootstrap.min.css" rel="stylesheet">
     <!-- BootstrapのJS読み込み -->
     <script src="js/bootstrap.min.js"></script>
     <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
     <script src="js/script.js"></script>
     <link rel="stylesheet" href="css/style.css">
</head>
<body>

<!-- ホームページの開始タグ -->
<div class="container">
    <!-- ヘッダー開始 -->
    <header class="site-header sticky-top py-1 bg-white">
        <h2 class="heading6">-ima-</h2>
        <nav class="container d-flex flex-column flex-md-row justify-content-between bg-white">
            <a href="home.php" class="button-17">ホームページ</a>
            <a href="mypage.php" class="button-17">マイページ</a>
            <a href="newStep.php" class="button-17">登録</a>
            <a href="logout.php" class="button-17">ログアウト</a>
            <form class="d-flex">
                <input class="form-control me-2 bg-brack" type="search" placeholder="Search" aria-label="Search">
                <button class="btn btn-outline-success" type="submit">Search</button>
            </form>
        </nav>
    </header>
    <!-- ヘッダー終了 -->

    <div class="row">
        <div class="col">
            <div class="card">
                <?php
                    //Invalid argument supplied for foreach()を(array)を書き、回避
                    foreach((array)$rows as $row){
                ?>
                    <div>
                        <img src=".\<?php echo $_COOKIE['cookie'] ?>\user_icon\<?php echo $row['mypage_iconname']?>">
                        <?php echo 'ユーザー名：'. htmlspecialchars($row['user_name'],ENT_QUOTES,'UTF-8'); ?>
                    </div>
                <?php
                    }
                ?>
                    <!-- 画像登録開始 -->
                    <section id="modal" class="hidden">
                        <!--アイコン登録欄-->
                        <form enctype="multipart/form-data" action="mypageicon_upload.php" method="POST">

                            <input type="hidden" name="MAX_FILE_SIZE" value="1048576" />
                            <input name="img" type="file" accept="image/*" /><br>

                            <div id="close">
                            <input type="submit" name="save" value="変更" class="btn" />
                            </div>
                        </form>
                    </section>
                    <!-- 画像登録終了 -->
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col">
            <!-- クリエイターの開始タグ -->
            <div class="card">
                <p>お気に入りしたクリエイター一覧</p>
                <?php
                foreach((array)$rows as $row){
                //Invalid argument supplied for foreach()を(array)で回避
                    foreach((array)$rows1 as $row1){
                        if($row['user_name'] == $row1['user_name']){ // クリエイターのユーザー名が同じであれば画像を表示させたい
                            $sample = $row1['creator_name'];
                        ?>
                            <div class="creator_account">
                                <table class="table">
                                    <!-- クリエイター名のディレクトリから画像を取得 -->
                                    <img src=".\<?php echo $row1['user_name']; ?>\<?php echo $row1['creator_name']; ?>\<?php echo $row1['creator_iconname']; ?>"><br><br>
                                    <tr><th>クリエイター名：<?php echo $row1['creator_name']; ?></th></tr>
                                    <tr><td>自己紹介：<?php echo $row1['introduction']; ?></td></tr>
                                    <tr><td>エリア：<?php echo $row1['location']; ?></td></tr>
                                    <tr><td>

                                    <!-- 以下クリエイターのいいねボタン -->
                                    <?php?>
                                    <!-- 以上クリエイターのいいねボタン -->
                                    </td></tr>
                                </table>
                            </div>
                        <?php
                        }
                    }
                }
                ?>
            </div>
            <!-- クリエイターの終了タグ -->
        </div>

        <!-- プロジェクトの開始タグ -->
        <div class="col">
            <div class="card">
                <p>お気に入りしたプロジェクト一覧</p>
                <?php
                foreach((array)$rows as $row){
                    //Invalid argument supplied for foreach()を(array)で回避
                    foreach((array)$rows2 as $row2){
                        if($row['user_name'] == $row2['user_name']){ // プロジェクトのユーザー名が同じであれば画像を表示させたい
                ?>
                            <div class="project_account">
                                <table class="table">
                                <!-- プロジェクト名のディレクトリから画像を取得 -->
                                    <img src=".\<?php echo $row2['user_name']; ?>\<?php echo $row2['project_name']; ?>\<?php echo $row2['project_iconname']; ?>"><br><br>
                                    <tr><th>プロジェクト名：<?php echo $row2['project_name']; ?></th></tr>
                                    <tr><td>概要欄：<?php echo $row2['explanation']; ?></td></tr>
                                    <tr><td>
                                        募集メンバー：
                                        <?php
                                        if( $row2['occupation'] = 1 ){
                                            echo "カメラマン";
                                        }elseif( $row2['occupation'] = 2 ){
                                            echo "モデル";
                                        }elseif( $row2['occupation'] = 3 ){
                                            echo "ヘアーアーティスト";
                                        }else{
                                            echo "エラーあり";
                                        }
                                        ?>
                                        </td></tr>
                                        <tr><td>エリア：<?php echo $row2['location']; ?></td></tr>
                                        <tr><td>報酬：<?php echo $row2['reward']; ?></td></tr>
                                        <tr><td>
                                        <!-- 以下プロジェクトのいいねボタン -->
                                        <?php?>
                                        <!-- 以上プロジェクトのいいねボタン -->
                                    </td></tr>
                                </table>
                            </div>
                <?php
                        }
                    }
                }
                ?>
            </div>
            <!-- プロジェクトの終了タグ -->
        </div>
    </div>
</div>
</body>
</html>