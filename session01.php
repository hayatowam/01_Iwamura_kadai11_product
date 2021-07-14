<?php

// サーバー側に変数を保持することが可能になる

// 3.session01.phpのsession_id()の次に以下の処理を追加

// SESSIONスタート
session_start();


// SESSIONのidを取得
$sid = session_id(); 

// SESSION変数にデータを登録→名前と年を登録
$_SESSION["name"] = "中野";
$_SESSION["age"] = 26;
$_SESSION["address"] = "hayatoiwamura0912@gmail.com";

echo $sid; 


// ページを更新するたびに新しいセッションIDを発行するような仕組みを発見した


?>