<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>auth</title>
</head>
<body>

    <div class="container">
        
    <?php
        include 'status.php';
    ?>
    
    <h1>Register</h1>
    <form action="function/auth.php?type=register" method="post">
        <input type="email" name="email" required>
        <input type="password" name="password" required>
        <select name="role">
            <option value="user">user</option>
            <option value="admin">admin</option>
            <option value="manager">manager</option>
            <option value="delivery">delivery</option>
        </select>
        <input type="text" name="fname" required>
        <input type="text" name="lname" required>
        <input type="text" name="address" required>
        <input type="text" name="phone" required>
        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
    <hr>
    <h1>login</h1>
    <form action="function/auth.php?type=login" method="post">
        <input type="email" name="email" required>
        <input type="password" name="password" required>
        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
    </div>


</body>
</html>