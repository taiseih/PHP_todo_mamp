<?php 
    require_once('db_connect.php');

    $name = $_POST['name'];
    $password = $_POST['password'];
    $submit = $_POST['submit'];


    if(!empty($submit)){
        
        $pdo = dbConnect();

        try{
            $sql = "select * from users where name = :name";
            $stmt = $pdo -> prepare($sql);
            $stmt -> bindParam(':name',$name);
            $stmt -> execute();
        }catch(PDOException $e){
            echo 'エラー:'.$e -> getMessage();
            die();
        }

        if($data = $stmt -> fetch(PDO::FETCH_ASSOC)){
            if(password_verify($password,$data['password'])){
            header("Location:todo.php");
            exit;
        }else{
            echo '<font color="red">入力内容に誤りがあります</font>';
        }
    }
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<title>ログイン</title>
        <link rel="stylesheet" href="css/style.css">
    </head>
    <body>
        <div class="title-area">
            <h1>ログインページ</h1>
        </div>
        <form action="" method="POST">
            <input type="text" class="input-area" name="name" placeholder="ユーザー名" required> <br>
            <input type="password" class="input-area" name="password" placeholder="パスワード" required> <br>
            <input type="submit" class="input-area submit" name="submit" value="ログイン">
        </form>
</body>

</html>