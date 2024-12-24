<?php

require 'config.php';

$id = $_GET['id'];
require_once __DIR__ . '/vendor/autoload.php';

// $stmt = $pdo->prepare("");


$mpdf = new \Mpdf\Mpdf();
ob_start();
include 'assets.php';
?>

<!DOCTYPE html>
<html lang='en'>
<head>
    <meta charset='UTF-8'>
    <meta name='viewport' content='width=device-width, initial-scale=1.0'>
    <title>ใบเสร็จ | <?= $id ?></title>
</head>
<style>
        body {
            font-family: "Garuda", sans-serif;
            font-size: 14px;
        }
        .receipt-header {
            text-align: center;
            font-size: 24px;
            margin-bottom: 20px;
        }
        .receipt-details {
            margin-top: 20px;
        }
        .footer {
            margin-top: 50px;
            text-align: center;
        }
    </style>
<body>
    <div class="container mt-5">
        <div class="receipt-header">
            <h1 class="display-4">ใบเสร็จ</h1>
            <p>รหัสใบเสร็จ: <?= $id ?></p>
        </div>
        <div class="receipt-details">
            <p><strong>วันที่:</strong> <?= date('Y-m-d H:i:s') ?></p>
            <p><strong>รายการสินค้า:</strong></p>
            <table class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th>ชื่อสินค้า</th>
                        <th>จำนวน</th>
                        <th>ราคา</th>
                        <th>รวม</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>สินค้า 1</td>
                        <td>2</td>
                        <td>100 บาท</td>
                        <td>200 บาท</td>
                    </tr>
                    <tr>
                        <td>สินค้า 2</td>
                        <td>1</td>
                        <td>150 บาท</td>
                        <td>150 บาท</td>
                    </tr>
                    <tr>
                        <td colspan="3" class="text-end"><strong>รวม</strong></td>
                        <td><strong>350 บาท</strong></td>
                    </tr>
                </tbody>
            </table>
        </div>
        <div class="footer">
            <p>ขอบคุณที่ใช้บริการ!</p>
        </div>
    </div>
</body>
</html>

<?php
$html = ob_get_contents();
ob_end_clean();
$mpdf->WriteHTML($html);
$mpdf->Output('receipt_' . $id . '.pdf', 'I'); 
?>
