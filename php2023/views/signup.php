<?php 
    if(isset($_POST['username'])){
        $username = $_POST['username'];
        $query = "SELECT * FROM member WHERE username='$username'";
        $result = $conn->query($query);
        if(mysqli_num_rows($result) != 0){
            $alert = "Tên tài khoản đã tồn tại";
        }else {
          if($_POST['password'] != $_POST['confirm_password']){
            $alert = "Xác nhận lại mật khẩu";
          }
          else {
            $password = md5($_POST['password']);
            $fullname = $_POST['fullname'];
            $mobile = $_POST['mobile'];
            $address = $_POST['address'];
            $email = $_POST['email'];
            $query = "INSERT member(username, password, fullname, mobile, address, email)
            VALUES('$username', '$password', '$fullname', '$mobile', '$address', '$email')";
            $conn->query($query);
            $_SESSION['member'] = $username;
            $query = "SELECT * FROM member WHERE username='$username'";
            $_SESSION['memberid'] = mysqli_fetch_array($conn->query($query))['id'];
            echo "<script>alert('Đăng ký thành công!');location='?option=home'</script>";
          }
        }
    }
?>

<div class="vh-150 d-flex justify-content-center align-items-center">
  <div class="container">
    <div class="row d-flex justify-content-center">
      <div class="col-12 col-md-8 col-lg-6">
        <div class="card bg-white">
          <div class="card-body p-5">
            <form class="mb-3 mt-md-4" method="post">
              <h2 class="fw-bold mb-2 text-uppercase ">Đăng ký</h2>
              <section class="fw-bold fs-2 text-danger"><?=isset($alert) ? $alert: ""?></section>
              <p class=" mb-5">Điền đầy đủ thông tin của bạn</p>
              <div class="mb-3">
                <label class="form-label ">Tài khoản: </label>
                <input type="text" class="form-control" name="username" placeholder="Nhập tài khoản" required>
              </div>
              <div class="mb-3">
                <label class="form-label ">Mật khẩu: </label>
                <input  type="password" class="form-control" name="password" id="password" placeholder="Nhập mật khẩu" required>
              </div>
              <div class="mb-3">
                <label class="form-label ">Xác nhận lại mật khẩu: </label>
                <input  type="password" class="form-control" name="confirm_password" id="confirm_password" placeholder="Nhập lại mật khẩu" required>
              </div>
              <span id="message"></span>
              <div class="mb-3">
                <label class="form-label ">Họ tên: </label>
                <input type="text" class="form-control" name="fullname" placeholder="Nhập họ tên" required>
              </div>
              <div class="mb-3">
                <label class="form-label ">Địa chỉ: </label>
                <textarea type="text" class="form-control" name="address" rows="4" placeholder="Nhập địa chỉ" required></textarea>
              </div>
              <div class="mb-3">
                <label class="form-label ">Số điện thoại: </label>
                <input type="tel" class="form-control" name="mobile" placeholder="Nhập số điện thoại" required>
              </div>
              <div class="mb-3">
                <label class="form-label ">Email (không bắt buộc): </label>
                <input type="email" class="form-control" name="email" placeholder="Nhập email">
              </div>
              <div class="d-grid">
                <button class="btn btn-outline-dark" type="submit">Đăng ký</button>
              </div>
              <div>
              <p class="mt-2  text-center"><a href="?option=home" class="text-primary fw-bold">Trở lại cửa hàng</a></p>
            </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<script>
$('#password, #confirm_password').on('keyup', function () {
  if ($('#password').val() != $('#confirm_password').val()) {
    $('#message').html('Mật khẩu không trùng khớp').css('color', 'red');
  }
  else {
    $('#message').remove();
  }
});
</script>