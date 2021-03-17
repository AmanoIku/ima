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

    <!--クリエイター登録欄開始-->
    <p>クリエイター登録</p>
    <form action="registC-check.php" method="post">
            <?php if (isset($_GET['error'])) { ?>
                <p class="error"><?php echo $_GET['error']; ?></p>
            <?php } ?>

            <?php if (isset($_GET['success'])) { ?>
                <p class="success"><?php echo $_GET['success']; ?></p>
            <?php } ?>

            <label>クリエイター名</label>
            <?php if (isset($_GET['cname'])) { ?>
            <input type="text"
                name="cname"
                placeholder="クリエイター名"
                value="<?php echo $_GET['cname'];   ?>"><br>
            <?php }else{ ?>
            <input type="text"
                name="cname"
                placeholder="クリエイター名"><br>
            <?php }?>

            <label>自己紹介</label>
            <input type="text"
                name="cintro"
                placeholder="自己紹介"><br>

            <label>都道府県</label>

            <select name="pref_name">
                <option value="" selected>都道府県</option>
                <option value="北海道">北海道</option>
                <option value="青森県">青森県</option>
                <option value="岩手県">岩手県</option>
                <option value="宮城県">宮城県</option>
                <option value="秋田県">秋田県</option>
                <option value="山形県">山形県</option>
                <option value="福島県">福島県</option>
                <option value="茨城県">茨城県</option>
                <option value="栃木県">栃木県</option>
                <option value="群馬県">群馬県</option>
                <option value="埼玉県">埼玉県</option>
                <option value="千葉県">千葉県</option>
                <option value="東京都">東京都</option>
                <option value="神奈川県">神奈川県</option>
                <option value="新潟県">新潟県</option>
                <option value="富山県">富山県</option>
                <option value="石川県">石川県</option>
                <option value="福井県">福井県</option>
                <option value="山梨県">山梨県</option>
                <option value="長野県">長野県</option>
                <option value="岐阜県">岐阜県</option>
                <option value="静岡県">静岡県</option>
                <option value="愛知県">愛知県</option>
                <option value="三重県">三重県</option>
                <option value="滋賀県">滋賀県</option>
                <option value="京都府">京都府</option>
                <option value="大阪府">大阪府</option>
                <option value="兵庫県">兵庫県</option>
                <option value="奈良県">奈良県</option>
                <option value="和歌山県">和歌山県</option>
                <option value="鳥取県">鳥取県</option>
                <option value="島根県">島根県</option>
                <option value="岡山県">岡山県</option>
                <option value="広島県">広島県</option>
                <option value="山口県">山口県</option>
                <option value="徳島県">徳島県</option>
                <option value="香川県">香川県</option>
                <option value="愛媛県">愛媛県</option>
                <option value="高知県">高知県</option>
                <option value="福岡県">福岡県</option>
                <option value="佐賀県">佐賀県</option>
                <option value="長崎県">長崎県</option>
                <option value="熊本県">熊本県</option>
                <option value="大分県">大分県</option>
                <option value="宮崎県">宮崎県</option>
                <option value="鹿児島県">鹿児島県</option>
                <option value="沖縄県">沖縄県</option>
            </select><br>
            <button type="submit">作成</button>
    </form>
    <!-- クリエイター登録欄終了 -->
    <!-- ！！！！！！JQueryとaタグがぶつかって動かない -->
    <!-- <a href="home.php">ホームに戻る</a> -->
</body>
</html>
