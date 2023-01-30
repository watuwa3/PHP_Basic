<?php
//----------------------------------------------------------
// ■ クッキーを保存する
//----------------------------------------------------------
// 有効期限を省略した場合は、ブラウザを閉じるまで有効
// <html>より前に記述する事
setcookie("myinfo[oname]", "フミコ");
setcookie("myinfo[mail]", "aaa@bbb.ccc", time() + 3600 * 12);
setcookie("myinfo[password]", "fumiko");
//----------------------------------------------------------
// ■ セッションを開始する（使用する）
//----------------------------------------------------------
session_start();
?>
<html>
<head>
  <meta http-equiv="Content-type" content="text/html; charset=utf-8">
  <title>クッキーとセッションの利用</title>
</head>
<body>
  <b>//----------------------------------------------------------</b><br>
  <b>// ■ クッキー を利用する</b><br>
  <b>//----------------------------------------------------------</b><br>
  <?php
  if (isset($_COOKIE['myinfo'])) {
    foreach ($_COOKIE['myinfo'] as $key => $value) {
      echo "$key : $value <br />\n";
    }
  }
  ?>
  <p>
  <b>//----------------------------------------------------------</b><br>
  <b>// ■ セッション を利用する</b><br>
  <b>//----------------------------------------------------------</b><br>
  <?php
  if (isset($_SESSION['suki'])) {
    echo "セッションに「好きな食べ物」が存在しています <br />\n";
  } else {
    $ilike = "プリン";
    $_SESSION["suki"] = $ilike;
    echo "セッションに「好きな食べ物=" .$ilike ."」をセットしました <br />\n";
  }
  ?>
  <p>
  <a href="cookie_session_confirm.php">セッション確認ページにジャンプ</a><br>
  <p><a href="index.php">Top</a>
</body>
</html>
