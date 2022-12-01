<?php
    require('db_connect.php');

    $title   = $_POST["title"];
    $content = $_POST["content"];
    $submit  = $_POST["submit"];

    if (!empty($submit)) {
      
        $pdo = dbConnect();
      
        try {
            $sql = "INSERT INTO tasks (title, content) VALUES (:title, :content)";
            $stmt = $pdo->prepare($sql);
            $stmt->bindParam(":title", $title);
            $stmt->bindParam(":content", $content);
            $stmt->execute();
    
            header("Location: todo.php");
        } catch (PDOException $e) {
          echo $e->getMessage();
          exit();
        }
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>新規登録</title>
    </head>
  <body>
      <div class="title-area">
          <h1>新規登録</h1>
          <a href="todo.php" ><button type="button" class="btn btn-primary">リストを表示</button></a>
      </div>
      <form action="" method="POST">
          <input type="text" class="input-area" name="title" required> <br>
          <input type="text" class="input-area" name="content" placeholder="メモ" required> <br>
          <input type="submit" class="input-area submit" name="submit" value="登録">
      </form>
  </body>
</html>
  