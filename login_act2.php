<?php
// ユーザー情報があったらsession_idをSESSION変数に保存。つまりsession_idがあるのはログインユーザー
// login.phpからlogin_act.phpでログイン処理を経由して判定。ログインユーザーならばselect.phpに遷移、違う場合はlogin.phpにリダイレクト
// ハッシュ化する場合：phpadmin上のパスワードを変更する
// IDとパスワードがバレてしまった場合の処理→二段階認証をかけておくべき

//最初にSESSIONを開始！！ココ大事！！
session_start();
//POST値
$lid = $_POST['lid'];
$lpw = $_POST['lpw'];


//1.  DB接続します
require_once('funcs2.php');
$pdo = db_conn();

//2. データ登録SQL作成

// $stmt = $pdo->prepare("SELECT * FROM gs_user_table WHERE lid =:lid AND lpw=:lpw");//ハッシュ化しない時（平文を使う）
$stmt = $pdo->prepare("SELECT * FROM gs_user_table WHERE lid =:lid");//ハッシュ化する時。パスワードは取得しない
$stmt->bindValue(':lid', $lid, PDO::PARAM_STR);
// $stmt->bindValue(':lpw', $lpw, PDO::PARAM_STR); //* Hash化する場合はコメントする（ログインIDのみを取得するイメージ）
$status = $stmt->execute();


//3. SQL実行時にエラーがある場合STOP
if($status==false){
    sql_error($stmt);
}

//4. 抽出データ数を取得
$val = $stmt->fetch();         //1レコードだけ取得する方法
//$count = $stmt->fetchColumn(); //SELECT COUNT(*)で使用可能()

//5. 該当レコードがあればSESSIONに値を代入
if(password_verify($lpw, $val["lpw"])){ //ハッシュ化した際に使う文（パスワードがハッシュにマッチするかどうかを調べる）。暗号の解読関数。第一引数→入力したパスワード、第二引数→hashかされたパスワード
  // if( $val['id'] != "" ){
    //Login成功時
    // print '認証成功';
      $_SESSION['chk_ssid']  = session_id(); //SESSION変数にidを保存
      $_SESSION['kanri_flg'] = $val['kanri_flg']; //SESSION変数に管理者権限のflagを保存
      $_SESSION['name']      = $val['name']; //SESSION変数にnameを保存
      redirect('select2.php');
  }else{
    //Login失敗時(Logout経由)
    // print '認証失敗';
    redirect('login2.php');
  }

exit();


