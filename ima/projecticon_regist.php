<?php
include "upload_icon.php";
$files = getAllFile();
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
          <div class="col"></div></div>

    <div id="open">
        <p>アイコンの変更</p>
    </div>
    <div id="mask" class="hidden"></div>

    <!-- モーダルウィンドウ開始 -->
    <section id="modal" class="hidden">
        <!--アイコン登録欄-->
        <form enctype="multipart/form-data" action="projecticon_upload.php" method="POST">

            <input type="hidden" name="MAX_FILE_SIZE" value="1048576" />
            <input name="img" type="file" accept="image/*" /><br>

            <div id="close">
            <input type="submit" name="save" value="変更" class="btn" />
            </div>
        </form>
    </section>
    <script src="script.js"></script>
    <!-- モーダルウィンドウ終了 -->

    <!-- クリエイター登録欄終了 -->
    <!-- ！！！！！！JQueryとaタグがぶつかって動かない -->
    <!-- <a href="home.php">ホームに戻る</a> -->
</body>
</html>