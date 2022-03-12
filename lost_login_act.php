<?php
// データ受け取り
//var_dump($_POST);
//exit();

session_start();
include('functions.php');

$username = $_POST['username'];
$password = $_POST['password'];

// DB接続
$pdo = connect_to_db();

// SQL実行
// username，password，is_deletedの3項目全てを満たすデータを抽出する．
$sql = 'SELECT * FROM users_table WHERE username=:username AND password=:password AND is_deleted=0';

$stmt = $pdo->prepare($sql);
$stmt->bindValue(':username', $username, PDO::PARAM_STR);
$stmt->bindValue(':password', $password, PDO::PARAM_STR);

try {
  $status = $stmt->execute();
} catch (PDOException $e) {
  echo json_encode(["sql error" => "{$e->getMessage()}"]);
  exit();
}

$val = $stmt->fetch(PDO::FETCH_ASSOC);

// ユーザ有無で条件分岐
if (!$val) {
  echo "<p>ログイン情報に誤りがあります</p>";
  echo "<a href=lost_login.php>ログイン</a>";
  exit();
} else {
  $_SESSION = array();
  $_SESSION['user_id'] = $val['id'];
  $_SESSION['session_id'] = session_id();
  $_SESSION['is_admin'] = $val['is_admin'];
  $_SESSION['username'] = $val['username'];
  header("Location:lost_read.php");
  exit();
}