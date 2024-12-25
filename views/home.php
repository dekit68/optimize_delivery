<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dekit Delivery</title>
</head>
<body>
    <?php 
    include 'navbar.php' ;
    ?>

    <div class="container">
        <?php include 'status.php'; ?>
    </div>


    <div class="modal fade" id="exampleModalToggle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content rounded-4 shadow">
            <div class="modal-header p-5 pb-4 border-bottom-0">
                <h1 class="modal-title fs-5">เข้าสู่ระบบ</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body p-5 pt-0">
                <form action="action/auth.php?type=login" method="post">
                    <div class="form-floating mb-3">
                        <input type="email" class="form-control rounded-3" name="email" placeholder="name@example.com">
                        <label>อีเมล</label>
                    </div>
                    <div class="form-floating mb-3">
                        <input type="password" class="form-control rounded-3" name="password" placeholder="Password">
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
                <form action="action/auth.php?type=register" method="post">
                    <div class="form-floating mb-3">
                        <input type="email" class="form-control rounded-3" name="email" placeholder="name@example.com" required>
                        <label>อีเมล</label>
                    </div>
                    <div class="form-floating mb-3">
                        <input type="password" class="form-control rounded-3" name="password" placeholder="Password" required>
                        <label>รหัสผ่าน</label>
                    </div>
                    <div class="form-floating mb-3">
                        <select name="role" class="form-control rounded-3">
                            <option value="user">User</option>
                            <option value="admin">Admin</option>
                            <option value="manager">Manager</option>
                            <option value="delivery">Delivery</option>
                        </select>
                        <label>เลือกบทบาท</label>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-floating mb-3">
                                <input type="text" class="form-control rounded-3" name="fname" placeholder="ชื่อ" required>
                                <label>ชื่อ</label>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-floating mb-3">
                                <input type="text" class="form-control rounded-3" name="lname" placeholder="นามสกุล" required>
                                <label>นามสกุล</label>
                            </div>
                        </div>
                    </div>
                    <div class="form-floating mb-3">
                        <input type="text" class="form-control rounded-3" name="address" placeholder="name@example.com" required>
                        <label>ที่อยู่</label>
                    </div>
                    <div class="form-floating mb-3">
                        <input type="text" class="form-control rounded-3" name="phone"  placeholder="name@example.com" required>
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
</body>
</html>