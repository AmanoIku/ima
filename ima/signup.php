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

     <div class="row">
          <div class="col">
               <div class="card text-center">
               <form action="signup-check.php" method="post">
                    <h2>ユーザー登録</h2>
                    <?php if (isset($_GET['error'])) { ?>
                         <p class="error"><?php echo $_GET['error']; ?></p>
                    <?php } ?>

                    <?php if (isset($_GET['success'])) { ?>
                         <p class="success"><?php echo $_GET['success']; ?></p>
                    <?php } ?>

                    <label>ユーザー名</label>
                    <?php if (isset($_GET['uname'])) { ?>
                         <input type="text"
                              name="uname"
                              placeholder="User Name"
                              value="<?php echo $_GET['uname']; ?>"><br>
                    <?php }else{ ?>
                         <input type="text"
                              name="uname"
                              placeholder="User Name"><br>
                    <?php }?>

                    <label>パスワード</label>
                    <input type="password"
                         name="password"
                         placeholder="Password"><br>

                    <label>パスワード（確認）</label>
                    <input type="password"
                         name="re_password"
                         placeholder="Re_Password"><br>

                    <label>メール</label>
                    <input type="text"
                         name="umail"
                         placeholder="Mail Address"><br>

                    <button type="submit">作成</button>
                    <a href="index.php" class="ca">既にお持ちの方</a>
               </form>
               </div>
          </div>
     </div>
</div>
</body>
</html>