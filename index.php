<?php
session_start();
include('functions.php');
check_session_id();
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
        管理エリア: <input type="text" name="lost">
      </div>
      <div>
        工作機械: <input type="text" name="lost">
      </div>
       <div>
        ツール: <input type="text" name="lost">
      </div>
      <div>
        登録日: <input type="date" name="takeout">
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
  </form>
 <br> 
    <footer>
      <iframe class="miraicamera"  src="https://my.matterport.com/show/?m=CmcV6c51UY7&hl=1&hr=1&lang=jp&help=2&play=1"
      </iframe>
  </footer>

</body>

</html>