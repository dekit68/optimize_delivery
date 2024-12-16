<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <script src="assets/jquery-3.7.1.min.js"></script>
    <script src="app.js"></script>
</head>
<body>
    <form action="backend/register.php" method="post" id="register">
        <input type="text" name="email">
        <input type="password" name="password">
        <button type="submit">Send</button>
    </form>
    <script>
        $(document).ready(function () {
            send('#register');
        })
    </script>
</body>
</html>