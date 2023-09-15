<?php
if (isset($_POST['content'])) {
  $content = $_POST['content'];
  $productid = $_GET['id'];
  if (isset($_SESSION['member'])) {
    date_default_timezone_set('Asia/Ho_Chi_Minh');
    $date = date('Y/m/d H:i:s');
    $memberid = mysqli_fetch_array($conn->query("SELECT * FROM member WHERE username='" . $_SESSION['member'] . "'"));
    $memberid = $memberid['id'];
    $conn->query("INSERT comment(memberid, productid, date, content) VALUES($memberid, $productid, now(), '$content')");
    // echo "<script>alert('Your comment was submited and processing!')</script>";
  } else {
    $_SESSION['content'] = $content;
    echo "<script>alert('Bạn cần phải đăng nhập để có thể bình luận'); 
    location='?option=signin&productid=$productid'</script>";
  }
}
?>
<?php

$id = $_GET['id'];
$query = "SELECT * FROM product WHERE id=$id";
$result = $conn->query($query);
$product = mysqli_fetch_array($result);
?>
<section class="py-5">
  <div class="container">
    <div class="row gx-5">
      <aside class="col-lg-6">
        <div class="border rounded-4 mb-3 d-flex justify-content-center">
          <a data-fslightbox="mygalley" class="rounded-4" data-type="image">
            <img style="max-width: 100%; max-height: 100vh; margin: auto;" class="rounded-4 fit" src="images/<?= $product['image'] ?>" />
          </a>
        </div>
      </aside>
      <main class="col-lg-6">
        <div class="ps-lg-3">
          <h4 class="title text-dark">
            <?= $product['name'] ?>
          </h4>
          <div class="d-flex flex-row my-3">
            <div class="text-warning mb-1 me-2">
              <i class="fa fa-star"></i>
              <i class="fa fa-star"></i>
              <i class="fa fa-star"></i>
              <i class="fa fa-star"></i>
              <i class="fas fa-star-half-alt"></i>
              <span class="ms-1">
                4.5
              </span>
            </div>
            <span class="text-muted"><i class="fas fa-shopping-basket fa-sm mx-1"></i><?=$product['ordered']?> đơn</span>
          </div>

          <div class="mb-3">
            <span class="h5"><?= number_format($product['price'], 0, '.', ',') ?> VNĐ</span>
          </div>

          <section>
            <?= $product['description'] ?>
          </section>

          <hr />
        <form action="?option=cart&action=add&id=<?= $product['id'] ?>" method="post">
          <div class="row mb-4">
            <div class="col-md-4 col-6 mb-3">
              <label class="mb-2 d-block">Số lượng</label>
              <div class="input-group mb-3" style="width: 170px;">
                <button class="btn btn-white border border-secondary px-3" type="button" onclick=decrease()>
                  <i class="fas fa-minus"></i>
                </button>
                <input type="text" name="quantity" class="form-control text-center border border-secondary" value="1" id="quantity" />
                <button class="btn btn-white border border-secondary px-3" type="button" onclick=increase()>
                  <i class="fas fa-plus"></i>
                </button>
              </div>
            </div>
          </div>
          <input type="submit" class="btn btn-info shadow-0" value="Thêm vào giỏ hàng"/>
          <?php if(isset($_SESSION['memberid'])):?>
            <a href="?option=wishlist&action=add&productid=<?=$product['id']?>&memberid=<?=$_SESSION['memberid']?>" class="btn btn-light border px-2 pt-2 icon-hover"><i class="fas fa-heart fa-lg px-1"></i></a>
          <?php else: ?>
            <a href="?option=wishlist&action=add&productid=<?=$product['id']?>" class="btn btn-light border px-2 pt-2 icon-hover"><i class="fas fa-heart fa-lg px-1"></i></a>
          <?php endif; ?>
        </form>
        </div>
      </main>
    </div>
  </div>
</section>
<section class="bg-light border-top py-4">
  <div class="container">
    <div class="row gx-4">
      <div class="col-lg-8 mb-4">
        <div class="border rounded-2 px-3 py-2 bg-white">
          <ul class="nav nav-pills nav-justified mb-3">
            <li class="nav-item d-flex">
              <a class="nav-link d-flex align-items-center justify-content-center w-100 active">Mô tả sản phẩm</a>
            </li>
          </ul>
          <div class="tab-content" id="ex1-content">
            <div class="tab-pane fade show active" id="ex1-pills-1" role="tabpanel" aria-labelledby="ex1-tab-1">
              <p>
                Mỗi lần ra mắt phiên bản mới là mỗi lần iPhone chiếm sóng trên khắp các mặt trận và lần này cái tên khiến vô số người "sục sôi" là iPhone 13 Pro,
                chiếc điện thoại thông minh vẫn giữ nguyên thiết kế cao cấp, cụm 3 camera được nâng cấp, cấu hình mạnh mẽ cùng thời lượng pin lớn ấn tượng.
              </p>
              <div class="row mb-2">
                <div class="col-12 col-md-6">
                  <ul class="list-unstyled mb-0">
                    <li><i class="fas fa-check text-success me-2"></i>Một số tính năng tại đây</li>
                    <li><i class="fas fa-check text-success me-2"></i>Cáp sạc USB-C sang Lightning</li>
                    <li><i class="fas fa-check text-success me-2"></i>Trải nghiệm điện ảnh đỉnh cao</li>
                    <li><i class="fas fa-check text-success me-2"></i>Bảo hành chính hãng điện thoại 1 năm tại các trung tâm bảo hành</li>
                  </ul>
                </div>
                <div class="col-12 col-md-6 mb-0">
                  <ul class="list-unstyled">
                    <li><i class="fas fa-check text-success me-2"></i>Hiệu năng vượt trội</li>
                    <li><i class="fas fa-check text-success me-2"></i>Tối ưu điện năng - Sạc nhanh 20 W</li>
                    <li><i class="fas fa-check text-success me-2"></i>Thiết kế đặc trưng với màu sắc thời thượng</li>
                  </ul>
                </div>
              </div>
              <table class="table border mt-3 mb-2">
                <tr>
                  <th class="py-2">Màn hình:</th>
                  <td class="py-2">6.7 inches Super Retina XDR OLED</td>
                </tr>
                <tr>
                  <th class="py-2">Bộ xử lý:</th>
                  <td class="py-2"> Chip Apple A15 Bionic</td>
                </tr>
                <tr>
                  <th class="py-2">Camera:</th>
                  <td class="py-2">720p FaceTime HD camera</td>
                </tr>
                <tr>
                  <th class="py-2">RAM:</th>
                  <td class="py-2">6 GB RAM hoặc 8 GB RAM</td>
                </tr>
                <tr>
                  <th class="py-2">Hệ điều hành:</th>
                  <td class="py-2">iOS 15</td>
                </tr>
              </table>
            </div>
          </div>
        </div>
      </div>
      <div class="col-lg-4">
        <div class="px-0 border rounded-2 shadow-0">
          <div class="card">
            <div class="card-body">
              <h5 class="card-title">Sản phẩm tương tự</h5>
              <?php
              $query = "SELECT * FROM product WHERE brandid=" . $product['brandid'] . " AND id!=" . $product['id'];
              $result = $conn->query($query);
              foreach ($result as $item) :
              ?>
                <div class="d-flex mb-3">
                  <a href="?option=productdetail&id=<?= $item['id'] ?>" class="me-3">
                    <img src="images/<?= $item['image'] ?>" style="min-width: 96px; height: 96px;" class="img-md img-thumbnail" />
                  </a>
                  <div class="info">
                    <a href="?option=productdetail&id=<?= $item['id'] ?>" class="nav-link mb-1">
                      <?= $item['name'] ?>
                    </a>
                    <strong class="text-dark"> <?= number_format($item['price'], 0, '.', ',') ?> VNĐ</strong>
                  </div>
                </div>
              <?php endforeach; ?>
            </div>
          </div>
        </div>
      </div>
      <section>
        <h2>Bình luận: </h2>
        <section>
          <div class="container">
            <div class="row d-flex justify-content-start">
              <div class="col-md-12 col-lg-10 col-xl-8">
                <div class="card">
                  <?php
                  $query = "SELECT * FROM member a INNER JOIN comment b ON a.id=b.memberid
                      JOIN product c ON c.id=b.productid
                      WHERE b.status=1 AND productid=" . $_GET['id'];
                  $comments = $conn->query($query);
                  if (mysqli_num_rows($comments) == 0) {
                    echo "<section>Không có bình luận nào</section></br>";
                  } else {
                    foreach ($comments as $item) : ?>
                      <div class="card-body">
                        <div class="d-flex flex-start align-items-center">
                          <img class="rounded-circle shadow-1-strong me-3" src="https://antimatter.vn/wp-content/uploads/2022/11/anh-avatar-trang-fb-mac-dinh.jpg" alt="avatar" width="60" height="60" />
                          <div>
                            <h6 class="fw-bold text-primary mb-1"><?= $item['fullname'] ?></h6>
                            <p class="text-muted small mb-0">
                              Shared publicly - <?= $item['date'] ?>
                            </p>
                          </div>
                        </div>
                        <p class="mt-3 mb-4 pb-2">
                          <?= $item['content'] ?>
                        </p>

                        <div class="small d-flex justify-content-start">
                          <a href="?option=productdetail&id=<?= $item['id'] ?>&action=like" class="d-flex align-items-center me-3">
                            <i class="far fa-thumbs-up me-2"></i>
                            <p class="mb-0">Thích</p>
                          </a>
                          <!-- <a href="#!" class="d-flex align-items-center me-3">
                            <i class="far fa-comment-dots me-2"></i>
                            <p class="mb-0">Phản hồi</p>
                          </a> -->
                        </div>
                      </div>
                  <?php endforeach;
                  } ?>
                  <form method="POST">
                    <div class="card-footer py-3 border-0" style="background-color: #f8f9fa;">
                      <div class="d-flex flex-start w-100">
                        <img class="rounded-circle shadow-1-strong me-3" src="https://antimatter.vn/wp-content/uploads/2022/11/anh-avatar-trang-fb-mac-dinh.jpg" alt="avatar" width="40" height="40" />
                        <textarea class="form-control" name="content" rows="4" style="background: #fff;" placeholder="Viết bình luận tại đây" required></textarea>
                      </div>
                      <div class="float-end mt-2 pt-1">
                        <button type="submit" class="btn btn-primary mb-2 btn-sm">Đăng bình luận</button>
                        <!-- <button type="button" class="btn btn-outline-primary mb-2 btn-sm">Hủy</button> -->
                      </div>
                    </div>
                  </form>
                </div>
              </div>
            </div>
          </div>
        </section>
      </section>
    </div>
  </div>
</section>

<script type='text/javascript'>
  var input = document.getElementById('quantity')

  function increase() {
    input.value++;
  }

  function decrease() {
    input.value--;
  }
</script>