<?php


//selsect.phpから処理を持ってくる
//1.外部ファイル読み込みしてDB接続
require_once('funcs2.php');
$pdo = db_conn();
$db_table = "gs_bm_table";

//2.対象のIDを取得
$id = $_GET['id'];
// この$idはURLにくっつけて持ってきていたID（select.phpのファイルのwhile文の中のidを参照している）

//3．データ取得SQL作成（登録ではないと思われる）
// 個々の入力データを持ってくる→IDをキーにしている
$stmt = $pdo->prepare("SELECT * FROM $db_table WHERE id=:id");
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
<body>

<!-- Head[Start] -->
    <header>
    <nav class="navbar navbar-default">
        <div class="container-fluid">
        <div class="navbar-header"><a class="navbar-brand" href="select2.php">データ一覧</a></div>
        </div>
    </nav>
</header>
<!-- Head[End] -->

<!-- Main[Start] -->
<form method="POST" action="update2.php">
    <!-- // <form method="どんな方法で" action="どこに"> -->
    <div class="jumbotron">
    <fieldset>
        <legend>本のブックマーク</legend>
        <label>本のタイトル：<input type="text" name="name" value="<?= $result['name'] ?>"></label><br>
        <!-- ↓テキストエリアの場合はvalue=の形にしない  -->
        <label>コメント：<textArea name="comment" rows="4" cols="40"><?= $result['comment'] ?></textArea></label><br>
        <label>評価：
        <select id="list" name="rate">
            <option hidden><?= $result['rate'] ?></option>
            <option value="1">1</option>
            <option value="2">2</option>
            <option value="3">3</option>
            <option value="4">4</option>
            <option value="5">5</option>
        </select> 
        </label><br>
        <label>お気に入りページ：<input name="favoritepage" value="<?= $result['favoritepage'] ?>"></label><br>
        <label>URL：<input type="text" name="url" value="<?= $result['url'] ?>"></label><br>
        <!-- ↓追加 生成したidをinputしてあげるイメージ-->
        <!-- HTML上にidは出ないが裏でデータを渡しておかないと、動かない -->
        <input type="hidden" name="id" value="<?= $result['id'] ?>">
        <input type="submit" value="送信">
        </fieldset>
    </div>
</form>
<!-- Main[End] -->


</body>