<?php
//1.  DB接続します
try {
    $db_name =  'otenki-marico_rugby_db';            //データベース名
    $db_host =  'mysql3101.db.sakura.ne.jp';  //DBホスト
    $db_id =    'otenki-marico';                //アカウント名(登録しているドメイン)
    $db_pw =    'marico333';           //さくらサーバのパスワード
    $server_info ='mysql:dbname='.$db_name.';charset=utf8;host='.$db_host;
    $pdo = new PDO($server_info, $db_id, $db_pw);
  } catch (PDOException $e) {
    exit('DB_CONNECT:'.$e->getMessage());
}

//2．データ登録SQL作成
$sql = "SELECT * FROM rugby_an_db";
$stmt = $pdo->prepare($sql);
$status = $stmt->execute();

//3．データ表示
$values = "";
if ($status == false) {
    $error = $stmt->errorInfo();
    exit("SQLError:".$error[2]);
}

// 全データ取得
$values = $stmt->fetchAll(PDO::FETCH_ASSOC); // PDO::FETCH_ASSOCでカラム名のみで取得
$json = json_encode($values, JSON_UNESCAPED_UNICODE);

?>

<!DOCTYPE html>
<html lang="ja">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>チーム一覧表示</title>
<link rel="stylesheet" href="css/range.css">
<link href="css/bootstrap.min.css" rel="stylesheet">
<style>
  div { padding: 10px; font-size: 16px; }
  table { width: 100%; } /* テーブル全体の幅を100%に */
  th, td { padding: 8px; text-align: left; }
  th { background-color: #f2f2f2; }

  /* 列の幅を設定 */
  td:nth-child(2), td:nth-child(4), td:nth-child(6) {
    white-space: nowrap;  /* 改行を防ぐ */
    width: 250px;         /* 固定の幅を指定 */
    overflow: hidden;
    text-overflow: ellipsis; /* 溢れた場合は省略記号（…）を表示 */
  }

</style>
</head>
<body id="main">
<!-- Head[Start] -->
<header>
  <nav class="navbar navbar-default">
    <div class="container-fluid">
      <div class="navbar-header">
        <a class="navbar-brand" href="index.php">チーム一覧</a>
      </div>
    </div>
  </nav>
</header>
<!-- Head[End] -->

<!-- Main[Start] -->
<div>
  <div class="container jumbotron">
    <table border='1' style='border-collapse: collapse;'>
      <thead>
        <tr>
          <th>ID</th>
          <th>チーム名</th>
          <th>チームサイトURL</th>
          <th>メインスタジアム名</th>
          <th>スタジアムサイトURL</th>
          <th>備考</th>
        </tr>
      </thead>
      <tbody>
        <?php foreach($values as $v){ ?>
          <tr>
            <td><?= $v["id"] ?></td>
            <td><?= $v["team_name"] ?></td>
            <td><?= $v["team_url"] ?></td>
            <td><?= $v["stadium_name"] ?></td>
            <td><?= $v["stadium_url"] ?></td>
            <td><?= $v["naiyou"] ?></td>
          </tr>
        <?php } ?>
      </tbody>
    </table>
  </div>
</div>
<!-- Main[End] -->

<script>
  const jsonData = '<?php echo $json; ?>';
  console.log(JSON.parse(jsonData));
</script>
</body>
</html>