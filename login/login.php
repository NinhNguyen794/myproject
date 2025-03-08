<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>asdasdasd</title>
  <link rel="stylesheet" href="login.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css">
</head>
<body>
  <h1>nhóc nhỏ mum phạm</h1>
    <div class="container" id="container">
    <div class="form-container sign-up">
    <form method="POST" action="register.php">
        <h1>Create Account</h1>
        <div class="social-icons">
            <a href="#" class="icon"><i class="fa-brands fa-google-plus-g"></i></a>
            <a href="#" class="icon"><i class="fa-brands fa-facebook-f"></i></a>
            <a href="#" class="icon"><i class="fa-brands fa-github"></i></a>
            <a href="#" class="icon"><i class="fa-brands fa-linkedin-in"></i></a>
        </div>
        <span>or use your email for registration</span>
        <input type="text" name="taikhoan" placeholder="Name" required>
        <input type="email" name="email" placeholder="Email" required>
        <input type="password" name="matkhau" placeholder="Password" required>
        <button type="submit">Sign Up</button>
    </form>
</div>


        <div class="form-container sign-in">
          <form method="POST">
              <h1>Sign In</h1>
              <div class="social-icons">
                <a href="#" class="icon"><i class="fa-brands fa-google-plus-g"></i></a>
                <a href="#" class="icon"><i class="fa-brands fa-facebook-f"></i></a>
                <a href="#" class="icon"><i class="fa-brands fa-github"></i></a>
                <a href="#" class="icon"><i class="fa-brands fa-linkedin-in"></i></a>
              </div>
              <span>or use your email,password</span>
              <input name="taikhoan" placeholder="Email">
              <input name="matkhau" placeholder="Password">
              <a href="#" class="g1">Forget Your Password?</a>
              <button>Sign In</button>
          </form>
      </div>

      <div class="toggle-container">
        <div class="toggle">
          <div class="toggle-panel toggle-left">
            <h1>VFX</h1>
            <p>Enter your personal details to use all of site features</p>
            <button class="hidden" id="login">Sign In</button>
          </div>

          <div class="toggle-panel toggle-right">
            <h1>VFX</h1>
            <p>Register with your personal details to use all of site features</p>
            <button class="hidden" id="register">Sign Up</button>
          </div>
        </div>
      </div>
    </div>
  <script src="login.js"></script>
</body>
</html>

<?php
// Kết nối MySQL
$conn = new mysqli("localhost", "root", "", "vfx.com.vn");

// Kiểm tra kết nối
if ($conn->connect_error) {
    die("Kết nối thất bại: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Nhận dữ liệu từ form
    $tk = $_POST['taikhoan'];
    $mk = $_POST['matkhau'];

    // Truy vấn kiểm tra tài khoản
    $sql = "SELECT * FROM account WHERE user = ? AND password = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ss", $tk, $mk);
    $stmt->execute();
    $result = $stmt->get_result();

    // Kiểm tra kết quả
    if ($result->num_rows > 0) {
        // Đăng nhập thành công → chuyển hướng đến trang dashboard
        header("Location: vfx.php");
        exit();
    } else {
        // Hiển thị thông báo lỗi bằng JavaScript
        echo "<script>
                alert('Sai tài khoản hoặc mật khẩu!');
                window.location.href = ''; // Quay lại trang login
              </script>";
        exit();
    }
}

// Đóng kết nối
$conn->close();
?>


