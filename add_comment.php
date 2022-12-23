<?php
$msg = $_POST["text"];
$id = $_POST["id"];

$link = mysqli_connect('localhost', 'newuser', 'password','oh_my_laba');
    if ($link == false){
        print("Ошибка: Невозможно подключиться к MySQL " . mysqli_connect_error());
    }
    
    mysqli_set_charset($link, "utf8");
    $sql = "INSERT INTO comments (message_id, text, time) VALUES ($id, '$msg', NOW())";
    $result = mysqli_query($link,$sql);

    if ($result == false) {

        print("Произошла ошибка при выполнении запроса");

    }else{
        mysqli_close($link);
        header("Location: index.php", true, 303);
    }
