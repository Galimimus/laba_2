<?php
$msg = $_POST["text"];
echo "$msg";
$link = mysqli_connect('localhost', 'newuser', 'password','oh_my_laba');
    if ($link == false){
        print("Ошибка: Невозможно подключиться к MySQL " . mysqli_connect_error());
    }
    
    mysqli_set_charset($link, "utf8");
    $sql = "INSERT INTO messages (text, likes, time) VALUES ('$msg', 0, NOW())";
    $result = mysqli_query($link,$sql);

    if ($result == false) {

        print("Произошла ошибка при выполнении запроса");

    }else{
        setcookie("text", $msg);
        setcookie("likes", $likes);
        mysqli_close($link);
        header("Location: index.php", true, 303);
    }
mysqli_close($link);