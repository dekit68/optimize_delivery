function showPass() {
    let myPass = document.getElementById('myPass');
    if (myPass.type === "password") {
        myPass.type = "text";
    } else {
        myPass.type = "password";
    }
}

function send(hashid) {
    $(document).ready(function () {
        $(hashid).submit(function (e) {
            e.preventDefault();

            let furl = $(this).attr('action');
            let method = $(this).attr('method'); 
            let fdata = $(this).serialize(); 

            $.ajax({
                url: furl,
                type: method,
                data: fdata,
                success: function(data) {
                    console.log(data); 
                    let result = JSON.parse(data); 
                    if (result.status == 'success') {
                        alert('Successfully!!! ' + result.msg)
                        setTimeout(function() {
                            window.location.href = "/dashboard";
                        }, 1000); 
                    } else {
                        alert('Error!!! ' + result.msg);
                    }
                }
            });
        });
    });
}

function updateProfile() {
    $(document).ready(function () {
        $("#updateProfileForm").submit(function (e) {
            e.preventDefault();
            let formUrl = $(this).attr("action");
            let reqMethod = $(this).attr("method");
            let formData = new FormData(this);
            $.ajax({
                url: formUrl,
                type: reqMethod,
                data: formData,
                processData: false,
                contentType: false, 
                success: function (data) {
                    console.log(data);
                    let result = JSON.parse(data);
                    if (result.status === 'success') {
                        alert("Profile updated successfully!");
                        location.reload();
                    } else {
                        alert(result.message);
                    }
                },
            });
        });
    });
}