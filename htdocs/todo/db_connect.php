<?php
    // 疎通確認
    function dbConnect()
    {
        $dsn = 'mysql:host=localhost;dbname=todo;charset=utf8';
        $user = 'root';
        $password = 'root';

        try {
            $pdo = new PDO($dsn, $user, $password);
            $pdo -> setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
            // var_dump("疎通確認OK!");
            return $pdo;

            
        } catch (PDOException $e) {
            echo 'Error:'.$e -> getMessage();
            exit();
        }
    }

    dbConnect();
// end疎通確認