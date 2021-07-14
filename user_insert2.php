<?php
//1. POSTデータ取得
$name   = $_POST["name"];
$lid  = $_POST["lid"];
$lpw = $_POST["lpw"];
$hlpw = password_hash($lpw,PASSWORD_DEFAULT);
$kanri_flg = $_POST["kanri_flg"];
$life_flg = $_POST["life_flg"];

// $naiyou = $_POST["naiyou"];

// -------------------登録時にパスワード登録する場合-------------------------
// 平文で受け取る
// $pass = $_POST["naiyou"]; //パスワード入力があった場合
// ハッシュ化
$pw = password_hash($pass); //パスワード入力があった場合

//2. DB接続します
require_once('funcs2.php');
$pdo = db_conn();

//３．データ登録SQL作成
$stmt = $pdo->prepare("INSERT INTO gs_user_table(name,lid,lpw,kanri_flg
,life_flg)VALUES(:name,:lid,:lpw, :kanri_flg, :life_flg)");
$stmt->bindValue(':name', $name, PDO::PARAM_STR);  //Integer（数値の場合 PDO::PARAM_INT)
$stmt->bindValue(':lid', $lid, PDO::PARAM_STR);  //Integer（数値の場合 PDO::PARAM_INT)
$stmt->bindValue(':lpw', $hlpw, PDO::PARAM_STR);  //Integer（数値の場合 PDO::PARAM_INT)
$stmt->bindValue(':kanri_flg', $kanri_flg, PDO::PARAM_INT);  //Integer（数値の場合 PDO::PARAM_INT)
$stmt->bindValue(':life_flg', $life_flg, PDO::PARAM_INT);  //Integer（数値の場合 PDO::PARAM_INT)
$status = $stmt->execute(); //実行

//４．データ登録処理後
if($status==false){
  sql_error($stmt);
}else{
  redirect("user_index2.php");
}
?>

