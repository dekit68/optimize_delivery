<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container">
        <a class="navbar-brand" href="/">ร้านอาหาร</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
            aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto">
                <?php 
                if (isset($_SESSION['user_login'])) { 
                $user = gud($_SESSION['user_login'], $pdo)
                ?>
                <?php 
                    if ($_SESSION["role"] === 'user') {
                ?>   
                <li class="nav-item position-relative">
                    <a class="nav-link nav-content" href="/" data-content="cart">
                        ตะกล้า
                        <?php if ($cartCount > 0): ?>
                            <span class="position-absolute bottom-20 start-100 translate-middle badge rounded-pill bg-danger">
                                <?= $cartCount ?>
                                <span class="visually-hidden">items in cart</span>
                            </span>
                        <?php endif; ?>
                    </a>
                </li>
                <?php 
                    }
                ?>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown"
                        aria-expanded="false">
                        <?= $user['firstname']. " " . $user['lastname'] ?>
                    </a>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="profile.php">Profile</a></li>
                        <li>
                            <hr class="dropdown-divider">
                        </li>
                        <li><a class="dropdown-item" href="logout.php">ออกจากระบบ</a></li>
                    </ul>
                </li>
                <?php } ?>
            </ul>
        </div>
    </div>
</nav>