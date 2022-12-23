<?php
    $link = mysqli_connect("localhost", "newuser", "password", "oh_my_laba");
    if ($link == false) {

        print("Ошибка: Невозможно подключиться к MySQL " . mysqli_connect_error());

    }

    mysqli_set_charset($link, "utf8");

    $id = $_POST['id'];
    $likes = $_POST['post_likes'];
    $likes++;
    $sql = "UPDATE messages SET likes=$likes WHERE id = $id";
    $result = mysqli_query($link,$sql);
    mysqli_close($link);
    header("Location: index.php");
