<?php
// 1. POSTデータ取得
//$name = filter_input( INPUT_GET, ","name" ); //こういうのもあるよ
//$email = filter_input( INPUT_POST, "email" ); //こういうのもあるよ
$name = $_POST["name"];
$url = $_POST["url"];
$comment = $_POST["comment"];
$rate = $_POST["rate"];
$favoritepage = $_POST["favoritepage"];

// var_dump($name);


// 2. DB接続します

  // 初回のやり方
  // try {
  //   //Password:MAMP='root',XAMPP=''
  //   // Try→チャレンジしますよ、の意味
  //   $pdo = new PDO('mysql:dbname=book_review;charset=utf8;host=localhost','root','root');
  // } catch (PDOException $e) {
  //   exit('DBConnectError:'.$e->getMessage());
  // }

  // funcs利用のやり方
  require_once('funcs2.php');
  $pdo = db_conn();
  $db_table = "gs_bm_table";

// ３．SQL文を用意(データ登録：INSERT)
// 一度仮の挿入位置を渡してあげるイメージ。実際の値は、４で指定し入力する
$stmt = $pdo->prepare(
  "INSERT INTO $db_table( id, name, url, comment, date, rate, favoritepage)
  VALUES( NULL, :name, :url, :comment, sysdate(), :rate, :favoritepage )"
);
// 4. バインド変数を用意→クッションを挟むことで、文字列化してあげることが可能
$stmt->bindValue(':name', $name, PDO::PARAM_STR);  //Integer（数値の場合 PDO::PARAM_INT)
$stmt->bindValue(':url', $url, PDO::PARAM_STR);  //Integer（数値の場合 PDO::PARAM_INT)
$stmt->bindValue(':comment', $comment, PDO::PARAM_STR);  //Integer（数値の場合 PDO::PARAM_INT)
$stmt->bindValue(':rate', $rate, PDO::PARAM_STR);  //Integer（数値の場合 PDO::PARAM_INT)
$stmt->bindValue(':favoritepage', $favoritepage, PDO::PARAM_STR);  //Integer（数値の場合 PDO::PARAM_INT)

// 5. 実行→データの登録
$status = $stmt->execute();

// 6．データ登録処理後→エラーがなければ終了
if($status==false){
  //SQL実行時にエラーがある場合（エラーオブジェクト取得して表示）
  $error = $stmt->errorInfo();
  exit("ErrorMassage:".$error[2]);
}else{
  //５．index2.phpへリダイレクト
  header('Location: index2.php');//ヘッダーロケーション（リダイレクト）
}

?>


<!-- // gittest -->