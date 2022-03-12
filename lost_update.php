<?php
session_start();
include('functions.php');
check_session_id();
//〇
//var_dump($_POST);
//exit();
// 入力項目のチェック


// DB接続


// SQL実行

if (
  !isset($_POST['tool']) || $_POST['tool'] == '' ||
  !isset($_POST['takeout']) || $_POST['takeout'] == '' ||
  !isset($_POST['id']) || $_POST['id'] == ''
) {
  exit('paramError');
}

$tool = $_POST['tool'];
$takeout = $_POST['takeout'];
$id = $_POST['id'];

// DB接続

include('functions.php');
$pdo = connect_to_db();

$sql = 'UPDATE lost_table SET tool=:tool, takeout=:takeout, updated_at=now() WHERE id=:id';

$stmt = $pdo->prepare($sql);
$stmt->bindValue(':tool', $tool, PDO::PARAM_STR);
$stmt->bindValue(':takeout', $takeout, PDO::PARAM_STR);
$stmt->bindValue(':id', $id, PDO::PARAM_STR);

try {
  $status = $stmt->execute();
} catch (PDOException $e) {
  echo json_encode(["sql error" => "{$e->getMessage()}"]);
  exit();
}

header('Location:lost_read.php');
exit();
