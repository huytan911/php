<?php
    $product = mysqli_fetch_array($connect->query("SELECT * FROM product WHERE id=".$_GET['id']));
?>

<?php
if(isset($_POST['name'])){
    $name = $_POST['name'];
    $query = "SELECT * FROM product WHERE name='$name' AND id!=".$product['id'];
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
            unlink($store.$product['image']);
        }
        else{
            $alert = "Định dạng file không phù hợp";
        }         
        if(empty($imageName)){
            $imageName = $product['image'];
        }
        $connect->query("UPDATE product SET brandid='$brandid', name='$name', price='$price', image='$imageName', 
        description='$description', status='$status' WHERE id=".$product['id']);
        header("location: ?option=product");
    }
}
?>
<?php
    $brands = $connect->query("SELECT * FROM brand")
?>
<h1>Update sản phẩm</h1>
<section style="color: red; font-weight:bold; text-align:center"><?=isset($alert) ? $alert:""?></section>
<section class="container col-md-6">
    <form method="post" enctype="multipart/form-data">
        <section>
            <label>Hãng sản xuất: </label>
            <select name="brandid" class="form-control">
                <option hidden>--Chọn hãng sản xuất--</option>
                <?php foreach($brands as $item): ?>
                    <option value="<?=$item['id']?>" <?=$product['brandid']==$item['id'] ? 'selected':''?>><?=$item['name']?></option>
                <?php endforeach; ?>
            </select>
        </section>
        <section class="form-group">
            <label>Tên sản phẩm: </label><input type="text" name="name" class="form-control" value="<?=$product['name']?>" required> 
        </section>
        <section class="form-group">
            <label>Giá: </label><input type="number" min="100000" name="price" class="form-control" value="<?=$product['price']?>" required>
        </section>
        <section class="form-group">
            <label>Ảnh: </label><br>
            <img src="../images/<?=$product['image']?>" width="60%">
            <input type="file" name="image" class="form-control">
        </section>
        <section class="form-group">
            <label>Mô tả: </label>
            <textarea name="description"><?=$product['description']?></textarea>
            <script>CKEDITOR.replace("description")</script>
        </section>
        <section class="form-group">
            <label>Trạng thái: </label> <br>
            <input type="radio" name="status" value="1" <?=$product['status']==1 ? 'checked':''?>>Active
            <input type="radio" name="status" value="0" <?=$product['status']==0 ? 'checked':''?>>Unactive
        </section>
        <section>
            <input type="submit" value="Update" class="btn btn-primary">
            <a href="?option=product" class="btn btn-outline-secondary">&lt;&lt; Back</a>
        </section>
    </form>
</section>