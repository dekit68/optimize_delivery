<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dekit Delivery</title>
</head>

<body>
    <?php include 'navbar.php' ?>
    
    <div class="container py-5">
        <header class="bg-primary text-white text-center p-5 rounded-3 mb-5">
            <h1 class="fw-bold">Delivery Information</h1>
            <p class="lead">ระบบและการจัดการที่ครอบคลุมสำหรับทุกบทบาท</p>
        </header>

        <section>
            <div class="row g-4">
                <div class="col-md-6 col-lg-3">
                    <div class="card border-primary">
                        <div class="card-body text-center">
                            <h4 class="card-title text-primary">User</h4>
                            <ul class="list-group list-group-flush">
                                <li class="list-group-item">สร้างคำสั่งจัดส่ง</li>
                                <li class="list-group-item">ติดตามพัสดุแบบเรียลไทม์</li>
                                <li class="list-group-item">ตรวจสอบสถานะคำสั่งซื้อ</li>
                                <li class="list-group-item">ชำระเงินออนไลน์</li>
                            </ul>
                        </div>
                    </div>
                </div>

                <div class="col-md-6 col-lg-3">
                    <div class="card border-success">
                        <div class="card-body text-center">
                            <h4 class="card-title text-success">Manager</h4>
                            <ul class="list-group list-group-flush">
                                <li class="list-group-item">จัดการคำสั่งซื้อทั้งหมด</li>
                                <li class="list-group-item">มอบหมายงานให้ทีมจัดส่ง</li>
                                <li class="list-group-item">ดูรายงานการจัดส่ง</li>
                                <li class="list-group-item">ตรวจสอบและปรับปรุงเส้นทาง</li>
                            </ul>
                        </div>
                    </div>
                </div>

                <div class="col-md-6 col-lg-3">
                    <div class="card border-danger">
                        <div class="card-body text-center">
                            <h4 class="card-title text-danger">Admin</h4>
                            <ul class="list-group list-group-flush">
                                <li class="list-group-item">จัดการผู้ใช้งานทุกบทบาท</li>
                                <li class="list-group-item">เพิ่ม/ลบ/แก้ไขข้อมูลสินค้าและบริการ</li>
                                <li class="list-group-item">ดูสถิติและข้อมูลภาพรวม</li>
                                <li class="list-group-item">กำหนดสิทธิ์การเข้าถึง</li>
                            </ul>
                        </div>
                    </div>
                </div>

                <div class="col-md-6 col-lg-3">
                    <div class="card border-warning">
                        <div class="card-body text-center">
                            <h4 class="card-title text-warning">Delivery Personnel</h4>
                            <ul class="list-group list-group-flush">
                                <li class="list-group-item">รับคำสั่งจัดส่ง</li>
                                <li class="list-group-item">อัปเดตสถานะการจัดส่ง</li>
                                <li class="list-group-item">ติดตามเส้นทาง</li>
                                <li class="list-group-item">ยืนยันการจัดส่งสำเร็จ</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>

</body>

</html>