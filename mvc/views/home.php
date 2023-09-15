<section>
    <?php foreach ($products as $product):?>
        <section><img src="images/<?=$product['image']?>"></section>
        <section><?=$product['name']?></section>
        <section><?=number_format($product['price'], 0, ',', '.')?></section>
    <?php endforeach;?>
</section>