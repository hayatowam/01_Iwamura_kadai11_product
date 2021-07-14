<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width">
<link rel="stylesheet" href="css/main.css" />
<link href="css/bootstrap.min.css" rel="stylesheet">
<style>div{padding: 10px;font-size:16px;}</style>
<title>ログイン</title>
</head>
<body>

<header>
  <nav class="navbar navbar-default">
    <div class="container-fluid">
      <div class="navbar-header">
        <div class="title">ブックマークアプリ</div>
        <div class="page_title">ログインページ</div>
      </div>
    </div>
  </nav>
</header>
<h2>ログインフォーム</h2>
<!-- lLOGINogin_act2.php は認証処理用のPHPです。 -->
<form name="form1" action="login_act2.php" method="post">
ID:<input type="text" name="lid" />
PW:<input type="password" name="lpw" />
<input type="submit" value="LOGIN" />

<div>
  <a href="top_nologin.php">ログインせずに進む</a>
</div>

</form>


</body>
</html>