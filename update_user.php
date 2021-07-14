<html lang="ja">

<!-- これは入力データのupdate用のページ -->

<head>
    <meta charset="UTF-8">
    <title>データ更新</title>
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <style>
        div {
            padding: 10px;
            font-size: 16px;
        }
    </style>
</head>


<?php
//insert.phpの処理を持ってくる
// 1. POSTデータ取得
    //$name = filter_input( INPUT_GET, ","name" ); //こういうのもあるよ
    //$email = filter_input( INPUT_POST, "email" ); //こういうのもあるよ
    $name = $_POST["name"];
    $lid= $_POST["lid"];
    $lpw = $_POST["lpw"];
    $kanri_flg = $_POST["kanri_flg"];
    $life_flg = $_POST["life_flg"]; 
    $id = $_POST["id"];
    $hlpw = password_hash($lpw,PASSWORD_DEFAULT);
    // var_dump($name);

//2. DB接続します
    require_once('funcs2.php');
    $pdo = db_conn();

//３．データ登録SQL作成→Updateはこの書き方でしかできない
// 更新するデータ＝バインド変数にする
    $stmt = $pdo->prepare(
        "UPDATE gs_user_table SET 
        name=:name, lid=:lid, lpw=:lpw, kanri_flg=:kanri_flg
        , life_flg=:life_flg
        where id=:id"
    );

// バインド変数を用意。数値を作った箱に入れていくイメージ
    $stmt->bindValue(':name', $name, PDO::PARAM_STR);/// 文字の場合 PDO::PARAM_STR
    $stmt->bindValue(':lid', $lid, PDO::PARAM_STR);// 文字の場合 PDO::PARAM_STR
    $stmt->bindValue(':lpw', $hlpw, PDO::PARAM_STR);// 数値の場合 PDO::PARAM_INT
    $stmt->bindValue(':kanri_flg', $kanri_flg, PDO::PARAM_INT);// 文字の場合 PDO::PARAM_STR
    $stmt->bindValue(':life_flg', $life_flg, PDO::PARAM_INT);// 数値の場合 PDO::PARAM_INT
    $stmt->bindValue(':id', $id, PDO::PARAM_INT);// 数値の場合 PDO::PARAM_INT    

// 実行
    $status = $stmt->execute(); //実行

    
//４．データ登録処理後
    if($status==false){
        //SQL実行時にエラーがある場合（エラーオブジェクト取得して表示）
        //以下を関数化
        sql_error($stmt);
      }else{
        //５．index.phpへリダイレクト
        //以下を関数化
        redirect('select_user.php');
      }