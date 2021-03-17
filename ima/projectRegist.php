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

    <!--プロジェクト登録欄開始 -->
    <p>プロジェクト登録</p>
    <form action="registP-check.php" method="post">
            <?php if (isset($_GET['error'])) { ?>
                <p class="error"><?php echo $_GET['error']; ?></p>
            <?php } ?>

            <?php if (isset($_GET['success'])) { ?>
                <p class="success"><?php echo $_GET['success']; ?></p>
            <?php } ?>

            <label>プロジェクト名</label>
            <?php if (isset($_GET['pname'])) { ?>
              <input type="text"
                name="pname"
                autocomplete="プロジェクト名"
                value="<?php echo $_GET['pname']; ?>"><br>
            <?php }else{ ?>
              <input type="text"
                name="pname"
                autocomplete="プロジェクト名"><br>
            <?php }?>

            <label>概要欄</label>
            <input type="text"
                name="pexplan"
                autocomplete="概要欄"><br>

            <label>職業欄</label>
            <input type="radio" name="poccupation" autocomplete="概要欄" value=1 checked="checked">
            <label>カメラマン</label>
            <input type="radio" name="poccupation" autocomplete="概要欄" value=2>
            <label>モデル</label>
            <input type="radio" name="poccupation" autocomplete="概要欄" value=3>
            <label>ヘアーアーティスト</label>
            <br>

            <label>ロケーション</label>
            <input type="text"
                name="plocation"
                autocomplete="ロケーション"><br>

            <label>報酬</label>
            <input type="text"
                name="preward"
                autocomplete="報酬"><br>

            <label>締め切り</label>
            <input type="datetime-local"
                name="pdeadline"
                autocomplete="締め切り"><br>

            <label>その他</label>
            <input type="text"
                name="pother"
                autocomplete="その他"><br>

            <button type="submit">作成</button>
    </form>
    <!--プロジェクト登録欄終了 -->
    <!-- ！！！！！！JQueryとaタグがぶつかって動かない -->
    <!-- <a href="home.php">ホームに戻る</a> -->
</body>
</html>
