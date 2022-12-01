<?php
    require('db_connect.php');

    $id = $_GET['id'];
    $pdo = dbConnect();

    try {
        $sql = "DELETE FROM tasks WHERE id = :id";
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(":id", $id);
        $stmt->execute();
      
        header("Location: todo.php");
        exit;
      } catch (PDOException $e) {
        echo $e->getMessage();
        exit();
      }
?>