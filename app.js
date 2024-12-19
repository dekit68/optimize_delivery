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
        $("#"+hashid).submit(function (e) {
            e.preventDefault();
            let url = $(this).attr('action');
            let method = $(this).attr('method');
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
                    alert(result)
                    location.reload();
                }
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

function confirmDelete(title) {
    return confirm("Are you sure you want to delete this " + title + "?");
}

$(document).ready(function () {
    const lastContent = localStorage.getItem('lastContent');
    if (lastContent) {
        $(".contents").hide();  
        $("#" + lastContent).fadeIn(); 
    } else {
        $(".contents").hide(); 
        $(".contents").first().fadeIn(); 
    }
    $(".nav-content").on("click", function (e) {
        e.preventDefault();
        let show = $(this).data("content");
        $(".contents").hide();
        $("#" + show).fadeIn();
        localStorage.setItem('lastContent', show);
    })
})