<?php
//----------------------------------------------------------
// ■ データベースに接続
//----------------------------------------------------------
ini_set('display_errors', "Off");
$mysqli = new mysqli("localhost", "koken_5", "koken_5", "koken_5");
if ($mysqli->connect_errno) {
  die($mysqli->connect_errno.":".$mysqli->connect_error); // "データベースに接続できませんでした");
}
echo "データベース接続<p>";

// 文字コードを設定
$mysqli->set_charset('utf8');

//----------------------------------------------------------
// ■ テーブルからデータを読む
//----------------------------------------------------------
echo "社員マスタ情報<p>";
echo "| TANCD | TANNM |<br>";
$result = $mysqli->query("SELECT * FROM m0010");
foreach ($result as $row) {
        echo "| ", $row["TANCD"], " | ", $row["TANNM"],  " |<br>";
}
echo "<p>", "データベース解除";
$mysqli->close();
?>
