<?php
session_start();
include("functions.php");
check_session_id();
//todo
if (
  !isset($_POST['lost']) || $_POST['lost'] == '' ||
  !isset($_POST['takeout']) || $_POST['takeout'] == ''
) {
  echo json_encode(["error_msg" => "no input"]);
  exit();
}

$lost = $_POST['lost'];
$takeout = $_POST['takeout'];


// ここからファイルアップロード&DB登録の処理を追加しよう！！！
//var_dump($_FILES);
//exit();

if (isset($_FILES['upfile']) && $_FILES['upfile']['error'] == 0) {
  // 情報の取得
  $uploaded_file_name = $_FILES['upfile']['name'];
  $temp_path  = $_FILES['upfile']['tmp_name'];
  $directory_path = 'upload/';
  // ファイル名の準備
  $extension = pathinfo($uploaded_file_name, PATHINFO_EXTENSION);
  $unique_name = date('YmdHis').md5(session_id()) . '.' . $extension;
  $save_path = $directory_path . $unique_name;
  // 今回は画面に表示しないので権限の変更までで終了
  if (is_uploaded_file($temp_path)) {
    if (move_uploaded_file($temp_path, $save_path)) {
      chmod($save_path, 0644);
    } else {
      exit('Error:アップロードできませんでした');
    }
  } else {
    exit('Error:画像がありません');
  }
} else {
  exit('Error:画像が送信されていません');
}

// ファイル保存処理など

$pdo = connect_to_db();

$sql = 'INSERT INTO lost_table(id, lost, takeout, image, created_at, updated_at) VALUES(NULL, :lost, :takeout, :image, now(), now())';

$stmt = $pdo->prepare($sql);
$stmt->bindValue(':lost', $lost, PDO::PARAM_STR);
$stmt->bindValue(':takeout', $takeout, PDO::PARAM_STR);
$stmt->bindValue(':image', $save_path, PDO::PARAM_STR);

try {
  $status = $stmt->execute();
} catch (PDOException $e) {
  echo json_encode(["sql error" => "{$e->getMessage()}"]);
  exit();
}

header("Location:lost_input.php");
exit();