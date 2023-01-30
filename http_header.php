<?php
//----------------------------------------------------------
// ■ HTTP ヘッダー
//----------------------------------------------------------
header("Cache-Control: no-cache, must-revalidate"); // キャッシュの無効化
header("refresh:3; url=http://www.google.com/");
?>
<html>
<head>
  <meta http-equiv="Content-type" content="text/html; charset=utf-8">
  <title>HTTP ヘッダー</title>
</head>
<body>
  <b>//----------------------------------------------------------</b><br>
  <b>// ■ 3秒後にリダイレクトします</b><br>
  <b>//----------------------------------------------------------</b><br>
  <a href="index.php">戻る</a><br>
</body>
</html>
