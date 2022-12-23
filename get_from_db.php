<?php
function connect()
{
    $link = mysqli_connect("localhost", "newuser", "password", "oh_my_laba");
    if ($link == false) {

        print("Ошибка: Невозможно подключиться к MySQL " . mysqli_connect_error());

    }

    mysqli_set_charset($link, "utf8");

    return $link;
}

function get_size(){
    $link = connect();
    $sql = "SELECT * FROM messages";
    $result = mysqli_query($link, $sql);
    $num_rows = mysqli_num_rows( $result);
    mysqli_close($link);
    return $num_rows;
}

function get_message($id){
    $link = connect(); 
    $sql = "SELECT * FROM messages WHERE id = $id ";
    $result = mysqli_query($link, $sql);
    if ($result == false) {

        $row['text'] = "Произошла ошибка при выполнении запроса";

    }else
        $row = mysqli_fetch_array($result);
    mysqli_close($link);
    return $row;
}

function get_text($row){
    $text = $row['text'];
    return $text;
}

function get_comments($id){
    $link = connect(); 
    $sql = "SELECT * FROM comments WHERE message_id = $id ";
    $result = mysqli_query($link, $sql);
    if ($result == false) {

        print( "Произошла ошибка при выполнении запроса");

    }else
    mysqli_close($link);
    return $result;
}