<div class="modal fade" id="editModal">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editModalLabel">แก้ไขข้อมูลผู้ใช้</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="editForm">
                    <div class="form-group">
                        <label for="role">Role</label>
                        <input type="text" class="form-control" id="role" required>
                    </div>
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="email" class="form-control" id="email" required>
                    </div>
                    <div class="form-group">
                        <label for="firstname">Name</label>
                        <input type="text" class="form-control" id="firstname" required>
                    </div>
                    <input type="hidden" id="userId">
                    <button type="submit" class="btn btn-primary">บันทึก</button>
                </form>
            </div>
        </div>
    </div>
</div>


<div class="modal fade" id="createShopType" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="createShopTypeLabel">Create Shop Type</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="functions/shop_type_add.php" method="POST" id="createShop">
                    <div class="mb-3">
                        <label class="form-label">Shop Type Name</label>
                        <input type="text" class="form-control" name="name" required>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>


<div class="modal fade" id="createfood" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Create Shop Type</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="functions/food_add.php" method="POST" id="createfood1">
                    <div class="mb-3">
                        <label class="form-label">Food Name</label>
                        <input type="text" class="form-control" name="name" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Food Type</label>
                        <select name="type" required>
                            <?php
                            foreach ($food_types as $food_type):
                            ?>
                            <option value="<?= $food_type['id'] ?>"><?= $food_type['name'] ?></option>
                            <?php
                            endforeach;
                            ?>
                          
                        </select>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Price</label>
                        <input type="text" class="form-control" name="price" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Discount</label>
                        <input type="text" class="form-control" name="discount" required>
                    </div>
                    <div class="mb-3">
                        <img id="imagePreview" src="#" style="display:none; width: 100%; max-width: 300px;" />
                    </div>
                    <input type="file" class="form-control" name="food_image" onchange="previewImage(event)">
                    <input type="hidden" name="shop" value="<?= $datashop['id'] ?>">
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="createFoodType" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Create Food Type</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="functions/food_type_add.php" method="POST" id="createfoodtype">
                    <div class="mb-3">
                        <label class="form-label">Type Name</label>
                        <input type="text" class="form-control" name="name" required>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="access_shopp" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">access_shopp</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="functions/req_access_shop.php" method="POST" id="reqshop">
                    <div class="mb-3">
                        <label class="form-label">Shop Name</label>
                        <input type="text" class="form-control" name="name" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Shop Address</label>
                        <input type="text" class="form-control" name="address" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Shop Phone</label>
                        <input type="text" class="form-control" name="phone" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">ประเภทร้านอาหาร</label>
                        <select name="type" required>
                            <?php
                            foreach ($shop_types as $shop_type):
                            ?>
                            <option value="<?= $shop_type['id'] ?>"><?= $shop_type['name'] ?></option>
                            <?php
                            endforeach;
                            ?>
                          
                        </select>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="pay" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content shadow-lg border-0">
            <div class="modal-header bg-primary text-white">
                <h5 class="modal-title">Confirm Payment</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="functions/checkout.php" method="POST" id="confirm_pay">
                    <h6 class="mb-3 text-muted">Order Summary</h6>
                    <div class="list-group mb-3">
                        <?php foreach ($carts as $cart): ?>
                        <div class="list-group-item d-flex justify-content-between align-items-center">
                            <div>
                                <h6 class="mb-0"><?= $cart['name'] ?></h6>
                                <small class="text-muted">Qty: <?= $cart['qty'] ?> | Discount: <?= $cart['discount'] ?>%</small>
                            </div>
                            <div>
                                <span class="text-muted">฿<?= $cart['price'] ?></span>
                                <h6 class="mb-0 text-success">฿<?= $cart['total_price'] ?></h6>
                            </div>
                        </div>
                        <input type="hidden" name="id[]" value="<?= $cart['id'] ?>">
                        <?php endforeach; ?>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Confirm</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
