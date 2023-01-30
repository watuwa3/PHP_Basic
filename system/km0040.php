<?php
//----------------------------------------------------------
// ■ KM0040 アドレス帳マスタメンテナンス
//----------------------------------------------------------
//----------------------------------------------------------
// ■ 変数初期化
//----------------------------------------------------------
$no = 0;
$sql = "";
$error = "";
$pgmid = "";
$new_iokbn = "";
$new_destcd = "";
$new_active = "";
$new_destnm = "";
$new_email = "";
$new_adrtype = "";

//----------------------------------------------------------
// ■ データベースに接続
//----------------------------------------------------------
//ini_set('display_errors', "Off");
$mysqli = new mysqli("localhost", "koken_5", "koken_5", "koken_5");
if ($mysqli->connect_errno) {
  die($mysqli->connect_errno.":".$mysqli->connect_error); // "データベースに接続できませんでした");
}

//----------------------------------------------------------
// ■ post されたとき
//----------------------------------------------------------
if ($_SERVER["REQUEST_METHOD"] == "POST") {
	$pgmid = htmlspecialchars($_POST["pgmid"], ENT_QUOTES);
	// 新規追加
	if (isset($_POST["submit_add"])) {
		$new_iokbn = htmlspecialchars($_POST["new_iokbn"], ENT_QUOTES);
		$new_destcd = htmlspecialchars($_POST["new_destcd"], ENT_QUOTES);
		$new_active = htmlspecialchars($_POST["new_active"], ENT_QUOTES);
		$new_destnm = htmlspecialchars($_POST["new_destnm"], ENT_QUOTES);
		$new_email = htmlspecialchars($_POST["new_email"], ENT_QUOTES);
		$new_adrtype = htmlspecialchars($_POST["new_adrtype"], ENT_QUOTES);
		// 全角を半角に変換
		$new_destcd = mb_convert_kana($new_destcd, "as");
		$new_email = mb_convert_kana($new_email, "as");
		if ($new_iokbn != "1" && $new_iokbn != "2") {
			$error .= "IO区分には [1:社内] または [2:社外] を入力してください<br>";
		}
		if ($new_active != "0" && $new_active != "1") {
			$error .= "有効フラグには [0:無効] または [1:有効] を入力してください<br>";
		}
		if (!preg_match("/^[^@]+@([-a-z0-9]+\.)+[a-z]{2,}$/", $new_email)) {
			$error .= "メールアドレスに誤りがあります[$new_email]<p>";
		}
		// SQL 文作成
		if ($error == "") {
			$sql = "INSERT INTO km0040 VALUES ('$pgmid', '$new_iokbn', '$new_destcd', '$new_active', '0', '$new_destnm', '様', '$new_email', '1')";
		}
	}
	// 変更
	if (isset($_POST["submit_upd"])) {
		$no = key($_POST["submit_upd"]);  // ボタン番号を取得
		$iokbn = htmlspecialchars($_POST["iokbn"][$no], ENT_QUOTES);
		$destcd = htmlspecialchars($_POST["destcd"][$no], ENT_QUOTES);
		$active = htmlspecialchars($_POST["active"][$no], ENT_QUOTES);
		$destnm = htmlspecialchars($_POST["destnm"][$no], ENT_QUOTES);
		$email = htmlspecialchars($_POST["email"][$no], ENT_QUOTES);
		$adrtype = htmlspecialchars($_POST["adrtype"][$no], ENT_QUOTES);
		// 全角を半角に変換
		$destcd = mb_convert_kana($destcd, "as");
		$email = mb_convert_kana($email, "as");
		if ($active != "0" && $active != "1") {
			$error .= "有効フラグには [0:無効] または [1:有効] を入力してください<br>";
		}
		// チェック-メール
		if (!preg_match("/^[^@]+@([-a-z0-9]+\.)+[a-z]{2,}$/", $email)) {
			$error = "メールアドレスに誤りがあります[$email]<p>";
		}
		// SQL 文作成
		if ($error == "") {
			$sql = "UPDATE km0040 SET ACTIVE='$active', DESTNM='$destnm', EMAIL='$email', ADRTYPE='$adrtype'
			        WHERE PGMID = '$pgmid' and IOKBN = '$iokbn' and DESTCD = '$destcd'";
		}
	}
	// 削除
	if (isset($_POST["submit_del"])) {
		$no = key($_POST["submit_del"]);  // ボタン番号を取得
		$iokbn = htmlspecialchars($_POST["iokbn"][$no], ENT_QUOTES);
		$destcd = htmlspecialchars($_POST["destcd"][$no], ENT_QUOTES);
		// SQL 文作成
		if ($error == "") {
			$sql = "DELETE FROM km0040 WHERE PGMID = '$pgmid' and IOKBN = '$iokbn' and DESTCD = '$destcd'";
		}
	}
	// SQL 文を MySQL へ渡す
	if ($error == "" && $sql != "") {
		$mysqli->query($sql);
		if ($mysqli->errno) {
		  echo $mysqli->errno.":".$mysqli->error;
		}
		$new_iokbn = "";
		$new_destcd = "";
		$new_active = "";
		$new_destnm = "";
		$new_email = "";
		$new_adrtype = "";
	}
}
?>
<html>
<head>
	<meta http-equiv="Content-type" content="text/html; charset=utf-8">
	<title>アドレス帳マスタ</title>
	<style>
		.list {
		  font-family: monospace;
		}
		.input-ro {
			background: #EEE;
			color: #555;
			border: solid 0.5px #666;
			border-radius: 2px;
		}
		.input-error input[type = "text"] {
			background: #E88;
		}
	</style>
</head>
<body>
	<?=$error ?>
	<h3>[KM0040] アドレス帳マスタ メンテナンス画面</h3>
	<form action = "<?=$_SERVER['PHP_SELF']?>" method="POST">
	<div class = "list">
	<?php
		// 選択リストボックス
		echo '<select name = "pgmid" onchange="submit(this.form)">';
		$rowno = 1;
		$result =$mysqli->query("SELECT PGMID FROM km0040 GROUP BY PGMID");
		foreach ($result as $row) {
			if ($pgmid == "" and $rowno == 2) {
				$pgmid = $row["PGMID"];
			}
			echo '<option value="', $row["PGMID"], '"',
				($pgmid == $row["PGMID"]) ? " selected" : "",
				'>', $row["PGMID"], "</option>";
			$rowno++;
		}
		echo "</select><p>";

		// テーブルからデータを読み込む
		echo "No　IOKBN　 DESTCD　　 ACTIVE　DESTNM　　　　　　　　　　EMAIL　　　　　　　　　　　　　　　 ADRTYPE<br>";
		$rowno = 1;
		$result =$mysqli->query("SELECT * FROM km0040 WHERE PGMID = '$pgmid' ORDER BY DESTCD");
		foreach ($result as $row) {
			$iokbn = $row["IOKBN"];
			$destcd = $row["DESTCD"];
			$active = $row["ACTIVE"];
			$destnm = $row["DESTNM"];
			$email = $row["EMAIL"];
			$adrtype = $row["ADRTYPE"];
			
			if ($error != "" and $no == $rowno) {
				echo '<div class="input-error">';
			}
			echo str_pad(strval($rowno), 3, "000", STR_PAD_LEFT), "\n";
echo <<<EOT
<input type="text" name="iokbn[$rowno]" value="$iokbn" size="1" class="input-ro" readonly>
<input type="text" name="destcd[$rowno]" value="$destcd" size="6" class="input-ro" readonly>
<input type="text" name="active[$rowno]" value="$active" size="1">
<input type="text" name="destnm[$rowno]" value="$destnm" size="20">
<input type="text" name="email[$rowno]" value="$email" size="30">
<input type="text" name="adrtype[$rowno]" value="$adrtype" size="1">
<input type="submit" name="submit_upd[$rowno]" value="変更">
<input type="submit" name="submit_del[$rowno]" value="削除">
<br>
EOT;
			if ($error!="" and $no == $rowno) {
				echo "</div>";
			}
			$rowno++;
		}
	?>
	<br>
	アドレス帳マスタに新規追加<br>
	000
	<input type="text" name="new_iokbn" value="<?= $new_iokbn ?>" size="1">
	<input type="text" name="new_destcd" value="<?= $new_destcd ?>" size="6">
	<input type="text" name="new_active" value="<?= $new_active ?>" size="1">
	<input type="text" name="new_destnm" value="<?= $new_destnm ?>" size="20">
	<input type="text" name="new_email" value="<?= $new_email ?>" size="30">
	<input type="text" name="new_adrtype" value="<?= $new_adrtype ?>" size="1">
	<input type="submit" name="submit_add" value="追加">
	</div>
	</form>
	<br>
	<?php
	if ($sql > "") {
		echo "発行したSQL文: <br>$sql<p>";
	}
	?>
	<a href="/index.php">Top</a>
</body>
</html>
