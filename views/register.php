<div class="modal fade" id="registerModal">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="registerModalLabel">Register</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="/auth/register" id="register" method="POST">
                    <div class="form-floating mb-3">
                        <input type="email" class="form-control" name="email" id="floatingInput"
                            placeholder="sss">
                        <label>Email address</label>
                    </div>
                    <div class="form-floating mb-3">
                        <input type="password" id="myPass" class="form-control" name="password" placeholder="sss">
                        <label>Password</label>
                    </div>

                    <div class="checkbox mb-3">
                        <label>
                            <input type="checkbox" onclick="showPass()"> Show password
                        </label>
                    </div>

                    <div class="form-floating mb-3">
                        <select class="form-control" name="role" id="roleSelect">
                            <option value="user">User</option>
                            <option value="admin">Admin</option>
                            <option value="manager">Manager</option>
                            <option value="delivery">Delivery</option>
                        </select>
                        <label for="roleSelect">Select Role</label>
                    </div>

                    <div class="form-floating mb-3">
                        <input type="text" class="form-control" name="firstname" placeholder="sss">
                        <label>Firstname</label>
                    </div>

                    <div class="form-floating mb-3">
                        <input type="text" class="form-control" name="lastname" placeholder="sss">
                        <label>Lastname</label>
                    </div>

                    <button class="w-100 btn btn-lg btn-primary" name="register" type="submit">Sign Up</button>
                </form>
            </div>
        </div>
    </div>
</div>