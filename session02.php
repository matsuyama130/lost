<?php
// sessionに保存されている変数を取り出して表示しよう
session_start();
var_dump($_SESSION['keyword']);

exit();