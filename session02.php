<?php

// .session02.phpでSESSION変数に預けたデータを取得

// SESSIONスタート
session_start();
// SESSION変数を取得→登録データの呼び出し
$name = $_SESSION["name"];
$age = $_SESSION["age"];
$address = $_SESSION["address"];

echo $name;
echo $age;
echo $address;

?>