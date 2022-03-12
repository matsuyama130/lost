<!DOCTYPE html>
<html lang="ja">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>ツールリストログイン画面</title>
</head>

<body>
 <form action="lost_login_act.php" method="POST">
    <fieldset>
      <legend>ツールリストログイン画面</legend>
      <div>
        username: <input type="text" name="username">
      </div>
      <div>
        password: <input type="text" name="password">
      </div>
      <div>
        <button>Login</button>
      </div>
      <a href="lost_register.php">or register</a>
    </fieldset>
  </form>

</body>

</html>