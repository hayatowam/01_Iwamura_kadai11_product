<?php
// データ取得し表示するためのPHP
//1.  DB接続します
try {
  //Password:MAMP='root',XAMPP=''
  $pdo = new PDO('mysql:dbname=book_review;charset=utf8;host=localhost','root','root');
} catch (PDOException $e) {
  exit('DBConnectError:'.$e->getMessage());
}

// try {
//   //Password:MAMP='root',XAMPP=''
//   $pdo = new PDO('mysql:dbname=book_review;charset=utf8;host=localhost','root','root');
// } catch (PDOException $e) {
//   exit('DBConnectError:'.$e->getMessage());
// }

// echo 'test';
// exit(); //この上までちゃんと動いているかいなかのテストができる



// ---------------------------
// テスト１
// ----------------------------
//２．SQL文を用意(データ取得：SELECT)
// $sql = 'SHOW TABLES';
// $stmt = $dbh->query($sql);
$stmt = $pdo->prepare("SELECT * FROM gs_bm_table");

//3. 実行
$status = $stmt->execute();

//4．データ表示


$view="";//空のviewを作成
if($status==false) {
    //execute（SQL実行時にエラーがある場合）
  $error = $stmt->errorInfo();
  exit("ErrorQuery:".$error[2]);

}else{
  //Selectデータの数だけ自動でループしてくれる
  // データの数だけPタグを入れてあげる
  //FETCH_ASSOC=http://php.net/manual/ja/pdostatement.fetch.php
  while( $result = $stmt->fetch(PDO::FETCH_ASSOC)){ 
    $view .= "<p>";
    $view .= $result['date'].':'.$result['name'].':'.$result['comment'].':'.$result['rate'].':'.$result['favoritepage'].':'.$result['url']; 
    // $view .= $result['date'].':'.$result['name'].':'.$result['comment']; 
    // ↑ここの書き方が重要
    $view .= "</p>";
  }
}

var_dump($result['name']);
// exit();

// よく使う関数はfuncs.phpにまとめておくとGood。




// <!-- ************************************* -->
// <!-- // テスト2 -->
// <!-- *************************************** -->

//２．SQL文を用意(データ取得：SELECT)
// $sql = 'SHOW TABLES';
// $stmt = $dbh->query($sql);
$stmt = $pdo->prepare("SELECT * FROM gs_bm_table");

//3. 実行
$status = $stmt->execute();

//4．データ表示

// $view="";//空のviewを作成


while ($result = $stmt->fetch(PDO::FETCH_ASSOC)){
  $table_names[] = $result[0];
}

$table_data = array();
foreach ($table_names as $key => $val) {
  $sql2 = "SELECT * FROM $val;";
  $stmt2 = $dbh->query($sql2);
  $table_data[$val] = array();
  while ($result2 = $stmt2->fetch(PDO::FETCH_ASSOC)){
      foreach ($result2 as $key2 => $val2) {
          $table_data[$val][$key2] = $val2;
      }
  }
}

foreach ($table_data as $key => $val) {
  echo "<h1>$key</h1>";
  if (empty($val)) {
      continue;
  }
  echo "<table border=1 style=border-collapse:collapse;>";
  echo "<tr>";
  foreach ($table_data[$key] as $key2 => $val2) {
  echo "<th>";
  echo $key2;
  echo "</th>";
  }
  echo "</tr>";
  echo "<tr>";
  foreach ($table_data[$key] as $key2 => $val2) {
  echo "<td>";
  echo $val2;
  echo "</td>";
  }
  echo "</tr>";
  echo "</table>";
}

?>
<!DOCTYPE html>
<html lang="ja">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>ブックマーク一覧表示</title>
<link rel="stylesheet" href="css/range.css">
<link href="css/bootstrap.min.css" rel="stylesheet">
<style>div{padding: 10px;font-size:16px;}</style>
</head>
<body id="main">
<!-- Head[Start] -->
<header>
  <nav class="navbar navbar-default">
    <div class="container-fluid">
      <div class="navbar-header">
      <a class="navbar-brand" href="index2.php">データ登録</a>
      </div>
    </div>
  </nav>
</header>
<!-- Head[End] -->

<!-- Main[Start] -->
 <!-- <div>
<div class="container jumbotron">



<!-- Main[End] -->

</body>
</html>
