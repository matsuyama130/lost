<?php


function connect_to_db()
{
  $dbn='mysql:dbname=lost_factory;charset=utf8mb4;port=3306;host=mysql-2.mc.lolipop.lan';
  $user = 'ec9a3598b0575699a2047f0529d235f2';
  $pwd = 'Hibikiseiki130';
  try {
    return new PDO($dbn, $user, $pwd);
  } catch (PDOException $e) {
      echo json_encode(["db error" => "{$e->getMessage()}"]);
    exit();
  }
}

// ログイン状態のチェック関数


function check_session_id()
{
  if (
    !isset($_SESSION["session_id"]) ||
    $_SESSION["session_id"] != session_id()
  ) {
    header("Location:lost_login.php");
  } else {
    session_regenerate_id(true);
    $_SESSION["session_id"] = session_id();
  }
}
