<?php
include_once "./templates/generation.php";
 
$id_article = $_REQUEST["id_article"]; // ID статьи
$comment = $_REQUEST["comment"];
 
// Отправка комментарий
if (isset($_REQUEST['doGo']) === true) {
    send_comment($mysqli, $_REQUEST['comment'], $id_article);
}
 
 
?>
 
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
</head>
<body>
    <?php
        // Генерация меню
        generation_head_menu($mysqli);
    ?>
    <div class="container-md">
        <div class="post">
            <?php
            // Вывод поста
            generation_post($mysqli, $id_article);
            ?>
        </div>
        // Коментарии
        <div class="comments">
            <hr>
            <form action="<?= $_SERVER["SCRIPT_NAME"] ?>">
                <textarea name="comment" id="" style="width:800px; height:50px;"></textarea>
                <input name="doGo" type="submit" value="Отправить">
            </form>
            <p>Коментарии:</p>
            <hr>
            
            <?php
            // Вывод комментариев
            generation_comment($mysqli, $id_article);
            ?>
        </div>
    </div>
</body>
</html>
