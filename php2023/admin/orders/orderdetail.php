<?php
    if(isset($_GET['action'])){
        $condition = " WHERE orderid=".$_GET['orderid']." AND productid=".$_GET['productid'];
        if($_GET['type'] == "asc"){
            $query = "UPDATE orderdetail SET number=number+1".$condition;
        }
        else {
            $query = "UPDATE orderdetail SET number=number-1".$condition;
        }
        $connect->query($query);
        header("location: ?option=orderdetail&id=".$_GET['id']);
    }
    if(isset($_POST['status'])){
        $connect->query("UPDATE orders SET status=".$_POST['status']." WHERE id=".$_GET['id']);
        header("Refresh:0");
    }
?>

<?php 
    $query = "SELECT a.fullname, a.mobile AS 'mobilemem', a.address AS 'addressmem', a.email AS 'emailmem', b.*,
    c.name AS 'ordermethod'
    FROM member a INNER JOIN orders b ON a.id=b.memberid
    JOIN ordermethod c ON b.ordermethodid=c.id
    WHERE b.id=".$_GET['id'];
    $order = mysqli_fetch_array($connect->query($query));
    $ordermethod = mysqli_fetch_array($connect->query("SELECT * FROM ordermethod WHERE id=".$order['ordermethodid']));
?>
<h1>CHI TIẾT ĐƠN HÀNG<br>(Mã đơn hàng: <?=$order['id']?>)</h1>
<h2>NGÀY DẶT HÀNG</h2>
<p><?=$order['orderdate']?></p>
<h2>THÔNG TIN NGƯỜI ĐẶT HÀNG</h2>
<table class="table">
    <tbody>
        <tr>
            <td>Họ tên: </td>
            <td><?=$order['fullname']?></td>
        </tr>
        <tr>
            <td>Điện thoại: </td>
            <td><?=$order['mobilemem']?></td>
        </tr>
        <tr>
            <td>Địa chỉ: </td>
            <td><?=$order['addressmem']?></td>
        </tr>
        <tr>
            <td>Email: </td>
            <td><?=$order['emailmem']?></td>
        </tr>
        <tr>
            <td>Ghi chú: </td>
            <td><?=$order['note']?></td>
        </tr>
    </tbody>
</table>

<h2>THÔNG TIN NGƯỜI NHẬN HÀNG</h2>
<table class="table">
    <tbody>
        <tr>
            <td>Họ tên: </td>
            <td><?=$order['name']?></td>
        </tr>
        <tr>
            <td>Điện thoại: </td>
            <td><?=$order['mobile']?></td>
        </tr>
        <tr>
            <td>Địa chỉ: </td>
            <td><?=$order['address']?></td>
        </tr>
        <tr>
            <td>Email: </td>
            <td><?=$order['email']?></td>
        </tr>
    </tbody>
</table>
<h2>PHƯƠNG THỨC THANH TOÁN</h2>
<p><?=$order['ordermethod']?></p>
<?php
    $query = "SELECT a.status, b.*, c.name, c.image
    FROM orders a INNER JOIN orderdetail b ON a.id = b.orderid 
    JOIN product c ON b.productid=c.id
    WHERE a.id=".$order['id'];
    $orderdetail = $connect->query($query);
?>
<form method="POST">
    <h2>CÁC SẢN PHẨM ĐẶT MUA</h2>
    <?php $count = 1?>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>STT</th>
                <th>Tên sản phẩm</th>
                <th>Ảnh</th>
                <th>Giá</th>
                <th>Số lượng</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach($orderdetail as $item): ?>    
                <tr>
                    <td><?=$count++?></td>
                    <td><?=$item['name']?></td>
                    <td width="30%"><img src="../images/<?=$item['image']?>" width="20%"></td>
                    <td><?=number_format($item['price'], 0, ',', '.')?></td>
                    <td>
                        <input type="button" <?=$item['number']==0 ? 'disabled':''?> value="-" onclick="location='?option=orderdetail&action=update&id=<?=$_GET['id']?>&type=des&orderid=<?=$item['orderid']?>&productid=<?=$item['productid']?>';">
                        <?=$item['number']?>
                        <input type="button" value="+" onclick="location='?option=orderdetail&action=update&id=<?=$_GET['id']?>&type=asc&orderid=<?=$item['orderid']?>&productid=<?=$item['productid']?>';">
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    <h2>TRẠNG THÁI ĐƠN HÀNG</h2>
    <p style="display: <?=$order['status']==2 || $order['status']==3 ? 'none':''?>;"><input type="radio" name="status" value="1" <?=$order['status']==1 ? 'checked':''?>>  Chưa xử lý</p>
    <p style="display: <?=$order['status']==3 ? 'none':''?>;"><input type="radio" name="status" value="2" <?=$order['status']==2 ? 'checked':''?>>  Đang xử lý</p>
    <p><input type="radio" name="status" value="3" <?=$order['status']==3 ? 'checked':''?>>  Đã xử lý</p>
    <p style="display: <?=$order['status']==3 ? 'none':''?>;"><input type="radio" name="status" value="4" <?=$order['status']==4 ? 'checked':''?>>  Hủy</p>
    <section>
        <input <?=$order['status']==3 ? 'disabled':''?> type="submit" value="Update đơn hàng" class="btn btn-primary">
        <a href="?option=order&status=1" class="btn btn-outline-secondary">&lt;&lt; Back</a>
    </section>
</form>