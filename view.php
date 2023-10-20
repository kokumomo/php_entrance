<?php

$comment_array = array();

if (!empty($_POST["submitButton"])) {
    echo $_POST["username"];
    echo '<br>';
    echo $_POST["comment"];
}

// DB接続
try {
    $pdo = new PDO('mysql:host=localhost;dbname=bbs-yt', "root", "root");
    echo 'DB接続成功！';
} catch (PDOException $e) {
    echo '接続失敗'. $e->getMessage();
}

// DBからコメントデータを取得する
$sql = "SELECT `id`, `usernae`, `comment`, `postDate` FROM `bbs-table`;";
$comment_array = $pdo->query($sql);

var_dump($comment_array);
// DBの接続を閉じる
$dbh = null;
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PHP掲示板</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <h1 class="title">PHPで掲示板アプリ</h1>
    <hr>
    <div class="boardWrapper">
        <section>
            <?php foreach($comment_array as $comment): ?>
                <article>
                    <div class="wrapper">
                        <div class="nameArea">
                            <span>名前：</span>
                            <p class="username"><?php echo $comment['usernae'] ?></p>
                            <time>：<?php echo $comment['postDate'] ?></time>
                        </div>
                        <p class="comment"><?php echo $comment['comment'] ?></p>
                    </div>
                </article>
            <?php endforeach; ?>
        </section>
        <form action="" class="formWrapper" method="POST">
            <div>
                <input type="submit" value="書き込む" name="submitButton">
                <label for="">名前：</label>
                <input type="text" name="username">
            </div>
            <div>
                <textarea class="commentTextArea" name="comment"></textarea>
            </div>
        </form>
    </div>
    
</body>
</html>