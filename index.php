<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <title>チーム一覧</title>
  <link href="css/bootstrap.min.css" rel="stylesheet">
  <style>div{padding: 10px;font-size:16px;}</style>
</head>
<body>

<!-- Head[Start] -->
<header>
  <nav class="navbar navbar-default">
    <div class="container-fluid">
    <div class="navbar-header"><a class="navbar-brand" href="select.php">チーム一覧</a></div>
    </div>
  </nav>
</header>
<!-- Head[End] -->

<!-- Main[Start] -->
<form method="POST" action="insert.php">
  <div class="jumbotron">
   <fieldset>
    <legend>チーム情報登録</legend>
     <label>チーム名：<input type="text"   name="team_name"></label><br>
     <label>チームサイトURL：<input type="text"   name="team_url"></label><br>
     <label>メインスタジアム名：<input type="text"   name="stadium_name"></label><br>
     <label>スタジアムサイトURL：<input type="text"   name="stadium_url"></label><br>
     <label><textArea name="naiyou" rows="4" cols="40"></textArea></label><br>
     <input type="submit" value="送信">
    </fieldset>
  </div>
</form>
<!-- Main[End] -->
<br>
<a href="select.php">チーム一覧を見る</a>

</body>
</html>


