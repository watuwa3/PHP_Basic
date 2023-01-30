<?php
//----------------------------------------------------------
// ■ PDF をダウンロードさせて終了
//----------------------------------------------------------

//header("Content-type: application/pdf");

// ファイルのパス
$filepath = 'YZF-R1M_2022.pdf';
// ファイルタイプを指定
header('Content-Type: application/force-download');
// ファイルサイズを取得し、ダウンロードの進捗を表示
header('Content-Length: '.filesize($filepath));
// ファイルのダウンロード、リネームを指示
header('Content-Disposition: attachment; filename="'.$filepath.'"');
// ファイルを読み込みダウンロードを実行
readfile($filepath);
exit();
?>
