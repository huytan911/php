<?php
    if(isset($_GET['id'])){
        $id = $_GET['id'];
        $products = $connect->query("SELECT * FROM orderdetail WHERE productid=$id");
        if(mysqli_num_rows($products) !=0){
            $connect->query("UPDATE product SET status=0 WHERE id=$id");
        }
        else {
            $connect->query("DELETE FROM product WHERE id=$id");
            unlink("../images/".$_GET['image']);
        }
    }
?>
<?php 
    $query = "SELECT * FROM product";
    $result = $connect->query($query);
?>
<h1>Danh sách sản phẩm</h1>
<section style="text-align:center"><a class="btn btn-success mb-3" href="?option=productadd">Thêm sản phẩm</a></section>
<table class="table table-bordered">
    <thead>
        <tr>
            <th>STT</th>
            <th>ID</th>
            <th>Tên</th>
            <th>Giá</th>
            <th>Ảnh</th>
            <th>Trạng thái</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
        <?php $count = 1?>
        <?php foreach($result as $item): ?>
            <tr>
                <td><?=$count++?></td>
                <td><?=$item['id']?></td>
                <td><?=$item['name']?></td>
                <td><?=number_format($item['price'], 0, ',', '.')?></td>
                <td width="30%"><img src="../images/<?=$item['image']?>" width="20%"></td>
                <td><?=($item['status']==1) ? 'Active':'Unactive'?></td>
                <td>    
                    <a class="btn btn-sm btn-info" href="?option=productupdate&id=<?=$item['id']?>">Update</a> 
                    <a class="btn btn-sm btn-danger" href="?option=product&id=<?=$item['id']?>&image=<?=$item['image']?>" 
                    onclick="return confirm('Are you sure?')">Delete</a>
                </td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>