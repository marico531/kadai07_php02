<?php
//1.  DB接続します
try {
    $db_name =  '************************';            //データベース名
    $db_host =  '************************';  //DBホスト
    $db_id =    '*************************';                //アカウント名(登録しているドメイン)
    $db_pw =    '*************************:';           //さくらサーバのパスワード
    $server_info ='mysql:dbname='.$db_name.';charset=utf8;host='.$db_host;
    $pdo = new PDO($server_info, $db_id, $db_pw);
  } catch (PDOException $e) {
  exit('DB_CONNECT'.$e->getMessage());
  }

//２．データ登録SQL作成
$sql = "SELECT * FROM rugby_an_db";
$stmt = $pdo->prepare($sql);
$status = $stmt->execute();

//３．データ表示
$values = "";
if($status==false) {
  $error = $stmt->errorInfo();
  exit("SQLError:".$error[2]);
}

//全データ取得
$values =  $stmt->fetchAll(PDO::FETCH_ASSOC); //PDO::FETCH_ASSOC[カラム名のみで取得できるモード]
$json = json_encode($values,JSON_UNESCAPED_UNICODE);

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
<style>div{padding: 10px;font-size:16px;}</style>
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

<table>
<table border='1' style='border-collapse: collapse; width: 50%; text-align: left;'>
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
<?php foreach($values as $v){ ?>
  <tr>
    <td><?=$value["id"]?></td>
    <td><?=$value["team_name"]?></td>
    <td><?=$value["team_url"]?></td>
    <td><?=$value["stadium_name"]?></td>
    <td><?=$value["stadium_url"]?></td>
    <td><?=$value["naiyou"]?></td>
  </tr>
<?php } ?>
</table>

  </div>
</div>
<!-- Main[End] -->
<script>
  const a = '<?php echo $json; ?>';
  console.log(JSON.parse(a));
</script>
</body>
</html>
