<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
    <script src="assets/jquery-3.7.1.min.js"></script>
</head>
<body>
    <div class="py-5"></div>
    <form action="/login" method="post" id="loginA">
        <div class="container">
            <h1>Login form</h1>
            <div class="form-floating">
                <input type="text" name="username" class='form-control' placeholder='dsdsd'>
                <label for="">Username</label>
            </div>
            <div class="form-floating">
                <input type="password" name="password" class='form-control' placeholder='dsdsd'>
                <label for="">Password</label>
            </div>

            <button class="btn btn-primary">
                Login
            </button>
        </div>
    </form>

    <script>
        $(document).ready(function(){
            $('#loginA').submit(function(e){
                e.preventDefault();

                let Furl = $(this).attr('action')
                let Fmethod = $(this).attr('method')
                let Fdata = $(this).serialize()

                // console.log(data)

                $.ajax({
                    url: Furl,
                    type: Fmethod,
                    data: Fdata,
                    success: function(data) {
                        let result = JSON.parse(data);
                        if (result.status == 'success') {
                            alert('Successfuly !!!');
                        } else {
                            alert('Error ไอ้ควาย !!!');
                        }
                    }
                })
            })
        });
    </script>
</body>
</html>