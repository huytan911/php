<?php
    session_start();
    include "./controllers/ClientController.php";
    $cc = new ClientController();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="css/style.css"/>
    <title>OOP-MVC</title>
</head>
<body>
    <section>
        <header>Header</header>
        <nav>
            <a href="?request=home">Home</a>
            <a href="?request=news">News</a>
            <a href="?request=feedback">Feedback</a>
            <a href="?request=cart">Cart</a>
            <?php if(empty($_SESSION['user'])):?>
                <a href="?request=signin">Signin</a>
                <a href="?request=signup">Signup</a>
            <?php else: ?>
                <section style="line-height: 28px">Hello: <?=$_SESSION['user']?> [<a href="?request=logout">Log out</a>]</section>
            <?php endif;?>
        </nav>
        <section>
            <aside>
                <?php 
                    $brands = $cc->brands;
                    foreach($brands as $brand):
                ?>
                    <section><a href="?request=view&brandid=<?=$brand['id']?>"><?=$brand['name']?></a></section>
                <?php endforeach;?>
            </aside>
            <article><?php $cc->routes()?></article>
            <aside>Right</aside>
        </section>
        <footer>Footer</footer>
    </section>
</body>
</html>