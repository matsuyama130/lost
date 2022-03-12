<?php
session_start();
include('functions.php');
check_session_id();

$user_id = $_SESSION['user_id'];


$pdo = connect_to_db();



//$sql = 'SELECT * FROM lost_table ORDER BY takeout ASC';
$sql = 'SELECT * FROM lost_table LEFT OUTER JOIN (SELECT lost_id, COUNT(id) AS check_count FROM check_table GROUP BY lost_id) AS result_table ON lost_table.id = result_table.lost_id';
$stmt = $pdo->prepare($sql);

try {
  $status = $stmt->execute();
} catch (PDOException $e) {
  echo json_encode(["sql error" => "{$e->getMessage()}"]);
  exit();
}

$result = $stmt->fetchAll(PDO::FETCH_ASSOC);
//var_dump($result);
//exit();


$output = "";

foreach ($result as $record) {
  $output .= "
    <tr>
      <td>{$record["takeout"]}</td>
      <td>{$record["lost"]}</td>
<td><a href='check_create.php?user_id={$user_id}&lost_id={$record["id"]}'>check({$record['check_count']})</a></td>
      <td><a href='lost_edit.php?id={$record["id"]}'>edit</a></td>
      <td><a href='lost_delete.php?id={$record["id"]}'>delete</a></td>
      <td><img src='{$record["image"]}' height='150px'></td>
    </tr>
  ";
}


?>

<!DOCTYPE html>
<html lang="ja">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>DB連携型ツールリスト（一覧画面）</title>
</head>

<body>
  <fieldset>
    <legend>DB連携型ツールリスト（一覧画面）</legend>
    <a href="lost_input.php">入力画面</a>
     <a href="lost_logout.php">logout</a>
    <table>
      <thead>
        <tr>
          <th>tool</th>
          <th>lost</th>
          <th></th>
          <th></th>
        </tr>
      </thead>
      <tbody>
        <?= $output ?>
      </tbody>
    </table>
  </fieldset>
</body>

</html>