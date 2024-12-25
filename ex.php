<?php
    include 'assets.php';
    require 'db.php';

    $stmt = $pdo->prepare("SELECT food.*, shop.name AS shopname, food_type.name AS foodtype FROM food JOIN shop ON food.shop_id = shop.id JOIN food_type ON food_type.shop_id = shop.id");
    $stmt->execute();
    $food = $stmt->fetchAll();


?>

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
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" data-bs-toggle="dropdown" aria-expanded="false">
                        <i class="bi bi-person-circle me-2"></i> Name Lastname
                    </a>
                    <ul class="dropdown-menu dropdown-menu-end">
                        <li><a class="dropdown-item" href="#"><i class="bi bi-person me-2"></i> Profile</a></li>
                        <li><a class="dropdown-item" href="#"><i class="bi bi-box-arrow-right me-2"></i> Logout</a></li>
                    </ul>
                </li>
            </ul>
        </div>
    </div>
</nav>

<div class="nav-scroller">
    <nav class="nav" aria-label="Secondary navigation">
        <a class="nav-link nav-content" href="#" data-content="menu"><i class="bi bi-house me-2"></i> Dashboard</a>
        <a class="nav-link nav-content" href="#" data-content="cart">
            <i class="bi bi-cart me-2"></i> Cart
            <span class="badge bg-light text-dark rounded-pill">27</span>
        </a>
    </nav>
</div>

<main class="container">
  <div class="p-5 rounded mt-5">
    <h1>ตัวอย่าง</h1>
    <p class="lead">ระบบ Delivery แข่งทักษะเขียนโปรแกรมปี พ.ศ. 2565 - 2567</p>
    <a class="btn btn-lg btn-primary" data-bs-target="#exampleModalToggle" data-bs-toggle="modal">เข้าสู่ระบบ</a>
  </div>

    <!-- ส่วน Modal -->

  <div class="modal fade" id="exampleModalToggle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content rounded-4 shadow">
            <div class="modal-header p-5 pb-4 border-bottom-0">
                <h1 class="modal-title fs-5">เข้าสู่ระบบ</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body p-5 pt-0">
                <form class="">
                    <div class="form-floating mb-3">
                        <input type="email" class="form-control rounded-3" id="floatingInput" placeholder="name@example.com">
                        <label>อีเมล</label>
                    </div>
                    <div class="form-floating mb-3">
                        <input type="password" class="form-control rounded-3" id="floatingPassword" placeholder="Password">
                        <label>รหัสผ่าน</label>
                    </div>
                    <button class="w-100 mb-2 btn btn-lg rounded-3 btn-primary" type="submit">เข้าสู่ระบบ</button>
                    <small class="text-body-secondary">By clicking Sign up, you agree to the terms of use.</small>
                </form>
            </div>
            <div class="modal-footer">
                <button class="btn btn-primary" data-bs-target="#exampleModalToggle2" data-bs-toggle="modal">สมัครสมาชิก</button>
            </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="exampleModalToggle2" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content rounded-4 shadow">
            <div class="modal-header p-5 pb-4 border-bottom-0">
                <h1 class="modal-title fs-5">ลงทะเบียนเข้าใช้ระบบ</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body p-5 pt-0">
                <form class="">
                    <div class="form-floating mb-3">
                        <input type="email" class="form-control rounded-3" placeholder="name@example.com">
                        <label>อีเมล</label>
                    </div>
                    <div class="form-floating mb-3">
                        <input type="password" class="form-control rounded-3" placeholder="Password">
                        <label>รหัสผ่าน</label>
                    </div>
                    <div class="form-floating mb-3">
                        <select name="" class="form-control rounded-3">
                            <option value="">user</option>
                        </select>
                        <label>เลือกบทบาท</label>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-floating mb-3">
                                <input type="text" class="form-control rounded-3" id="firstName" placeholder="ชื่อ">
                                <label for="firstName">ชื่อ</label>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-floating mb-3">
                                <input type="text" class="form-control rounded-3" id="lastName" placeholder="นามสกุล">
                                <label for="lastName">นามสกุล</label>
                            </div>
                        </div>
                    </div>
                    <div class="form-floating mb-3">
                        <input type="email" class="form-control rounded-3" placeholder="name@example.com">
                        <label>ที่อยู่</label>
                    </div>
                    <div class="form-floating mb-3">
                        <input type="email" class="form-control rounded-3" placeholder="name@example.com">
                        <label>เบอร์</label>
                    </div>
                    <button class="w-100 mb-2 btn btn-lg rounded-3 btn-primary" type="submit">ลงทะเบียน</button>
                    <small class="text-body-secondary">By clicking Sign up, you agree to the terms of use.</small>
                </form>
            </div>
            <div class="modal-footer">
                <button class="btn btn-primary" data-bs-target="#exampleModalToggle" data-bs-toggle="modal">เข้าสู่ระบบ</button>
            </div>
            </div>
        </div>
    </div>

    <!-- ส่วน col -->

    <div class="container">
        <div class="row row-cols-md-3 g-3">
        <div class="col">
            <div class="form-floating mb-3">
                <select id="shopSelect" class="form-control rounded-3">
                    <option value="">ทั้งหมด</option>
                    <option value="ร้านโจรสลัด">ร้านโจรสลัด</option>
                    <option value="ร้านอาหารบ้านสวน">ร้านอาหารบ้านสวน</option>
                    <option value="ร้านอาหารทะเล">ร้านอาหารทะเล</option>
                </select>
                <label>เลือกร้านอาหาร</label>
            </div>
        </div>
        <div class="col">
            <div class="form-floating mb-3">
                <select id="foodTypeSelect" class="form-control rounded-3">
                    <option value="">ทั้งหมด</option>
                    <option value="อาหารคลีน">อาหารคลีน</option>
                    <option value="อาหารญี่ปุ่น">อาหารญี่ปุ่น</option>
                    <option value="อาหารทะเล">อาหารทะเล</option>
                </select>
                <label>เลือกประเภทอาหาร</label>
            </div>
        </div>
        <div class="col">
            <div class="form-floating mb-3">
                <input class="form-control" type="text" id="searchfood" placeholder="ค้นหาอาหาร">
                <label>ค้นหา</label>
            </div>
        </div>
    </div>

    <!-- การ์ดสินค้า -->
    <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 g-3 mb-4" id="foodCards">
        <?php foreach ($food as $data): ?>
        <div class="col food-card" data-shop="<?= $data['id'] ?>" data-food-type="อาหารคลีน">
            <div class="card shadow-sm">
                <img src="test/rollsalad.png" width="100%" alt="สลัดโรล">
                <div class="card-body">
                    <h5 class="card-title mb-1"><?= $data['name'] ?></h5>
                    <p class="card-text text-body-secondary mb-1"><?= $data['foodtype'] ?> - <?= $data['shopname'] ?></p>
                    <div class="d-flex justify-content-between align-items-center">
                        <button type="button" class="btn btn-sm btn-outline-primary">เพิ่มลงตะกล้า</button>
                        <small class="text-body-secondary fw-bold">60 บาท</small>
                    </div>
                </div>
            </div>
        </div>
        <?php endforeach ?>

        <div class="col">
        <div class="card shadow-sm">
            <img src="test/rollsalad.png" width="100%" alt="สลัดโรล">
            <div class="card-body">
            <h5 class="card-title mb-1">สลัดโรล</h5>
            <p class="card-text text-body-secondary mb-1">อาหารคลีน</p>
            <div class="d-flex justify-content-between align-items-center">
                <div class="btn-group">
                <button type="button" class="btn btn-sm btn-outline-secondary">แก้ไข</button>
                <button type="button" class="btn btn-sm btn-outline-danger">ลบ</button>
                </div>
                <small class="text-body-secondary fw-bold">60 บาท</small>
            </div>
            </div>
        </div>
    </div>

    <input type="text" id="searchInput" class="form-control mb-4" placeholder="ค้นหาข้อมูล...">
        
    <table class="table table-hover table-striped table-bordered align-middle" style="border-radius: 5px; overflow: hidden;">
        <thead class="table-primary">
            <tr>
                <th class="text-center">#</th>
                <th>ชื่อ</th>
                <th>นามสกุล</th>
                <th>เบอร์</th>
                <th class="text-center">การจัดการ</th>
            </tr>
        </thead>
        <tbody id="tableBody">
            <tr>
                <th class="text-center">1</th>
                <td>Mark</td>
                <td>Otto</td>
                <td>0826419844</td>
                <td class="text-center">
                    <button class="btn btn-sm btn-outline-primary">
                        <i class="bi bi-universal-access"></i> อนุมัติ
                    </button>
                    <button class="btn btn-sm btn-outline-warning">
                        <i class="bi bi-pencil"></i> แก้ไข
                    </button>
                    <button class="btn btn-sm btn-outline-danger">
                        <i class="bi bi-trash"></i> ลบ
                    </button>
                </td>
            </tr>
            <tr>
                <th scope="row" class="text-center">2</th>
                <td>Jacob</td>
                <td>Thornton</td>
                <td>0826419844</td>
                <td class="text-center">
                    <button class="btn btn-sm btn-outline-primary">
                        <i class="bi bi-universal-access"></i> ระงับการใช้งาน
                    </button>
                    <button class="btn btn-sm btn-outline-warning">
                        <i class="bi bi-pencil"></i> แก้ไข
                    </button>
                    <form action="" method="get" style="display: inline;">
                        <button class="btn btn-sm btn-outline-danger">
                            <i class="bi bi-trash"></i> ลบ
                        </button>
                    </form>
                </td>
            </tr>
        </tbody>
    </table>
</main>