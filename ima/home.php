<?php

//データベース接続
include "db_conn.php";
$files = getAllFile();

// SQL記述欄（ユーザー）
$sql = "SELECT users.user_name FROM users";
$result = dbc()->query($sql);
// SQL記述欄（クリエイター）
$sql1 = "SELECT creator.creator_id, creator.creator_name, creator.user_name, creator.introduction, creator.location, creator.creator_iconname FROM creator,users WHERE creator.user_name = users.user_name";
$result1 = dbc()->query($sql1);
// SQL記述欄（プロジェクト）
$sql2 = "SELECT project.project_id, project.project_name, project.user_name, project.explanation, project.occupation, project.project_iconname, project.location, project.reward FROM project,users WHERE project.user_name = users.user_name";
$result2 = dbc()->query($sql2);
// SQL記述欄（クリエイターfav）
$sql3 = "SELECT creator_fav.creator_name, creator_fav.fav_user, creator_fav.fav_state FROM creator_fav";
$result3 = dbc()->query($sql3);
// SQL記述欄（プロジェクトfav）
$sql4 = "SELECT project_fav.project_name, project_fav.fav_user, project_fav.fav_state FROM project_fav";
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

session_start();

// cookieが無ければ、user_idとuser_nameのチェック
if(!isset($_COOKIE["cookie"])) {
     if (isset($_SESSION['user_id'],$_SESSION['user_name'])) {
          setcookie("cookie",$_SESSION['user_name'] ,time()+60*60*24*14);
          header("Location: index.php");
     }else{
          header("Location: index.php");
          exit();
     }
}else{
     setcookie("cookie",$_SESSION['user_name'] ,time()+60*60*24*14);
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
                    <button class="btn btn-outline-primary" type="submit">Search</button>
               </form>
          </nav>
     </header>
     <!-- ヘッダー終了 -->

     <div class="row"><img src=".\toppaje_pic\unnamed.png" class="img-fluid">
          <div class="col">

          <!-- クリエイターの開始タグ -->
          <div class="card">
               <p>クリエイター一覧</p>

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
                         <img src=".\<?php echo $row1['user_name']; ?>\<?php echo $row1['creator_name']; ?>\<?php echo $row1['creator_iconname']; ?>"><br>
                         <tr><th>クリエイター名：<?php echo $row1['creator_name']; ?></th></tr>
                         <tr><td>自己紹介：<?php echo $row1['introduction']; ?></td></tr>
                         <tr><td>エリア：<?php echo $row1['location']; ?></td></tr>
                         <tr><td>

                         <!-- 以下クリエイターのいいねボタン -->
                         <?php
                         foreach((array)$rows3 as $row3){

                              if($row1['creator_name'] == $row3['creator_name']){

                                   // classに文字列を足すことで他のボタンと識別
                                   // if文内fav_state == 0であれば♡else♥
                                   if($row3['fav_state'] == '0'){
                                        ?><button class="cfavbtn" data-id="favbtn" value="<?php echo $row1['creator_name']; ?>">♡いいね</button>
                                          <button class="cremove hide" data-id="remove" value="<?php echo $row1['creator_name']; ?>">♥いいね済み</button><?php
                                   // if文内fav_state == 1であれば♥else♡
                                   }else if($row3['fav_state'] == '1'){
                                        ?><button class="cfavbtn hide" data-id="<?php echo $row1['creator_name']; ?>" value="<?php echo $row1['creator_name']; ?>">♡いいね</button>
                                          <button class="cremove" data-id="<?php echo $row1['creator_name']; ?>" value="<?php echo $row1['creator_name']; ?>">♥いいね済み</button><?php
                                   }
                              }
                         }
                         ?>
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

          <div class="col">
          <!-- プロジェクトの開始タグ -->
          <div class="card">
               <p>プロジェクト一覧</p>
               <?php
               foreach((array)$rows as $row){
               //Invalid argument supplied for foreach()を(array)で回避
                    foreach((array)$rows2 as $row2){
                         if($row['user_name'] == $row2['user_name']){ // プロジェクトのユーザー名が同じであれば画像を表示させたい
               ?>
                         <div class="project_account">
                              <table class="table">
                              <!-- プロジェクト名のディレクトリから画像を取得 -->
                                   <img src=".\<?php echo $row2['user_name']; ?>\<?php echo $row2['project_name']; ?>\<?php echo $row2['project_iconname']; ?>"><br>
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
                                   <tr><td>
                                        <!-- 以下プロジェクトのいいねボタン -->
                                        <?php
                                        foreach((array)$rows4 as $row4){

                                             if($row2['project_name'] == $row4['project_name']){

                                                  // if文内fav_state == 1であれば♡else♥
                                                  if($row4['fav_state'] == '0'){
                                                       ?><button class="pfavbtn" data-id="favbtn" value="<?php echo $row2['project_name']; ?>">♡いいね</button>
                                                       <button class="premove hide" data-id="remove" value="<?php echo $row2['project_name']; ?>">♥いいね済み</button><?php
                                                  }else if($row4['fav_state'] == '1'){
                                                       ?><button class="pfavbtn hide" data-id="favbtn" value="<?php echo $row2['project_name']; ?>">♡いいね</button>
                                                       <button class="premove" data-id="remove" value="<?php echo $row2['project_name']; ?>">♥いいね済み</button><?php
                                                  }
                                             }
                                        }

                                        ?>
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
     <!-- ホームページの終了タグ -->

     <!-- <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
     <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
     <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script> -->
</div>
</body>
</html>
<?php
}
?>