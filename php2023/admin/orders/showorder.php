<?php
    if(isset($_GET['id'])){
        $id = $_GET['id'];
        $connect->query("DELETE FROM orderdetail WHERE orderid=$id");
        $connect->query("DELETE FROM orders WHERE id=$id");
        header("location: ?option=order&status=4");
    }
?>
<?php 
    $status = $_GET['status'];
    $query = "SELECT * FROM orders WHERE status=".$_GET['status'];
    $result = $connect->query($query);
    switch ($status){
        case 1:
            $status = "CHƯA XỬ LÝ";
            break;
        case 2:
            $status = "ĐANG XỬ LÝ";
            break;
        case 3:
            $status = "ĐÃ XỬ LÝ";
            break;
        case 4:
            $status = "HỦY";
            break;
    }
?>
<h1>DANH SÁCH ĐƠN HÀNG <?=$status?></h1>
<table class="table table-bordered">
    <thead>
        <tr>
            <th>STT</th>
            <th>ID</th>
            <th>Ngày đặt hàng</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
        <?php $count = 1?>
        <?php foreach($result as $item): ?>
            <tr>
                <td><?=$count++?></td>
                <td><?=$item['id']?></td>
                <td><?=$item['orderdate']?></td>
                <td>    
                    <a class="btn btn-sm btn-info" href="?option=orderdetail&id=<?=$item['id']?>">Detail</a> 
                    <a class="btn btn-sm btn-danger" style="display: <?=$status=="HỦY"?'':'none'?>" 
                    href="?option=order&id=<?=$item['id']?>" onclick="return confirm('Are you sure?')">Delete</a>
                </td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>