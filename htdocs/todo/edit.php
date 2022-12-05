<?php 
    require_once('db_connect.php');

    $id = $_GET['id'];

    $pdo = dbConnect();
    try {
        $sql = "SELECT * FROM tasks WHERE id = :id";
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(":id", $id);
        $stmt->execute();
      } catch (PDOException $e) {
        echo $e->getMessage();
        exit();
      }

    $data = $stmt->fetch(PDO::FETCH_ASSOC);
    $title = $data['title'];
    $content = $data['content'];
    $id = $data['id'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>編集</title>
</head>
    <body>
        <div class="title-area">
            <h1>編集画面</h1>
        </div>
        <form action="update.php" method="POST">
            <input type="text" class="input-area" name="title" value="<?php echo $title;?>"> <br>
            <input type="text" class="input-area" name="content" value="<?php echo $content;?>"> <br>
            <input type="hidden" name="id" value="<?php echo $id ?>"> 
            <input type="submit" class="input-area submit" name="submit" value="更新">
        </form>
        <a class="return" href="todo.php">戻る</a>
</body>
</html>