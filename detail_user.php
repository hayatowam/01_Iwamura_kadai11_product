<?php


//selsect.phpから処理を持ってくる
//1.外部ファイル読み込みしてDB接続
require_once('funcs2.php');
$pdo = db_conn();

//2.対象のIDを取得
$id = $_GET['id'];
// この$idはURLにくっつけて持ってきていたID（select.phpのファイルのwhile文の中のidを参照している）

//3．データ取得SQL作成（登録ではないと思われる）
// 個々の入力データを持ってくる→IDをキーにしている
$stmt = $pdo->prepare("SELECT * FROM gs_user_table WHERE id=:id");
$stmt->bindValue(':id',$id,PDO::PARAM_INT);

    // 実行
    $status = $stmt->execute();
    // データをしっかり受け取れているかどうかを確認するために、echoを書いた良い
    // var_dump($status);

//4．データ表示
// 今回は、1行のみなので、While分は不要
$view = '';
if ($status == false) {
    sql_error($status);
} else {
    $result = $stmt->fetch();
    // var_dump($result); //←この文は$resultの中に入っているデータを表示してあげるもの。この中にデータを入ってきているので、下のHTMLの中で表示してあげているイメージ
    // trueの場合は入っているデータを見れる形にしてあげる
}

?>

<!-- 以下はindex.phpのHTMLをまるっと持ってくる -->
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
    <div class="navbar-header"><a class="navbar-brand" href="select_user.php">データ一覧</a></div>
    </div>
  </nav>
</header>
<!-- Head[End] -->

<!-- Main[Start] -->

<form method="POST" action="update_user.php">
<!-- // <form method="どんな方法で" action="どこに"> -->
  <div class="jumbotron">
   <fieldset>
    <legend>ユーザー管理画面</legend>
     <label>名前：<input type="text" name="name" value="<?= $result['name'] ?>"></label><br>
    <label>ログインID：<input name="lid" value="<?= $result['lid'] ?>"></label><br>
    <label>ログインパスワード：<input name="lpw" ></label><br>
     <label>管理者フラグ：
      <select id="list" name="kanri_flg">
        <option hidden><?= $result['kanri_flg'] ?></option>
        <option value="0">0:管理者</option>
        <option value="1">1:スーパー管理者</option>
      </select> <br>
     <label>ステータス：
      <select id="list" name="life_flg" >
        <option hidden><?= $result['life_flg'] ?></option>
        <option value="0">0:退社</option>
        <option value="1">1:入社</option>
      </select> 
    </label><br>
    <!-- HTML上にidは出ないが裏でデータを渡しておかないと、動かない -->
    <input type="hidden" name="id" value="<?= $result['id'] ?>">
    <input type="submit" value="送信">
    </fieldset>
  </div>
</form>
<!-- Main[End] -->


</body>

