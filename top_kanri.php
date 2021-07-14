<?php

//SESSIONスタート
session_start();
//関数を呼び出す
require_once('funcs2.php');
//ログインチェック
loginCheck();
$user_name = $_SESSION['name'];

//以下ログインユーザーのみ

$pdo = db_conn();
//２．データ登録SQL作成
$stmt = $pdo->prepare("SELECT * FROM gs_user_table");
$status = $stmt->execute();

//３．データ表示
$view="";
if($status==false) {
  sql_error($stmt);
}else{
  while( $r = $stmt->fetch(PDO::FETCH_ASSOC)){ 
    $view .= '<p>';
    $view .= '<a href="detail.php?id='.$r["id"].'">';
    $view .= $r["id"]."|".$r["name"]."|".$r["email"];
    $view .= '</a>';
    $view .= "　";
    $view .= '<a class="btn btn-danger" href="delete.php?id='.$r["id"].'">';
    $view .= '[<i class="glyphicon glyphicon-remove"></i>削除]';
    $view .= '</a>';
    $view .= '</p>';
  }
}
?>

<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <title>データ登録</title>
  <link href="css/bootstrap.min.css" rel="stylesheet">
  <style>div{padding: 10px;font-size:16px;}</style>
</head>
<body>

<!-- Head[Start] -->
<header>
  <nav class="navbar navbar-default">
    <div class="container-fluid" >
    <div class="navbar-brand">ブックマークアプリ</div>
    <div class="navbar-brand">Top Page</div>
    <div class="logi_name" >ログイン者：<?= $user_name ?></div>  
    <div class="navbar-header"><a class="navbar-brand" href="select2.php">ブックマーク一覧</a></div>
    <div class="navbar-header"><a class="navbar-brand" href="index2.php">ブックマーク登録</a></div>
    <div class="navbar-header"><a class="navbar-brand" href="user_index2.php">ユーザー登録</a></div><!-- ここを追記 -->
    <div class="navbar-header"><a class="navbar-brand" href="select_user.php">ユーザー一覧</a></div><!-- ここを追記 -->
    <div class="navbar-header"><a class="navbar-brand" href="logout2.php">ログアウト</a></div><!-- ここを追記 -->
    </div>
  </nav>
</header>
<!-- Head[End] -->



</body>
</html>
