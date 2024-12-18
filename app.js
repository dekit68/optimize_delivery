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
                success: function (data) {
                    console.log(data);
                    let result = JSON.parse(data);
                    alert(result)
                    window.location.reload();
                }
            });
        });
    });
}

function updateProfile() {
    $(document).ready(function () {
        $("#updateProfileForm").submit(function (e) {
            e.preventDefault();
            let url = $(this).attr("action");
            let method = $(this).attr("method");
            let data = new FormData(this);
            $.ajax({
                url: url,
                type: method,
                data: data,
                processData: false,
                contentType: false,
                success: function (data) {
                    console.log(data);
                    let result = JSON.parse(data);
                    alert(result);
                    location.reload();
                },
            });
        });
    });
}

function previewImage(event) {
    const reader = new FileReader();
    reader.onload = function () {
        const output = document.getElementById('imagePreview');
        output.style.display = 'block';
        output.src = reader.result;
    }
    reader.readAsDataURL(event.target.files[0]);
}