<nav class="navbar navbar-expand-lg fixed-top navbar-dark bg-dark">
    <div class="container">
        <a class="navbar-brand" href="#">
            <img src="test/logo.svg" alt="Logo">
            Dekit Delivery
        </a>
        <button class="navbar-toggler p-0 border-0" type="button" id="navbarSideCollapse">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="navbar-collapse offcanvas-collapse">
            <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                <?php if (!$_SESSION['user_login']) { ?>
                <li class="nav-item">
                    <a class="btn btn-primary w-100" href="" data-bs-target="#exampleModalToggle" data-bs-toggle="modal">เข้าสู่ระบบ</a>
                </li>
                <?php } else { 
                require 'db.php';
                $stmt = $pdo->prepare('SELECT * FROM users WHERE id = ?');
                $stmt->execute([$_SESSION['user_login']]);
                $data = $stmt->fetch();
                ?>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" data-bs-toggle="dropdown">
                        <i class="bi bi-person-circle me-2"></i> <?= $data['fname']. " " . $data['lname'] ?>
                    </a>
                    <ul class="dropdown-menu dropdown-menu-end">
                        <li><a class="dropdown-item nav-content" href="" data-content="profile"><i class="bi bi-person me-2"></i> Profile</a></li>
                        <li><a class="dropdown-item" href="logout.php"><i class="bi bi-box-arrow-right me-2"></i> Logout</a></li>
                    </ul>
                </li>
                <?php } ?>
            </ul>
        </div>
    </div>
</nav>

<?php if (isset($_SESSION['user_login'])) { ?>
<div class="nav-scroller">
    <nav class="nav" aria-label="Secondary navigation">
        <?php if ($_SESSION['role'] === "admin") { ?>
        <a class="nav-link nav-content" href="#" data-content="user"><i class="bi bi-people-fill me-2"></i> จัดการผู้ใช้</a>
        <a class="nav-link nav-content" href="#" data-content="manager"><i class="bi bi-people-fill me-2"></i> จัดการผู้จัดการร้านอาหาร</a>
        <a class="nav-link nav-content" href="#" data-content="delivery"><i class="bi bi-people-fill me-2"></i> จัดการผู้ส่งอาหาร</a>
        <a class="nav-link nav-content" href="#" data-content="food_type"><i class="bi bi-basket me-2"></i> จัดการประเภทร้านอาหาร</a>
        <a class="nav-link nav-content" href="#" data-content="shop">
            <i class="bi bi-cart me-2"></i> จัดการร้านอาหาร
            <span class="badge bg-light text-dark rounded-pill">1</span>
        </a>
        <?php } else { ?>
        <a class="nav-link nav-content" href="#" data-content="menu"><i class="bi bi-house me-2"></i> Menu</a>
        <a class="nav-link nav-content" href="#" data-content="cart">
            <i class="bi bi-cart me-2"></i> Cart
            <span class="badge bg-light text-dark rounded-pill">27</span>
        </a>
        <?php } ?>
    </nav>
</div>
<?php } ?>