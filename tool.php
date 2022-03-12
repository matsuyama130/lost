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
  <link rel="stylesheet" href="css/sample.css">
  <title>FACTORY MANAGER</title>
      <link rel="stylesheet" type="text/css" href="css/style.css" />
</head>
  <header>

  </header>

<body class="body">

  
    <form action="create_file.php" method="post" enctype="multipart/form-data">
    <fieldset>
      <legend><img src="img/kezuriya.png" alt=""></div></legend>
 <div class="menu">
    <a href="tool.php">ツールリスト</a>
    <a href="task.php">タスク</a>
    <a href="bbs.php">掲示板</a>
  <a href="lost_logout.php">ログアウト</a>
 </div>
    <br> 
     <div class="input" >
      <div>
        使用エリア: <input type="text" name="lost">
      </div>
      <div>
        工作機械: <input type="text" name="lost">
      </div>
       <div>
        ツール: <input type="text" name="lost">
      </div>
      <div>
        保管日: <input type="date" name="takeout">
      </div>
</div>
    <br> 

  <div class="input" >

    <div>
    <input type="file" name="upfile" accept="image/*" capture="camera" />
  </div>
      <div>
        <button>submit</button>
      </div>
      </div>

    </fieldset>


</body>

<body>
  <fieldset>
    <legend>ツールリスト</legend>

    <table>
      <thead>
        <tr>
          <th>登録日</th>
          <th>名称</th>
          <th>状態</th>
          <th>編集</th>
          <th>削除</th>
          <th>画像</th>
        </tr>
      </thead>
      <tbody>
        <?= $output ?>
      </tbody>
    </table>
  </fieldset>
</body>

</html>