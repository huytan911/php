<?php
$query = "SELECT * FROM member a INNER JOIN wishlist b ON a.id = b.memberid
JOIN product c ON c.id = b.productid WHERE a.id = ". $_SESSION['memberid'];
$result = $conn->query($query);
?>
<?php 
if (isset($_GET['action'])) {
  if ($_GET['action'] == 'delete'){
    $memberid = $_GET['memberid'];
    $productid = $_GET['productid'];
    $query = "DELETE FROM wishlist WHERE memberid=$memberid AND productid=$productid";
    $conn->query($query);
    header("location: ?option=wishlist");
  }
  else if($_GET['action'] == 'add'){
    if(isset($_GET['memberid'])){
      $memberid = $_GET['memberid'];
      $productid = $_GET['productid'];
      $query = "INSERT INTO wishlist(memberid, productid) VALUES($memberid, $productid)";
      $conn->query($query);
      header("location: ?option=wishlist");
    }
    else {
      echo "<script>alert('Bạn cần đăng nhập để sử dụng tính năng này!');location='?option=home'</script>";
    }
  }
}
?>
<section class="bg-light my-5">
  <div class="container">
    <div class="row">
      <div class="col-lg-9">
        <div class="card border shadow-0">
          <div class="m-4">
            <h4 class="card-title mb-4">Danh sách yêu thích</h4>
            <?php
            if (mysqli_num_rows($result)) :
              foreach ($result as $item) :
            ?>
                <div class="row gy-3 mb-4">
                  <div class="col-lg-5">
                    <div class="me-lg-5">
                      <div class="d-flex">
                        <img src="images/<?= $item['image'] ?>" class="border rounded me-3" style="width: 96px; height: 96px;" />
                        <div class="">
                          <a href="?option=productdetail&id=<?= $item['id'] ?>" class="nav-link"><?= $item['name'] ?></a>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="col-lg-2 col-sm-6 col-6 d-flex flex-row flex-lg-column flex-xl-row text-nowrap">
                    <div class="mx-4">
                      <text class="h6"><?=number_format($item['price'], 0, '.', ',')?> VNĐ</text>
                    </div>
                  </div>
                  <div class="col-lg col-sm-6 d-flex justify-content-sm-center justify-content-md-start justify-content-lg-center justify-content-xl-end mb-2">
                    <div class="float-md-end">
                      <a href="?option=wishlist&action=delete&productid=<?=$item['productid']?>&memberid=<?=$item['memberid']?>" class="btn btn-light border text-danger icon-hover-danger"> Xóa</a>
                    </div>
                  </div>
                </div>
              <?php endforeach; ?>
            <?php
            else :
            ?>
              <section>
                Danh sách trống !!
              </section>
            <?php endif; ?>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
<section>
  <?php $conn ?>
  <div class="container my-5">
    <header class="mb-4">
      <h3>Sản phẩm đề xuất</h3>
    </header>

    <div class="row">
      <?php
      $query = $conn->query('SELECT * FROM product ORDER BY ordered desc LIMIT 4');
      foreach ($query as $item) :
      ?>
        <div class="col-lg-3 col-md-6 col-sm-6 ">
          <div class="card px-4 border shadow-0 mb-4 mb-lg-0">
            <div class="mask px-2" style="height: 50px;">
            </div>
            <a href="?option=productdetail&id=<?= $item['id'] ?>" class="">
              <img src="images/<?=$item['image']?>" class="card-img-top rounded-2" />
            </a>
            <div class="card-body d-flex flex-column pt-3 border-top">
              <a href="?option=productdetail&id=<?= $item['id'] ?>" class="nav-link"><?=$item['name']?></a>
              <div class="price-wrap mb-2">
                <strong class=""><?=number_format($item['price'], 0, '.', ',') ?> VNĐ</strong>
              </div>
              <div class="card-footer d-flex align-items-end pt-3 px-0 pb-0 mt-auto">
                <a href="?option=cart&action=add&id=<?= $item['id'] ?>" class="btn btn-outline-primary w-100">Thêm vào giỏ hàng</a>
              </div>
            </div>
          </div>
        </div>
      <?php endforeach; ?>
    </div>
  </div>
</section>