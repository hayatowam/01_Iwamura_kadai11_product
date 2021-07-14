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
// loginCheck();
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
        <div class="page_title">ユーザー登録ページ</div>
        <div class="logi_name" >
          ログイン者：
          <?php if ($kanri_flg == null ) { ?>
              ログインされていません
            <?php }else{?>
              <?= $user_name ?>
            <?php }?>   
        </div>  
        <a class="navbar-brand" href="index2.php">ブックマークデータ登録</a>
        <a class="navbar-brand" href="select2.php">ブックマークデータ一覧</a>
        <?php if ($kanri_flg == 1 ) { ?>
            <!-- <a class="navbar-brand" href="user_index2.php">ユーザー登録</a>ここを追記 -->
            <a class="navbar-brand" href="select_user.php">ユーザー一覧</a><!-- ここを追記 -->
        <?php }?>   
        <a class="navbar-brand" href="login2.php">ログイン</a>
        <a class="navbar-brand" href="logout2.php">ログアウト</a><!-- ここを追記 -->
      </div>
        <!-- <div class="navbar-header"><a class="navbar-brand" href="select2.php">ブックマークデータ一覧</a></div> -->
        <!-- <div class="navbar-header"><a class="navbar-brand" href="index2.php">ブックマーク登録</a></div> -->
        <!-- <div class="navbar-header"><a class="navbar-brand" href="select_user.php">ユーザー一覧</a></div>ここを追記
        <div class="navbar-header"><a class="navbar-brand" href="login2.php">ログイン</a></div>
        <div class="navbar-header"><a class="navbar-brand" href="logout2.php">ログアウト</a></div>ここを追記 -->
    </div>
  </nav>
</header>
<!-- Head[End] -->

<!-- Main[Start] -->
<form method="POST" action="user_insert2.php">
  <div class="jumbotron">
    <fieldset>
      <legend>ユーザー登録画面</legend>
      <label>名前：<input type="text" name="name"></label><br>
      <label>ログインID：<input name="lid" ></label><br>
      <label>ログインパスワード：<input name="lpw"></label><br>
      <label>管理者フラグ：
        <select id="list" name="kanri_flg">
          <option hidden>一つを選択して下さい</option>
          <option value="0">0:管理者</option>
          <option value="1">1:スーパー管理者</option>
        </select> <br>
      <label>ステータス：
        <select id="list" name="life_flg">
          <option hidden>一つを選択して下さい</option>
          <option value="0">0:退社</option>
          <option value="1">1:入社</option>
        </select> 
      </label><br>
      <input type="submit" value="送信">
    </fieldset>
  </div>
</form>
<!-- Main[End] -->


</body>
</html>
