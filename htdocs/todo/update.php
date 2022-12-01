<?php

    require('db_connect.php');

    $id      = $_POST['id'];
    $title   = $_POST['title'];
    $content = $_POST['content'];
    $submit  = $_POST['submit'];

    $pdo = dbConnect();
    try {
        $sql = "UPDATE tasks SET title = :title, content = :content WHERE id = :id";
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(":id", $id);
        $stmt->bindParam(":title", $title);
        $stmt->bindParam(":content", $content);
        $stmt->execute();
    
      } catch (PDOException $e) {
        echo $e->getMessage();
      }
      header("Location: todo.php");
      exit();
?>