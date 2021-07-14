<?php
//共通に使う関数を記述

//XSS対応（ echoする場所で使用！それ以外はNG ）
function h($str)
{
    return htmlspecialchars($str, ENT_QUOTES);
}

//DB接続関数：db_conn() 
//※関数を作成し、内容をreturnさせる。
//※ DBname等、今回の授業に合わせる。
function db_conn(){
    // insert.phpから持ってきた関数
    try {
        // ------------------
        // ローカル用
        // ------------------
        $db_name = "book_review";    //データベース名
        $db_id   = "root";      //アカウント名
        $db_pw   = "root";      //パスワード：XAMPPはパスワード無しに修正してください。
        $db_host = "localhost"; //DBホスト


        
        $pdo = new PDO('mysql:dbname=' . $db_name . ';charset=utf8;host=' . $db_host, $db_id, $db_pw);
        return $pdo; //1行追記
      } catch (PDOException $e) {
      exit('DBConnectError:'.$e->getMessage());
      }
}


//SQLエラー関数：sql_error($stmt)
function sql_error($stmt){
    $error = $stmt->errorInfo();
    exit("SQLError:" . print_r($error, true));
}

//リダイレクト関数: redirect($file_name)
function redirect($file_name){
    header("Location: " . $file_name ); //ファイル名が挿入される。その後Index.phpにおいて、リダイレクトされる
    exit();
}
// 引数を関数として使うことができる

//ログインチェック
// エラーが出る→セッションに保持されているIDとセッションIDが異なっている状況
function loginCheck(){
    if( $_SESSION['chk_ssid'] != session_id() ){
      exit('LOGIN ERROR');
    }else{
      session_regenerate_id(true); //新しいセッションIDを取り直す。ログインIDACTで取得したIDも更新される
      $_SESSION['chk_ssid'] = session_id();
    }
  }