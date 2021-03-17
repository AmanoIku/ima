<?php
session_start();

session_unset();
session_destroy();

setcookie("cookie",$_SESSION['user_name'] ,time()-60*60*24*14);
// setcookie("cookie",$_SESSION['user_name'] ,time()-60*60*24*14);

header("Location: index.php");