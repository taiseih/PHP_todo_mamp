<?php

use ReCaptcha\RequestMethod\Post;

    require_once('db_connect.php');

    $name = $_POST['name'];
    $password = $_POST['password'];
    $submit = $_POST['submit'];


    if(!empty($submit)) {

        $pdo = dbConnect();

        try{
            $sql = "insert into users (name,password) values(:name,:password)";
            $stmt = $pdo->prepare($sql);
            $stmt -> bindParam(":name", $name);
            $password_hash = password_hash($password,PASSWORD_DEFAULT);
            $stmt -> bindParam(":password",$password_hash);
            $stmt -> execute();
            echo '<p class = "signup">登録処理が完了しました</p>';
        }catch(PDOException $e){
            echo $e -> getMessage();
        }
    }


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ユーザー登録</title>
</head>
<body>
    <form action="" method="post">
        <input type="text" class="input-area" name="name" placeholder="名前" required><br>
        <input type="password" class="input-area" name="password" placeholder="パスワード" required><br>
        <input type="submit" class="input-area submit" name="submit" value="新規登録">
    </form>
    <a href="login.php" class="login">ログインページに戻る</a>

</body>
</html>