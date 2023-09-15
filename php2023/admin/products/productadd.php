<?php
if(isset($_POST['name'])){
    $name = $_POST['name'];
    $query = "SELECT * FROM product WHERE name='$name'";
    if(mysqli_num_rows($connect->query($query)) != 0){
        $alert = "Đã tồn tại tên sản phẩm này";
    }
    else {
        $brandid = $_POST['brandid'];
        $price = $_POST['price'];
        $description = $_POST['description'];
        $status = $_POST['status'];
        $store = "../images/";
        $imageName = $_FILES['image']['name'];
        $imageTemp = $_FILES['image']['tmp_name'];
        $ext = explode('.', $imageName);
        $extension = strtolower(end($ext));
        $allowed = array('jpg', 'jpeg', 'png', 'webp', 'gif', 'bmp');
        if(in_array($extension, $allowed)){
            $imageName = time().'_'.$imageName;
            move_uploaded_file($imageTemp, $store.$imageName);
            $connect->query("INSERT product(brandid, name, price, image, description, status)
            VALUES('$brandid', '$name', '$price', '$imageName', '$description', '$status')");
            header("location: ?option=product");
        }
        else {
            $alert = "Định dạng file không phù hợp";
        }
    }
}
?>
<?php
    $brands = $connect->query("SELECT * FROM brand")
?>
<h1>Thêm sản phẩm</h1>
<section style="color: red; font-weight:bold; text-align:center"><?=isset($alert) ? $alert:""?></section>
<section class="container col-md-6">
    <form method="post" enctype="multipart/form-data">
        <section>
            <label>Hãng sản xuất: </label>
            <select name="brandid" class="form-control">
                <option hidden>--Chọn hãng sản xuất--</option>
                <?php foreach($brands as $item): ?>
                    <option value="<?=$item['id']?>"><?=$item['name']?></option>
                <?php endforeach; ?>
            </select>
        </section>
        <section class="form-group">
            <label>Tên sản phẩm: </label><input type="text" name="name" class="form-control" required> 
        </section>
        <section class="form-group">
            <label>Giá: </label><input type="number" min="100000" name="price" class="form-control" required>
        </section>
        <section class="form-group">
            <label>Ảnh: </label><input type="file" name="image" class="form-control" required>
        </section>
        <section class="form-group">
            <label>Mô tả: </label>
            <textarea name="description"></textarea>
            <script>CKEDITOR.replace("description")</script>
        </section>
        <section class="form-group">
            <label>Trạng thái: </label> <br>
            <input type="radio" name="status" value="1" checked class="">Active
            <input type="radio" name="status" value="0">Unactive
        </section>
        <section>
            <input type="submit" value="Thêm" class="btn btn-primary">
            <a href="?option=product" class="btn btn-outline-secondary">&lt;&lt; Back</a>
        </section>
    </form>
</section>