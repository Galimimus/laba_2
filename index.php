<?php
require('get_from_db.php');
?>

<!DOCTYPE html>
<html lang="ru">
    <head>
        <meta charset="UTF-8">
        <title>login</title>
        <style>
            .block1{
                margin-left: 500px; 
                margin-right: 500px; 
                margin-top: 0px;
                padding-left: 20px;
                padding-right: 20px;
                padding-top: 50px;
                padding-bottom: 50px;
                background-color: darkgray;
            }
            .input1{
                outline: none;
                border: 2px solid #ccc;
                border-radius: 4px;
                background-color: #f8f8f8;
                font-size: 16px;
                resize: none

            }
            .output1{
                border: 2px solid #ccc;
                border-radius: 4px;
                background-color: #f8f8f8;
                font-size: 16px;
                resize: none
            }
            .block_messages{
                margin-top: 10px;
                padding-left: 10px;
                padding-top: 10px;
                padding-bottom: 10px;
                background-color: #0066FF;
                border-radius: 4px;
                font-size: 16px;
                color: white;
                padding-right: 10px;
            }
            .message{
                padding-left: 10px;
                padding-right: 10px;
                padding-top: 10px;
                padding-bottom: 10px;
                background-color: white;
                color: black;
                font-size: 16px;
                border-radius: 4px;
                margin-top:1%;
            }
            .output2{
                font-size: 16px;
                margin-right: 10px;
                color: #f8f8f8;
                margin-left: 10px;
                margin-right: 10px;

            }
            
        </style>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-iYQeCzEYFbKjA/T2uDLTpkwGzCiq6soy8tYaI1GyVh/UjpbCx/TYkiZhlZB6+fzT" crossorigin="anonymous">
    </head>
    <body>
        <div class="block1">
            <p>Напишите свое анонимное сообщение!</p>
            <form method="POST" action="add_to_db.php" class = "form-horizontal" id="msg"></form>
                <div class="form-group">
                    <textarea class="input1" rows="4" cols="35" type="text" name="text" form="msg"></textarea>
                </div>
                <div>
                    <input type="submit" value="Отправить" class="btn btn-primary" form="msg"/>
                </div>
            <?php  
                
                $size = get_size();
                $i=0;
                while($size>100){
                    $size--;
                }
                while($size>$i){
            ?>
                <div class="block_messages">
                    Anonymous
                    <div class="message">
                        <textarea class="output1" cols="73" rows="5" disabled="disabled"><?php
                        $row = get_message($size);
                        $size--;
                        echo $row['text'];
                 ?></textarea>
                    </div>
                    <form method = "POST" action="change_likes.php">
                        <div>
                            <input type="submit" value="Like" class="btn btn-primary"/>
                            <label class="output2"><?php echo $row['likes'];?></label>
                            <label class="output2"><?php echo $row['time'];?></label>
                            <input type="hidden" value="<?php echo $row['likes'];?>" name = "post_likes"></input>
                            <input type="hidden" value="<?php echo $row['id'];?>" name = "id"></input>
                        </div>
                    </form>
                    <form method = "POST" action="add_comment.php">
                        <div>
                            <input type="text" name = "text" class="input1"></input>
                            <input type="submit" value="Написать комментарий" class="btn btn-primary"/>
                            <input type="hidden" value="<?php echo $row['id'];?>" name = "id"></input>
                        </div>
                    </form>
                    <form method="POST" action="index.php">
                    <input type="submit" value="Посмотреть комментарии" class="btn btn-primary" name="show_comments"/>
                    <input type="hidden" value="<?php echo $row['id'];?>" name = "msg_id"></input>
                    </form>
                    <?php
                    if(isset($_POST['show_comments'])&&$_POST['msg_id']==$row['id']){
                        $id = $_POST['msg_id'];
                        $comments = get_comments($id);
                        foreach($comments as $comment){?>
                            <div class='message'>
                            <p>by Anonymous</p>
                            <textarea class="output1" cols="73" rows="5" disabled="disabled"><?php echo $comment['text'];?></textarea>
                            <div><?php echo $comment['time'];?></div>
                            </div>
                            <?php

                        }
                    }
                    ?>
                </div>
            <?php  }?>
        </div>
        
    </body>
</html>