<?php
if (empty($_SESSION['cart'])) {
  $_SESSION['cart'] = array();
}
if (isset($_GET['action'])) {
  $id = isset($_GET['id']) ? $_GET['id'] : "";
  switch ($_GET['action']) {
    case 'add':
      if (array_key_exists($id, array_keys($_SESSION['cart']))) {
        $_SESSION['cart'][$id]++;
      } else {
        if (isset($_POST['quantity'])) {
          $_SESSION['cart'][$id] = $_POST['quantity'];
        } else {
          $_SESSION['cart'][$id] =  1;
        }
      }
      header("location: ?option=cart");
      break;

    case 'delete':
      unset($_SESSION['cart'][$id]);
      break;
    case 'deleteAll':
      unset($_SESSION['cart']);
      header("location: ?option=cart");
      break;
    case 'update':
      if ($_GET['type'] == 'asc') :
        $_SESSION['cart'][$id]++;
      elseif ($_GET['type'] == 'dec') :
        if ($_SESSION['cart'][$id] > 1) :
          $_SESSION['cart'][$id]--;
        endif;
      endif;
      header("location: ?option=cart");
      break;
    case 'order':
      if (isset($_SESSION['member'])) {
        header("location: ?option=order");
      } else {
        header("location: ?option=signin&order=1");
      }
      break;
  }
}
?>
<section class="bg-light my-5">
  <div class="container">
    <div class="row">
      <div class="col-lg-9">
        <div class="card border shadow-0">
          <div class="m-4">
            <h4 class="card-title mb-4">Giỏ hàng của bạn</h4>
            <?php
            if (!empty($_SESSION['cart'])) :
              $ids = implode(',', array_keys($_SESSION['cart']));
              $query = "SELECT * FROM product WHERE id in($ids)";
              $result = $conn->query($query);
              $total = 0;
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
                    <div>
                      <input type="button" value="-" class="btn btn-white border border-secondary px-3" onclick="location='?option=cart&action=update&type=dec&id=<?= $item['id'] ?>';">
                      <label class="mb-1"><?= $_SESSION['cart'][$item['id']] ?></label>
                      <input type="button" value="+" class="btn btn-white border border-secondary px-3" onclick="location='?option=cart&action=update&type=asc&id=<?= $item['id'] ?>';">
                    </div>
                    <div class="mx-4">
                      <text class="h6"><?= number_format($item['price'] * $_SESSION['cart'][$item['id']], 0, '.', ',') ?> VNĐ</text>
                      <?php $total += ($item['price'] * $_SESSION['cart'][$item['id']]); ?>
                      <br />
                      <small class="text-muted text-nowrap"> <?= number_format($item['price'], 0, '.', ',') ?> VNĐ/1 sản phẩm </small>
                    </div>
                  </div>
                  <div class="col-lg col-sm-6 d-flex justify-content-sm-center justify-content-md-start justify-content-lg-center justify-content-xl-end mb-2">
                    <div class="float-md-end">
                      <a href="?option=cart&action=delete&id=<?= $item['id'] ?>" class="btn btn-light border text-danger icon-hover-danger"> Xóa</a>
                    </div>
                  </div>
                </div>
              <?php
                $_SESSION['total_price'] = $total;
              endforeach;
              ?>
            <?php
            else :
              unset($_SESSION['total_price'])
            ?>
              <section>
                Giỏ hàng trống !!
              </section>
            <?php endif; ?>
          </div>
          <div class="border-top pt-4 mx-4 mb-4">
            <p><i class="fas fa-truck text-muted fa-lg"></i> Miễn phí vận chuyển trong 1-2 tuần</p>
          </div>
        </div>
      </div>
      <div class="col-lg-3">
        <div class="card shadow-0 border">
          <div class="card-body">
            <div class="d-flex justify-content-between">
              <p class="mb-2">Tổng giá thành:</p>
              <p class="mb-2"><?= isset($total) ? number_format($total, 0, '.', ',') : '0' ?></p>
            </div>
            <div class="d-flex justify-content-between">
              <p class="mb-2">Giảm giá:</p>
              <p class="mb-2 text-danger">- <?= number_format(150000, 0, '.', ',') ?></p>
            </div>
            <div class="d-flex justify-content-between">
              <p class="mb-2">Phí vận chuyển:</p>
              <p class="mb-2 text-success">+ <?= number_format(50000, 0, '.', ',') ?></p>
            </div>
            <hr />
            <div class="d-flex justify-content-between">
              <p class="mb-2">Tổng giá thành:</p>
              <p class="mb-2 fw-bold"><?= isset($total) ? number_format($total - 100000, 0, '.', ',') : '0' ?></p>
            </div>

            <div class="mt-3">
              <a href="?option=checkout" class="btn btn-success w-100 shadow-0 mb-2"
                <?= empty($_SESSION['cart']) ? 'style="pointer-events: none; cursor: default;"' : '' ?>> Đặt hàng </a>
              <a href="?option=home" class="btn btn-light w-100 border mt-2"> Trở lại </a>
            </div>
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
              <img src="images/<?= $item['image'] ?>" class="card-img-top rounded-2" />
            </a>
            <div class="card-body d-flex flex-column pt-3 border-top">
              <a href="?option=productdetail&id=<?= $item['id'] ?>" class="nav-link"><?= $item['name'] ?></a>
              <div class="price-wrap mb-2">
                <strong class=""><?= number_format($item['price'], 0, '.', ',') ?> VNĐ</strong>
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