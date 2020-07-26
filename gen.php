include_once "mysqlConnect.php"; // Подключение к БД
 
// Генерируем меню
function generation_head_menu ($mysqli) {
    $sql = "SELECT * FROM `categories`";
    $resSQL = $mysqli -> query($sql);
    ?>
 
    <header>
        <nav class="navbar navbar-dark bg-dark">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item"><a class="nav-link" href="index.php">Главное</a></li>
                <?php
                    while ($rowСategories = $resSQL -> fetch_assoc()) {
                        echo '<li class="nav-item"><a class="nav-link" href="./topic.php?id_categories='. $rowСategories["id"] .'">'. $rowСategories['name'].'</a></li>';
                    }
                ?>
            </ul>
        </nav>
    </header>
    <?php
}
 
// Выводим посты категории
function generation_posts ($mysqli, $id_topic) {
    $sql = "SELECT * FROM `articles` WHERE `id_categories` = $id_topic";
    echo $sql;
    $res = $mysqli -> query($sql);
 
    if ($res -> num_rows > 0) {
        while ($resArticle = $res -> fetch_assoc()) {
            ?>
            <div class="card-body">
                <h2><a href="post.php?id_article=<?= $resArticle['id'] ?>"><?= $resArticle['title'] ?></a></h2>
                <p class="text"><?= mb_substr($resArticle['text'], 0, 158, 'UTF-8') ?></p>
            </div>
            <?php
        }
    } else {
        echo "В этом раздели статей нету";
    }
}
 
// Выводим пост
function generation_post ($mysqli, $id_article) {
    $sql = "SELECT * FROM `articles` WHERE `id` = '$id_article'";
    $res = $mysqli -> query($sql);
 
    if ($res -> num_rows === 1) {
        $resPost = $res -> fetch_assoc()?>
        <h1><?= $resPost['title'] ?></h1>
        <p><?= $resPost['text'] ?></p>
        <p>Дата публикации: <?= substr($resPost['date'], 0, 11) ?></p>
        <?php
    }
}
 
// Выводим Коментарии
function generation_comment ($mysqli, $id_article) {
    $sql = "SELECT * FROM `comments` WHERE `id_article` = $id_article";
    $resSQL = $mysqli -> query($sql);
 
    if ($resSQL -> num_rows > 0) {
        while ($resComment = $resSQL -> fetch_assoc()) {
            ?>
            <div class="comment">
                <p><?= $resComment['comment'] ?></p>
                <p>Оставлин: <?= substr($resComment['date'], 0, 11)  ?></p>
            </div>
            <hr>
            <?php
        }
    } else {
        ?>
        <p>Комментариев нет</p>
        <?php
    }
}
