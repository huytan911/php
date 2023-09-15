<?php
    $brand = mysqli_fetch_array($connect->query("SELECT * FROM brand WHERE id=".$_GET['id']));

?>

<?php
    if(isset($_POST['name'])){
        $name = $_POST['name'];
        $status = $_POST['status'];
        $query = "SELECT * FROM brand WHERE name='$name' AND id!=".$_GET['id'];
        if(mysqli_num_rows($connect->query($query)) != 0){
            $alert = "Tên hãng sản xuất đã tồn tại";
        }
        else {
            $query = "UPDATE brand SET name='$name', status='$status' WHERE id=".$brand['id'];
            $connect->query($query);
            $query = "UPDATE product SET status='$status' WHERE brandid = ". $brand['id'];
            $connect->query($query);
            header("location: ?option=brand");
        }
    }
?>

<h1>Cập nhật hãng sản xuất</h1>
<section style="color: red; font-weight:bold; text-align:center"><?=isset($alert) ? $alert:""?></section>
<section class="container col-md-6">
    <form method="post">
        <section class="form-group">
            <label>Tên hãng: </label><input type="text" value="<?=$brand['name']?>" name="name" class="form-control">
        </section>
        <section class="form-group">
            <label>Trạng thái hãng: </label> <br>
            <input type="radio" name="status" value="1" <?=$brand['status']==1 ? 'checked': ''?>>Active
            <input type="radio" name="status" value="0" <?=$brand['status']==0 ? 'checked': ''?>>Unactive
        </section>
        <section>
            <input type="submit" value="Cập nhật" class="btn btn-primary">
            <a href="?option=brand" class="btn btn-outline-secondary">&lt;&lt; Back</a>
        </section>
    </form>
</section>