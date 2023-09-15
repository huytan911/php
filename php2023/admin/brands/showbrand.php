<?php
    if(isset($_GET['id'])){
        $id = $_GET['id'];
        $products = $connect->query("SELECT * FROM product WHERE brandid=$id");
        if(mysqli_num_rows($products) !=0){
            $connect->query("UPDATE brand SET status=0 WHERE id=$id");
        }
        else {
            $connect->query("DELETE FROM brand WHERE id=$id");
        }
    }
?>
<?php 
    $query = "SELECT * FROM brand";
    $result = $connect->query($query);
?>
<h1>Hãng sản xuất</h1>
<section style="text-align:center"><a class="btn btn-success mb-3" href="?option=brandadd">Thêm hãng</a></section>
<table class="table table-bordered">
    <thead>
        <tr>
            <th>STT</th>
            <th>Mã hãng</th>
            <th>Tên hãng</th>
            <th>Trạng thái hãng</th>
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
                <td><?=($item['status']==1) ? 'Active':'Unactive'?></td>
                <td>    
                    <a class="btn btn-sm btn-info" href="?option=brandupdate&id=<?=$item["id"]?>">Update</a> 
                    <a class="btn btn-sm btn-danger" href="?option=brand&id=<?=$item['id']?>" onclick="return confirm('Are you sure?')">Delete</a>
                </td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>