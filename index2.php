<?php
//SESSIONスタート
session_start();
//関数を呼び出す
require_once('funcs2.php');


$pdo = db_conn();


//２．データ登録SQL作成
$stmt = $pdo->prepare("SELECT * FROM gs_user_table");
$status = $stmt->execute();

//ログインチェック
// loginCheck(); //ログインしないと見れないページに貼る
$user_name = $_SESSION['name'];
$kanri_flg = $_SESSION['kanri_flg'];

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
    <div class="container-fluid">
      <div class="navbar-header">
        <div class="title">ブックマークアプリ</div>
        <div class="page_title">ブックマーク登録ページ</div>
        <div class="logi_name" >
          ログイン者：
          <?php if ($kanri_flg == null ) { ?>
              ログインされていません
            <?php }else{?>
              <?= $user_name ?>
            <?php }?>   
        </div>  
        <a class="navbar-brand" href="select2.php">ブックマークデータ一覧</a>
        <?php if ($kanri_flg == 1 ) { ?>
            <a class="navbar-brand" href="user_index2.php">ユーザー登録</a>
            <a class="navbar-brand" href="select_user.php">ユーザー一覧</a>
        <?php }?>   
        <a class="navbar-brand" href="login2.php">ログイン</a>
        <a class="navbar-brand" href="logout2.php">ログアウト</a><!-- ここを追記 -->
      </div>
    </div>
  </nav>
</header>
<!-- Head[End] -->

<!-- Main[Start] -->

<form method="POST" action="insert2.php">
<!-- // <form method="どんな方法で" action="どこに"> -->
  <div class="jumbotron">
   <fieldset>
    <legend>本のブックマーク</legend>
    
     <label>本のタイトル：<input type="text" name="name"></label><br>
    <label>コメント：<textArea name="comment" rows="4" cols="40"></textArea></label><br>
     <label>評価：
      <select id="list" name="rate">
        <option value="1">1</option>
        <option value="2">2</option>
        <option value="3">3</option>
        <option value="4">4</option>
        <option value="5">5</option>
      </select> 
    </label><br>
     <label>お気に入りページ：<input name="favoritepage"></label><br>
     <label>URL：<input type="text" name="url"></label><br>
     <input type="submit" value="送信">
    </fieldset>
  </div>
</form>
<!-- Main[End] -->


</body>
</html>
