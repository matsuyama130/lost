<?php
session_start();
include('functions.php');
check_session_id();


//〇
//var_dump($_POST);
//exit();


// データ受け取り


// DB接続


// SQL実行


$id = $_GET['id'];

$pdo = connect_to_db();

$sql = 'DELETE FROM lost_table WHERE id=:id';

$stmt = $pdo->prepare($sql);
$stmt->bindValue(':id', $id, PDO::PARAM_STR);

try {
  $status = $stmt->execute();
} catch (PDOException $e) {
  echo json_encode(["sql error" => "{$e->getMessage()}"]);
  exit();
}

header("Location:lost_read.php");
exit();
