<?php
//var_dump($_GET);
//exit();


include("functions.php");
$search_word = $_GET["searchword"];
$pdo = connect_to_db();

$sql = "SELECT * FROM lost_table  WHERE lost LIKE :search_word";

$stmt = $pdo->prepare($sql);
$stmt->bindValue(':search_word', "%{$search_word}%", PDO::PARAM_STR);

try {
  $status = $stmt->execute();
} catch (PDOException $e) {
  echo json_encode(["sql error" => "{$e->getMessage()}"]);
  exit();
}

$result = $stmt->fetchAll(PDO::FETCH_ASSOC);
echo json_encode($result);
exit();