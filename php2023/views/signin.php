<?php
if (isset($_POST['username'])) {
  $username = $_POST['username'];
  $password = md5($_POST['password']);
  $query = "SELECT * FROM member WHERE username='$username' AND password='$password'";
  $result = $conn->query($query);
  if (mysqli_num_rows($result) == 0) {
    $alert = "Sai tên tài khoản hoặc mật khẩu";
  } else {
    $result = mysqli_fetch_array($result);
    if ($result['status'] == 0) {
      $alert = "Tài khoản của bạn đã bị khóa";
    } elseif (isset($_GET['productid'])) {
      $_SESSION['member'] = $username;
      $_SESSION['memberid'] = $result['id'];
      $memberid = $result['id'];
      $productid = $_GET['productid'];
      $content = $_SESSION['content'];
      $conn->query("INSERT comment(memberid, productid, date, content) VALUES($memberid, $productid, now(), '$content')");
      echo "<script>alert('Bình luận của bạn đã được gửi!');
            location='?option=productdetail&id=$productid'</script>";
    } else {
      $_SESSION['member'] = $username;
      $_SESSION['memberid'] = $result['id'];
      if (isset($_GET['order'])) {
        header("location: ?option=order");
      } else {
        header("location: ?option=home");
      }
    }
  }
}
?>

<div class="vh-100 d-flex justify-content-center align-items-center">
  <div class="container">
    <div class="row d-flex justify-content-center">
      <div class="col-12 col-md-8 col-lg-6">
        <div class="card bg-white">
          <div class="card-body p-5">
            <form class="mb-3 mt-md-4" method="post">
              <h2 class="fw-bold mb-2 text-uppercase ">Đăng nhập</h2>
              <p class=" mb-5">Điền tài khoản và mật khẩu</p>
              <p class="text-danger fs-4 fw-bold"><?=isset($alert) ? $alert : ''?></p>
              <div class="mb-3">
                <label for="email" class="form-label ">Tài khoản</label>
                <input type="text" class="form-control" name="username" placeholder="Nhập tài khoản">
              </div>
              <div class="mb-3">
                <label for="password" class="form-label ">Mật khẩu</label>
                <input type="password" class="form-control" name="password" placeholder="Nhập mật khẩu">
              </div>
              <p class="small"><a class="text-primary" href="">Quên mật khẩu?</a></p>
              <div class="d-grid">
                <button class="btn btn-outline-dark" type="submit">Đăng nhập</button>
              </div>
            </form>
            <div>
              <p class="mb-0  text-center">Chưa có tài khoản? <a href="?option=signup" class="text-primary fw-bold">Đăng ký</a></p>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>