<?php 
    include 'register.php';
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Page</title>
</head>
<body>
<?php include 'components/navbar.php' ?>
<div class="container">
        <div class="py-5"></div>
        <h1 class="text-center">FOOD MEC</h1>
        <form action="../functions/login.php" method="post" id="login">
            <div class="form-floating mb-3">
                <input type="text" name="email" class="form-control" placeholder="Enter Username">
                <label>Email</label>
            </div>
            <div class="form-floating mb-3">
                <input type="password" name="password" class="form-control" placeholder="Enter Password">
                <label for="password">Password</label>
            </div>
            <div class="d-grid gap-2 mb-3">
                <button type="submit" class="btn btn-primary w-100 btn-lg">Login</button>
            </div>
            <div class="d-grid gap-2 ">
                <button type="button" class="btn btn-secondary w-100 btn-lg" data-bs-toggle="modal" data-bs-target="#registerModal">
                    Register
                </button>
            </div>
        </form>
    </div>

    <script>
        $(document).ready(function () {
            send("#register");
            send("#login");
        });
    </script>
</body>

</html>