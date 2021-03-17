<?php
if(isset($_COOKIE["cookie"])){
	header("Location: home.php");
}
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
<div class="container">
	<div class="row">
		<div class="col-sm">
        	<div class="card text-center">
				<h2>ログイン</h2>
			</div>
		</div>
	</div>

	<div class="col-sm">
        <div class="card text-center">
			<form action="login_check.php" method="post">
				<?php if (isset($_GET['error'])) { ?>
					<p class="error"><?php echo $_GET['error']; ?></p>
				<?php } ?>
				<label>ユーザー名</label>
				<input type="text" name="uname" placeholder="User Name" value="sample"><br>

				<label>パスワード</label>
				<input type="password" name="password" placeholder="Password" value="000000"><br>

				<button type="submit">ログイン</button>
				<a href="signup.php" class="ca">アカウントをお持ちでない方</a>
			</form>
			<p>
			ユーザー名とパスワードは既に入力済みです。

			アカウント作成も可能です。
			</p>
		</div>
    </div>
</div>
</body>
</html>