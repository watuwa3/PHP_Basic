<html>
<head>
  <meta http-equiv="Content-type" content="text/html; charset=utf-8">
  <meta http-equiv="refresh" content='10;URL="retry@localhost:4680/index.php"'>
  <title>BASIC 認証ログインエラー</title>
</head>
<body>
<?php
    echo "ユーザID:" .$_SERVER["PHP_AUTH_USER"] 
        ."、またはパスワード" .$_SERVER["PHP_AUTH_PW"] 
        ."が正しくありません<p>";
  unset($_SERVER["PHP_AUTH_USER"]);
?>
  <a href="index.php"> Top </a>
</body>
</html>
