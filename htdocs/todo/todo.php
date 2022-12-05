<?php
require('db_connect.php');

//検索 
$search = $_POST['search'];
$search_word = $_POST['search_word'];
//end検索 


$pdo = dbConnect();

// 一覧表示
try {
    $sql = "SELECT * FROM tasks ORDER BY time";
    $stmt = $pdo->prepare($sql);
    $stmt->execute();
} catch (PDOException $e) {
    echo $e->getMessage();
    exit();
}
// 検索機能
if (!empty($search) && !empty($search_word)) {
    $search_pdo = dbConnect();
    try {
        $search_sql = "select * from tasks where content like '%$search_word%' or title like '%$search_word%'";
        $stmt = $search_pdo->prepare($search_sql);
        $stmt->execute();
    } catch (PDOException $e) {
        echo $e->getMessage();
        die();
    }
}

var_dump($_POST);

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- CSS only -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <title>メインページ</title>
</head>

<body>
    <h1>メインページ</h1>
    <!-- JavaScript Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <table class="table table-striped">
        <tr>
            <th scope="col">記事ID</th>
            <th scope="col">タイトル</th>
            <th scope="col">本文</th>
            <th scope="col">作成日</th>
            <th scope="col">編集</th>
            <th scope="col">削除</th>
        </tr>
        <?php while ($data = $stmt->fetch(PDO::FETCH_ASSOC)) : ?>
            <tr>
                <td><?php echo $data["id"]; ?></td>
                <td><?php echo $data["title"]; ?></td>
                <td><?php echo $data["content"]; ?></td>
                <td><?php echo $data["time"]; ?></td>
                <td><a href="edit.php?id=<?php echo $data['id']; ?>">編集</a></td>
                <td><a href="delete.php?id=<?php echo $data['id']; ?>">削除</a></td>
            </tr>
        <?php endwhile; ?>
        <button><a href="create.php">新規登録</a></button>

        <form action="" method="POST">
            検索キーワード:<input type="text" name="search_word"><input type="submit" name="search" value="検索">
        </form>

    </table>
</body>

</html>