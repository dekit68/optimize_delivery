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
                <li class="nav-item">
                    <a class="nav-link" href="/">เมนูอาหาร</a>
                </li>
                <?php 
                    if ($_SESSION["role"] === 'user') {
                ?>   
                <li class="nav-item">
                    <a class="nav-link" href="/">ตะกล้า</a>
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
                        <li><a class="dropdown-item" href="history.php">ประวัติการสั่งอาหาร</a></li>
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