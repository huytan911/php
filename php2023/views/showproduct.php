<?php
$option = 'home';
$query = "SELECT * FROM product WHERE status=1";
if (isset($_GET['brandid'])) {
  $query .= " and brandid=" . $_GET['brandid'];
  $option = 'showproduct&brandid=' . $_GET['brandid'];
} elseif (isset($_GET['keyword'])) {
  $query .= " AND name like '%" . $_GET['keyword'] . "%'";
  $option = 'showproduct&keyword=' . $_GET['keyword'];
} elseif (isset($_GET['range'])) {
  $query .= " and price between " . $_GET['range'];
  $option = 'showproduct&range=' . $_GET['range'];
}

$page = 1;
if (isset($_GET['page'])) {
  $page = $_GET['page'];
}

$productperpage = 2;
$from = ($page - 1) * $productperpage;

$totalProducts = $conn->query($query);
$totalPage = ceil(mysqli_num_rows($totalProducts) / $productperpage);

$query .= " limit $from, $productperpage";
$result = $conn->query($query);
?>

<div class="col-lg-9">
  <header class="d-sm-flex align-items-center border-bottom mb-4 pb-3">
    <strong class="d-block py-2"><?= mysqli_num_rows($totalProducts) ?> Sản phẩm</strong>
    <!-- <div class="ms-auto">
      <select class="form-select d-inline-block w-auto border pt-1">
        <option value="0">Best match</option>
        <option value="1">Recommended</option>
        <option value="2">High rated</option>
        <option value="3">Randomly</option>
      </select>
      <div class="btn-group shadow-0 border">
        <a href="#" class="btn btn-light" title="List view">
          <i class="fa fa-bars fa-lg"></i>
        </a>
        <a href="#" class="btn btn-light active" title="Grid view">
          <i class="fa fa-th fa-lg"></i>
        </a>
      </div>
    </div> -->
  </header>

  <?php foreach ($result as $item) : ?>
    <div class="row justify-content-center mb-3">
      <div class="col-md-12">
        <div class="card shadow-0 border rounded-3">
          <div class="card-body">
            <div class="row g-0">
              <div class="col-xl-3 col-md-4 d-flex justify-content-center">
                <div class="bg-image hover-zoom ripple rounded ripple-surface me-md-3 mb-3 mb-md-0">
                  <img src="images/<?= $item['image'] ?>" class="w-100" />
                  <a href="?option=productdetail&id=<?= $item['id'] ?>">
                    <div class="hover-overlay">
                      <div class="mask" style="background-color: rgba(253, 253, 253, 0.15);"></div>
                    </div>
                  </a>
                </div>
              </div>
              <div class="col-xl-6 col-md-5 col-sm-7">
                <h5><?= $item['name'] ?></h5>
                <div class="d-flex flex-row">
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
                  <span class="text-muted"><?=$item['ordered']?> đơn</span>
                </div>
                <p class="text mb-4 mb-md-0">
                  <?= $item['description'] ?>
                </p>
              </div>
              <div class="col-xl-3 col-md-3 col-sm-5">
                <div class="d-flex flex-row align-items-center mb-1">
                  <h4 class="mb-1 me-1"><?= number_format($item['price'], 0, '.', ',') ?> VNĐ</h4>
                </div>
                <div class="mt-4">
                  <button class="btn btn-primary shadow-0" type="button" onclick="location='?option=cart&action=add&id=<?= $item['id'] ?>'">Đặt mua</button>
                  <?php if(isset($_SESSION['memberid'])):?>
                    <a href="?option=wishlist&action=add&productid=<?=$item['id']?>&memberid=<?=$_SESSION['memberid']?>" class="btn btn-light border px-2 pt-2 icon-hover"><i class="fas fa-heart fa-lg px-1"></i></a>
                  <?php else: ?>
                    <a href="?option=wishlist&action=add&productid=<?=$item['id']?>" class="btn btn-light border px-2 pt-2 icon-hover"><i class="fas fa-heart fa-lg px-1"></i></a>
                  <?php endif; ?>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  <?php endforeach; ?>

  <hr />
  
  <nav aria-label="Page navigation example" class="d-flex justify-content-center mt-3">
    <ul class="pagination">
      <li class="page-item <?= isset($_GET['page']) && $_GET['page'] == 1 || empty($_GET['page']) ? 'disabled' : '' ?>">
        <a class="page-link" href="?option=<?= $option ?>&page=<?= isset($_GET['page']) ? ($_GET['page'] - 1) : '' ?>" aria-label="Previous">
          <span aria-hidden="true">&laquo;</span>
        </a>
      </li>
      <?php for ($i = 1; $i <= $totalPage; $i++) : ?>
        <li class="page-item <?= empty($_GET['page']) && $i == 1 || (isset($_GET['page'])) && ($_GET['page'] == $i) ? 'active' : '' ?>"><a class="page-link" href="?option=<?= $option ?>&page=<?= $i ?>"><?= $i ?></a></li>
      <?php endfor; ?>
      <li class="page-item <?= isset($_GET['page']) && $_GET['page'] == $totalPage ? 'disabled' : '' ?>">
        <a class="page-link" href="?option=<?= $option ?>&page=<?= isset($_GET['page']) ? ($_GET['page'] + 1) : '2' ?>" aria-label="Next">
          <span aria-hidden="true">&raquo;</span>
        </a>
      </li>
    </ul>
  </nav>
</div>