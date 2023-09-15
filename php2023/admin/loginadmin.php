<section>
    <h1 class="mt-5">ĐĂNG NHẬP TRANG QUẢN TRỊ</h1>
</section>
<div class="vh-100 d-flex justify-content-center align-items-center">
  <div class="container">
    <div class="row d-flex justify-content-center">
      <div class="col-12 col-md-8 col-lg-6">
        <div class="card bg-white">
          <div class="card-body p-5">
            <form class="mb-3 mt-md-4" method="post">
              <h2 class="fw-bold mb-2 text-uppercase ">Đăng nhập</h2>
              <p class="text-danger fs-4"><?=isset($alert) ? $alert : ''?></p>
              <div class="mb-3">
                <label for="email" class="form-label ">Tài khoản</label>
                <input type="text" class="form-control" name="username" placeholder="Nhập tài khoản">
              </div>
              <div class="mb-3">
                <label for="password" class="form-label ">Mật khẩu</label>
                <input type="password" class="form-control" name="password" placeholder="Nhập mật khẩu">
              </div>
              <div class="d-grid">
                <button class="btn btn-outline-dark" type="submit">Đăng nhập</button>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>