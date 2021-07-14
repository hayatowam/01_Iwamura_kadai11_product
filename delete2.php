<?php
// 削除するボタンを作る(select.php内)→そこでボタンを押すと削除処理される


//selsect.phpから処理を持ってくる
//1.対象のIDを取得
$id = $_GET["id"];


//2.DB接続します
require_once('funcs2.php');
$pdo = db_conn();
$db_table = "gs_bm_table";

//3.削除SQLを作成
// 個々の入力データを持ってくる→IDをキーにしている
$stmt = $pdo->prepare("DELETE FROM $db_table WHERE id=:id");
// ↑DELETEに変えてあげる
$stmt->bindValue(':id',$id,PDO::PARAM_INT);

// 実行
$status = $stmt->execute();
// データをしっかり受け取れているかどうかを確認するために、echoを書いた良い
// var_dump($status);


//４．データ削除処理後
if($status==false){
    //SQL実行時にエラーがある場合（エラーオブジェクト取得して表示）
    //以下を関数化
    sql_error($stmt);
  }else{
    //５．成功した場合は、index.phpへリダイレクト
    //以下を関数化
    redirect('select2.php');
  }





