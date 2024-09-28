<?php
// エラー処理のコード
error_reporting(E_ALL);
ini_set('display_errors', 1);

//1. POSTデータ取得
//[name,email,age,naiyou]
$team_name      = $_POST["team_name"];
$team_url       = $_POST["team_url"];
$stadium_name   = $_POST["stadium_name"];
$stadium_url    = $_POST["stadium_url"];
$naiyou         = $_POST["naiyou"];

//2. DB接続します
try {
  //Password:MAMP='root',XAMPP=''  サクラサーバー登録時はここを変える￥
  $db_name =  '**********:';            //データベース名
  $db_host =  '***********';                          //DBホスト
  $db_id =    '*********';                //アカウント名(登録しているドメイン)
  $db_pw =    '*********';                  //さくらサーバのパスワード
  $server_info ='mysql:dbname='.$db_name.';charset=utf8;host='.$db_host;
  $pdo = new PDO($server_info, $db_id, $db_pw);
} catch (PDOException $e) {
  exit('DB_CONNECT:'.$e->getMessage());
}

//３．データ登録SQL作成
$sql="INSERT INTO rugby_an_db (team_name,team_url,stadium_name,stadium_url,naiyou,indate) 
       VALUES(:team_name,:team_url,:stadium_name,:stadium_url,:naiyou,sysdate());";

$stmt = $pdo->prepare($sql);
$stmt->bindValue(':team_name',     $team_name,    PDO::PARAM_STR);  //Integer（数値の場合 PDO::PARAM_INT)
$stmt->bindValue(':team_url',      $team_url,     PDO::PARAM_STR);  //Integer（数値の場合 PDO::PARAM_INT)
$stmt->bindValue(':stadium_name',  $stadium_name, PDO::PARAM_STR);  //Integer（数値の場合 PDO::PARAM_INT)
$stmt->bindValue(':stadium_url',   $stadium_url,  PDO::PARAM_STR);  //Integer（数値の場合 PDO::PARAM_INT)
$stmt->bindValue(':naiyou',        $naiyou,       PDO::PARAM_STR);  //Integer（数値の場合 PDO::PARAM_INT)
$status = $stmt->execute(); // true or false

//４．データ登録処理後
if($status==false){
  //SQL実行時にエラーがある場合（エラーオブジェクト取得して表示）
  $error = $stmt->errorInfo();
  exit("SQL_ERROR:".$error[2]);
}else{
  //５．index.phpへリダイレクト
header("Location: index.php");
exit();
}
?>





