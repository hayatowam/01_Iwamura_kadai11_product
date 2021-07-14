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
//1. POSTデータ取得
    //$name = filter_input( INPUT_GET, ","name" ); //こういうのもあるよ
    //$email = filter_input( INPUT_POST, "email" ); //こういうのもあるよ
    $name = $_POST["name"];
    $url = $_POST["url"];
    $comment = $_POST["comment"];
    $rate = $_POST["rate"];
    $favoritepage = $_POST["favoritepage"];
    $id = $_POST["id"];
    
    // var_dump($name);

//2. DB接続します
    require_once('funcs2.php');
    $pdo = db_conn();
    $db_table = "gs_bm_table";
//３．データ登録SQL作成→Updateはこの書き方でしかできない
// 更新するデータ＝バインド変数にする
    $stmt = $pdo->prepare(
        "UPDATE $db_table SET 
        name=:name, url=:url, comment=:comment, rate=:rate, favoritepage=:favoritepage
        , date=sysdate() where id=:id"
    );

// バインド変数を用意。数値を作った箱に入れていくイメージ
    $stmt->bindValue(':name', $name, PDO::PARAM_STR);/// 文字の場合 PDO::PARAM_STR
    $stmt->bindValue(':url', $url, PDO::PARAM_STR);// 文字の場合 PDO::PARAM_STR
    $stmt->bindValue(':comment', $comment, PDO::PARAM_STR);// 数値の場合 PDO::PARAM_INT
    $stmt->bindValue(':rate', $rate, PDO::PARAM_INT);// 文字の場合 PDO::PARAM_STR
    $stmt->bindValue(':favoritepage', $favoritepage, PDO::PARAM_STR);// 数値の場合 PDO::PARAM_INT
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
        redirect('select2.php');
      }