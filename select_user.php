<?php

//SESSIONスタート
session_start();
//関数を呼び出す
require_once('funcs2.php');
//ログインチェック
// loginCheck();
$user_name = $_SESSION['name'];
$kanri_flg = $_SESSION['kanri_flg'];

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
    $view .= '<a href="detail_user.php?id='.$r["id"].'">';
    $view .= $r["id"]."|".$r["name"]."|".$r["email"];
    $view .= '</a>';
    $view .= "　";
    $view .= '<a class="btn btn-danger" href="delete_user.php?id='.$r["id"].'">';
    $view .= '[<i class="glyphicon glyphicon-remove"></i>削除]';
    $view .= '</a>';
    $view .= '</p>';
  }
}
?>


<!DOCTYPE html>
<html lang="ja">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>フリーアンケート表示</title>
<link rel="stylesheet" href="css/range.css">
<link href="css/bootstrap.min.css" rel="stylesheet">
<style>div{padding: 10px;font-size:16px;}</style>
</head>
<body id="main">
<!-- Head[Start] -->
<header>
  <nav class="navbar navbar-default">
    <div class="container-fluid">
      <div class="navbar-header">
        <div class="title">ブックマークアプリ</div>
        <div class="page_title">ユーザー一覧ページ</div>
        <div class="logi_name" >ログイン者：<?= $user_name ?></div>  
        <a class="navbar-brand" href="index2.php">ブックマークデータ登録</a>
        <a class="navbar-brand" href="select2.php">ブックマークデータ一覧</a>
        <?php if ($kanri_flg == 1 ) { ?>
            <a class="navbar-brand" href="user_index2.php">ユーザー登録</a>
            <!-- <a class="navbar-brand" href="select_user.php">ユーザー一覧</a> -->
        <?php }?>   
        <a class="navbar-brand" href="login2.php">ログイン</a>
        <a class="navbar-brand" href="logout2.php">ログアウト</a><!-- ここを追記 -->
      </div>
    </div>
  </nav>
</header>
<!-- Head[End] -->

<!-- Main[Start] -->
<div>
    <div class="container jumbotron"><?=$view?></div>
</div>
<!-- Main[End] -->

</body>
</html>
