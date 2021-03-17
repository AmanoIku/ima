<?php
//データベース接続
include "db_conn.php";

$files = getAllFile();

$account = $_COOKIE["cookie"];

// ？？？？？？project.が冗長かも
$sql2 = "SELECT project.project_name, project.project_iconname , project.explanation, project.occupation, project.location, project.reward, project.deadline FROM project WHERE project.user_name = '$account'";
$result2 = dbc()->query($sql2);

// クエリー失敗
if(!$result2) {
    echo dbc()->error;
    exit();
}

//連想配列で取得
while($row2 = $result2->fetch(PDO::FETCH_ASSOC)){
    $rows2[] = $row2;
}

//結果セットを解放
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
                <h1>プロジェクト</h1>
                <?php
                if(isset($rows2)){
                //Invalid argument supplied for foreach()を(array)を書き、回避
                    foreach((array)$rows2 as $row2){
                ?>
                    <table class="table">
                    <!-- プロジェクト名のディレクトリから画像を取得 -->
                    <tr><th><img src=".\<?php echo $_COOKIE['cookie']; ?>\<?php echo $row2['project_name'];?>\<?php echo $row2['project_iconname'];?>"></th></tr>
                        <tr><th>プロジェクト名：<?php echo $row2['project_name']; ?></th></tr>
                        <tr><td>概要欄：<?php echo $row2['explanation']; ?></td></tr>
                        <tr><td>
                            募集メンバー：<?php
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
                    </table>
                <?php
                    }
                }else{
                    ?>
                        <a href="projectRegist.php">プロジェクトの登録がまだです</a>
                    <?php
                }
                ?>
            </table>
        </div>
    </div>
</div>

</body>
</html>