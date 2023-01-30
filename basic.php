<html>
<head>
  <meta http-equiv="Content-type" content="text/html; charset=utf-8">
  <title>PHP の基礎</title>
</head>
<body>
  <h1>PHP の基礎</h1>
  <!-- 記述の基礎 -->
  <b>基本形：</b>&lt;?php <?php echo 'echo "初めまして"; '; ?>?&gt;<p>
  <b>短縮形：</b>&lt;? echo "初めまして"; ?&gt; <?php echo "(短縮形 は php.ini で無効化されている (short_open_tag = Off))<p>"; ?>
  <b>ASP式記述：</b>&lt;% echo "初めまして"; %&gt; <?php echo "(ASP式記述も php.ini で無効化されている (asp_tags = Off))<p>"; ?>
  <b>スクリプト記述形式：</b>&lt;script language="PHP">echo "初めまして";&lt;/script><p>

  <!-- 定数・変数の基礎とechoの基礎とechoの省略 -->
  <?php
    define("TITLE_NAME", "定数の基礎："); 							// 定数の基礎 
    define("MAX_WIDTH", 1030);
    $message="HTMLタグ間に埋め込むときに便利"; 						// 変数の基礎 
    echo "<b>", TITLE_NAME, '</b>define("変数名", "内容");<p>';		// echo の基礎 'シングルクォート'と"ダブルクォート"
    echo "<b>変数の基礎：</b>", '$変数名 = "値";<p>';
  ?>
  <b>echoの省略形：</b>&lt;?= $変数名 ?><td><?= " (", $message, ")"?></td><p>					<!-- echo の省略 -->
  <b>ヒアドキュメント：</b><br>&lt;?php<br>echo <<<ここにID<br>&nbsp;&nbsp;あいうえお<br>ID;<br>?><p>

  <!-- ソースコードのコメントについて -->
  <b>PHP ソースコードのコメントについて：</b><br>
  <table border="1">
  <tr><th>記号</th><th align="left">意味</th></tr>
  <tr><td>//</td><td>この後に記述する内容はコメントです（次の改行またはPHPの終了タグまでの間）</td></tr>
  <tr><td>#</td><td>この後に記述する内容はコメントです（次の改行またはPHPの終了タグまでの間）</td></tr>
  <tr><td>/* */</td><td>囲まれた部分はコメントです（PHPの終了タグを含めることが出来ます）</td></tr>
  </table>
  <p>
  <a href="index.php">Top</a>
</body>
</html>
