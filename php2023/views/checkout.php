<?php
$query = "SELECT * FROM member WHERE username='" . $_SESSION['member'] . "'";
$member =  mysqli_fetch_array($conn->query($query));
?>
<?php
if (isset($_POST['name'])) {
  $name = $_POST['name'];
  $mobile = $_POST['mobile'];
  $address = $_POST['address'];
  $email = $_POST['email'];
  $note = $_POST['note'];
  $ordermethodid = $_POST['ordermethodid'];
  $memberid = $member['id'];
  $query = "INSERT INTO `orders`(`ordermethodid`, `memberid`, `name`, `address`, `mobile`, `email`, `note`) 
            VALUES($ordermethodid, $memberid, '$name', '$address', '$mobile', '$email', '$note')";
  $result = $conn->query($query);

  $query = "SELECT * FROM `orders` ORDER BY id DESC LIMIT 1";
  $orderid = mysqli_fetch_array($conn->query($query))['id'];

  foreach ($_SESSION['cart'] as $key => $value) :
    $productid = $key;
    $number = $value;

    $query = "SELECT price FROM product WHERE id=" . $key;
    $price = mysqli_fetch_array($conn->query($query))['price'];
    $query = "INSERT orderdetail VALUES($orderid, $productid, $number, $price)";
    $conn->query($query);
    $query = "UPDATE product SET ordered = (ordered + 1) WHERE id = ". $key;
    $conn->query($query);
  endforeach;

  unset($_SESSION['cart']);
  header("location: ?option=ordersuccess");
}
?>


<section class="bg-light py-5">
  <div class="container">
    <div class="row">
      <div class="col-xl-8 col-lg-8 mb-4">
        <?php if (!isset($_SESSION['member'])) : ?>
          <div class="card mb-4 border shadow-0">
            <div class="p-4 d-flex justify-content-between">
              <div class="">
                <h5>Have an account?</h5>
                <p class="mb-0 text-wrap ">Lorem ipsum dolor sit amet, consectetur adipisicing elit</p>
              </div>
              <div class="d-flex align-items-center justify-content-center flex-column flex-md-row">
                <a href="#" class="btn btn-outline-primary me-0 me-md-2 mb-2 mb-md-0 w-100">Register</a>
                <a href="#" class="btn btn-primary shadow-0 text-nowrap w-100">Sign in</a>
              </div>
            </div>
          </div>
        <?php endif; ?>
        <!-- Checkout -->
        <div class="card shadow-0 border">
          <div class="p-4">
            <form method="post">
              <h5 class="card-title mb-3">Thông tin người nhận hàng</h5>
              <div class="row">
                <div class="col-6 mb-3">
                  <p class="mb-0">Họ tên</p>
                  <div>
                    <input type="text" name="name" placeholder="Type here" value="<?= $member['fullname'] ?>" class="form-control" />
                  </div>
                </div>

                <div class="col-6 mb-3">
                  <p class="mb-0">Số điện thoại</p>
                  <div>
                    <input type="tel" name="mobile" value="<?= $member['mobile'] ?>" class="form-control bordered" />
                  </div>
                </div>

                <div class="col-6 mb-3">
                  <p class="mb-0">Email</p>
                  <div>
                    <input type="email" name="email" placeholder="example@gmail.com" value="<?= $member['email'] ?>" class="form-control" />
                  </div>
                </div>
                <div class="col-6 mb-3">
                  <p class="mb-0">Địa chỉ</p>
                  <div>
                    <input type="text" name="address" value="<?= $member['address'] ?>" class="form-control" />
                  </div>
                </div>
              </div>

              <hr class="my-4" />

              <h5 class="card-title mb-3">Phương thức thanh toán</h5>

              <div class="row mb-3">
                <?php
                $query = "SELECT * FROM ordermethod WHERE status";
                $result = $conn->query($query);
                ?>
                <?php foreach ($result as $item) : ?>
                  <div class="col-lg-4 mb-3">
                    <!-- Default checked radio -->
                    <div class="form-check h-100 border rounded-3">
                      <div class="p-3">
                        <input class="form-check-input" type="radio" name="ordermethodid" value="<?= $item['id'] ?>" <?= $item['id'] == 1 ? 'checked' : '' ?> />
                        <label class="form-check-label">
                          <?= $item['name'] ?> <br />
                        </label>
                      </div>
                    </div>
                  </div>
                <?php endforeach; ?>
              </div>
              <div class="mb-3">
                <p class="mb-0">Ghỉ chú</p>
                <div>
                  <textarea class="form-control" name="note" rows="3"></textarea>
                </div>
              </div>

              <div class="float-end">
                <a href="?option=home" class="btn btn-light border">Hủy</a>
                <button type="submit" class="btn btn-success shadow-0 border">Xác nhận</button>
              </div>
            </form>
          </div>
        </div>
        <!-- Checkout -->
      </div>
      <div class="col-xl-4 col-lg-4 d-flex justify-content-center justify-content-lg-end">
        <div class="ms-lg-4 mt-4 mt-lg-0" style="max-width: 320px;">
          <h6 class="mb-3">Tổng kết</h6>
          <div class="d-flex justify-content-between">
            <p class="mb-2">Giá thành:</p>
            <p class="mb-2"><?=number_format($_SESSION['total_price'], 0, '.', ',')?></p>
          </div>
          <div class="d-flex justify-content-between">
            <p class="mb-2">Giảm giá:</p>
            <p class="mb-2 text-danger">- <?=number_format(150000, 0, '.', ',')?></p>
          </div>
          <div class="d-flex justify-content-between">
            <p class="mb-2">Phí vận chuyển:</p>
            <p class="mb-2">+ <?=number_format(50000, 0, '.', ',')?></p>
          </div>
          <hr />
          <div class="d-flex justify-content-between">
            <p class="mb-2">Tổng tiền:</p>
            <p class="mb-2 fw-bold"><?=number_format($_SESSION['total_price'] - 100000, 0, '.', ',')?></p>
          </div>

          <hr />
          <h6 class="text-dark my-4">Sản phẩm trong giỏ hàng</h6>
          <?php 
            $ids = implode(',', array_keys($_SESSION['cart']));
            $query = "SELECT * FROM product WHERE id in($ids)";
            $result = $conn->query($query);
            foreach ($result as $item) :
          ?>
          <div class="d-flex align-items-center mb-4">
            <div class="me-3 position-relative">
              <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill badge-secondary">
                <?= $_SESSION['cart'][$item['id']] ?>
              </span>
              <img src="images/<?=$item['image']?>" style="height: 96px; width: 96x;" class="img-sm rounded border" />
            </div>
            <div class="">
              <a href="option=productdetail&id=<?= $item['id'] ?>" class="nav-link">
                <?= $item['name'] ?>
              </a>
              <div class="price text-muted"><?= number_format($item['price'] * $_SESSION['cart'][$item['id']], 0, '.', ',') ?> VNĐ</div>
            </div>
          </div>
        <?php endforeach; ?>
        </div>
      </div>
    </div>
  </div>
</section>