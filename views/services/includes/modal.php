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