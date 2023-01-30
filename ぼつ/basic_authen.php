<html>
<head>
  <meta http-equiv="Content-type" content="text/html; charset=utf-8">
  <title>BASIC 認証ログイン</title>
</head>
<body>
<?php
//----------------------------------------------------------
// ■ BASIC 認証 (ログアウト出来ないし、予定した動作が出来ないので中止
//----------------------------------------------------------
if (!isset($_SERVER["PHP_AUTH_USER"]) || 
    !($_SERVER["PHP_AUTH_USER"] == "user" && $_SERVER["PHP_AUTH_PW"] == "pw")) {

  header('WWW-Authenticate: Basic realm="Please Enter Your Password"');
  header("HTTP/1.0 401 Unauthorized");

  if (!isset($_SERVER["PHP_AUTH_USER"])) {
    echo "ユーザIDまたはパスワードを入力してください.<p>";
  } else {
    if ($_SERVER["PHP_AUTH_USER"] == "retry") {
      header('WWW-Authenticate: Basic realm="Please Enter Your Password"');
      header("HTTP/1.0 401 Unauthorized");
    } else {
      header("Location: login_error.php");
    }
  }
} else {
  header("Location: https:www.yamaha-motor.co.jp/mc/lineup/yzf-r/");
}
?>
  <a href="login_window.php"> ログイン </a><p>
  <a href="index.php"> Top </a>
</body>
</html>
