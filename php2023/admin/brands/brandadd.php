<?php
if(isset($_POST['name'])){
    $name = $_POST['name'];
    $query = "SELECT * FROM brand WHERE name='$name'";
    if(mysqli_num_rows($connect->query($query))){
        $alert = "Đã tồn tại tên hãng này";
    }
    else {
        $status = $_POST['status'];
        $query = "INSERT brand(name, status) VALUES('$name', $status)";
        $connect->query($query);
        header("location: ?option=brand");
    }
}
?>

<h1>Thêm hãng sản xuất</h1>
<section style="color: red; font-weight:bold; text-align:center"><?=isset($alert) ? $alert:""?></section>
<section class="container col-md-6">
    <form method="post">
        <section class="form-group">
            <label>Tên hãng: </label><input type="text" name="name" class="form-control">
        </section>
        <section class="form-group">
            <label>Trạng thái hãng: </label> <br>
            <input type="radio" name="status" value="1" checked class="">Active
            <input type="radio" name="status" value="0">Unactive
        </section>
        <section>
            <input type="submit" value="Thêm" class="btn btn-primary">
            <a href="?option=brand" class="btn btn-outline-secondary">&lt;&lt; Back</a>
        </section>
    </form>
</section>