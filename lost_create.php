<?php
session_start();
include('functions.php');
check_session_id();

if (
  !isset($_POST['lost']) || $_POST['lost'] == '' ||
  !isset($_POST['takeout']) || $_POST['takeout'] == ''
) {
  echo json_encode(["error_msg" => "no input"]);
  exit();
}

$lost = $_POST['lost'];
$takeout = $_POST['takeout'];

$pdo = connect_to_db();

$sql = 'INSERT INTO lost_table(id, lost, takeout, created_at, updated_at) VALUES(NULL, :lost, :takeout, now(), now())';

$stmt = $pdo->prepare($sql);
$stmt->bindValue(':lost', $lost, PDO::PARAM_STR);
$stmt->bindValue(':takeout', $takeout, PDO::PARAM_STR);

try {
  $status = $stmt->execute();
} catch (PDOException $e) {
  echo json_encode(["sql error" => "{$e->getMessage()}"]);
  exit();
}

header("Location:lost_input.php");
exit();


//var_dump($_FILES);
//exit();