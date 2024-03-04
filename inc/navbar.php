

 
 <!--- navbar --->
 <nav class="navbar navbar-expand-lg fixed-top navbar-dark">
    <div class="container">

      <a class="navbar-brand " href="index.php">- EasyEat -</a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>

      <div class="collapse navbar-collapse" id="navbarNavDropdown">
        <ul class="navbar-nav ms-auto mt-3">

          <li class="nav-item me-2">
            <a class="nav-link active text-white" aria-current="page" href="#home">หน้าแรก</a>
          </li>

          <li class="nav-item me-2">
            <a class="nav-link active text-white" aria-current="page" href="#about">เกี่ยวกับ</a>
          </li>
          <li class="nav-item me-3">
            <a class="nav-link active text-white  mb-1" aria-current="page" href="#menu">เมนูยอดนิยม</a>
          </li>

          <li class="nav-item me-3">
            <a href="booking.php" class="btn  btnt1 mb-3" type="button">จองโต๊ะ</a>
          </li>

          <!--- เช็คว่า login ยัง -->
          <?php if (isset($_SESSION['is_login'])):?>

            <li class="nav-item me-3">
              <a href="profile.php" class="btn btn-outline-light btnt2" type="button">โปรไฟล์สมาชิก</a>
            </li>

            <li class="nav-item">
              <a href="backEnd/logout.php">
              <i class="fs-5 bi bi-box-arrow-in-right"></i><span class="ms-1 d-none d-sm-inline">ออกจากระบบ</span>
              </a>
            </li>

          <?php else : ?>

            <li class="nav-item">
              <a href="login.php" class="btn btn-outline-light btnt2" type="button">เข้าสู่ระบบ</a>
            </li>


          <?php endif; ?>

        </ul>
      </div>
    </div>
</nav>