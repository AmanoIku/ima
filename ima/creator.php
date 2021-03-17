<?php
//データベース接続
include "db_conn.php";

// ？？？？？？冗長かも
$files = getAllFile();
$account = $_COOKIE["cookie"];

// ？？？？？？$sql2が冗長かも
$sql1 = "SELECT creator.creator_name, creator.introduction, creator.location FROM creator WHERE creator.user_name = '$account'";
$sql2 = "SELECT creator.creator_name, creator.creator_iconname FROM creator WHERE creator.user_name = '$account'";

$result1 = dbc()->query($sql1);
$result2 = dbc()->query($sql2);

// クエリー失敗
if(!$result1) {
    echo dbc()->error;
    exit;
}
if(!$result2) {
    echo dbc()->error;
    exit;
}

//連想配列で取得
while($row1 = $result1->fetch(PDO::FETCH_ASSOC)){
    $rows1[] = $row1;
}
while($row2 = $result2->fetch(PDO::FETCH_ASSOC)){
    $rows2[] = $row2;
}

//結果セットを解放
$row1 = null;
$row2 = null;

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
            <table class="table">
                <h1>クリエイター</h1>
                <?php
                if(isset($rows1)){
                //Invalid argument supplied for foreach()のエラーを(array)で回避
                    foreach((array)$rows1 as $row1){
                        foreach((array)$rows2 as $row2){
                            if($row1['creator_name'] == $row2['creator_name']){ // クリエイター名が同じであれば画像を表示させたい
                ?>
                    <tr><th><img src=".\<?php echo $_COOKIE['cookie']; ?>\<?php echo $row2['creator_name'];?>\<?php echo $row2['creator_iconname'];?>"></th></tr>
                    <tr><td>クリエイター名：<?php echo $row1['creator_name']; ?></td></tr>
                    <tr><td>自己紹介：<?php echo $row1['introduction']; ?></td></tr>
                    <tr><td>エリア：<?php echo $row1['location']; ?></td></tr>
                <?php
                            }
                        }
                    }
                }else{
                ?>
                    <a href="creatorRegist.php">クリエイターの登録がまだです</a>
                <?php
                }
                ?>
            </table>
        </div>
    </div>
<a href="creatorRegist.php">クリエイター登録する</a>

</div>
</body>
</html>