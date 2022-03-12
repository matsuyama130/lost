<?php
session_start();
include('functions.php');
check_session_id();


//〇
//var_dump($_POST);
//exit();

// id受け取り
// DB接続
// SQL実行




$id = $_GET['id'];

$pdo = connect_to_db();

$sql = 'SELECT * FROM lost_table WHERE id=:id';

$stmt = $pdo->prepare($sql);
$stmt->bindValue(':id', $id, PDO::PARAM_INT);

try {
  $status = $stmt->execute();
} catch (PDOException $e) {
  echo json_encode(["sql error" => "{$e->getMessage()}"]);
  exit();
}

$record = $stmt->fetch(PDO::FETCH_ASSOC);


?>

<!DOCTYPE html>
<html lang="ja">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>DB連携型todoリスト（編集画面）</title>
</head>

<body>
<form action="lost_update.php" method="POST">
  <fieldset>
    <legend>DB連携型ツールリスト（編集画面）</legend>
    <a href="lost_read.php">一覧画面</a>
    <div>
      tool: <input type="text" name="tool" value="<?= $record['tool'] ?>">
    </div>
    <div>
      takeout: <input type="date" name="takeout" value="<?= $record['takeout'] ?>">
    </div>
    <div>
      <input type="hidden" name="id" value="<?= $record['id'] ?>">
    </div>
    <div>
      <button>submit</button>
    </div>
  </fieldset>
</form>

</body>

</html>