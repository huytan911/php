<div class="p-3 text-center bg-white border-bottom mb-5">
    <div class="container">
      <div class="row gy-3">
        
        <div class="col-lg-2 col-sm-4 col-4">
          <a href="?option=home" class="float-start fs-3 fw-bold text ">
            Logo
          </a>
        </div>
        <div class="order-lg-last col-lg-5 col-sm-8 col-8">
          <div class="d-flex float-end">
            <a href="?option=wishlist" class="me-1 border rounded py-1 px-3 nav-link d-flex align-items-center"> <i class="fas fa-heart m-1 me-md-2"></i><p class="d-none d-md-block mb-0">Yêu thích</p> </a>
            <a href="?option=cart" class="me-1 border rounded py-1 px-3 nav-link d-flex align-items-center"> <i class="fas fa-shopping-cart m-1 me-md-2"></i><p class="d-none d-md-block mb-0">Giỏ hàng</p> </a>
            <?php if(empty($_SESSION['member'])): ?>
              <a href="?option=signin" class="me-1 border rounded py-1 px-3 nav-link d-flex align-items-center"> <i class="fas fa-user-alt m-1 me-md-2"></i><p class="d-none d-md-block mb-0">Đăng nhập</p> </a>
            <?php else:?>
              <span class="me-1 border rounded py-1 px-3 nav-link d-flex align-items-center">Xin chào: <?=$_SESSION['member']?> [<a href="?option=logout">Đăng xuất</a>]</span> 
            <?php endif;?>
          </div>
        </div>
        <form autocomplete class="col-lg-5 col-md-12 col-12">
          <div class="input-group float-center">
            <div class="form-outline">
              <input type="hidden" name="option" value="showproduct">  
              <input autocomplete="on" type="search" class="form-control border border-info" name="keyword" value="<?=$_GET['keyword']??"" ?>"/>
            </div>
            <button type="submit" class="btn btn-primary shadow-0">
              <i class="fas fa-search"></i>
            </button>
          </div>
        </form>
      </div>
    </div>
  </div>
  
  <!-- <div class="bg-primary text-white py-5">
    <div class="container py-5">
      <h1>
        Best products & <br />
        brands in our store
      </h1>
      <p>
        Trendy Products, Factory Prices, Excellent Service
      </p>
      <button type="button" class="btn btn-outline-light">
        Learn more
      </button>
      <a type="button" class="btn btn-light shadow-0 text-primary pt-2 border border-white">
        <span class="pt-1">Purchase now</span>
      </a>
    </div>
  </div> -->
