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

function previewImage(event) {
    const reader = new FileReader();
    reader.onload = function() {
        const output = document.getElementById('imagePreview');
        output.style.display = 'block';
        output.src = reader.result;
    }
    reader.readAsDataURL(event.target.files[0]);
}

function adminManage() {
    $.get('/fetch_data', function(data) {
        const tbody = $('#admin-table tbody').empty();
        data.forEach(user => {
            const tr = $('<tr>').data('id', user.id)
                .append($('<td>').text(user.role))
                .append($('<td>').text(user.email))
                .append($('<td>').text(user.firstname))
                .append($('<td>')
                    .append($('<button>').addClass('btn btn-warning edit-btn').text('แก้ไข'))
                    .append(' ')
                    .append($('<button>').addClass('btn btn-danger delete-btn').text('ลบ'))
                );
            tbody.append(tr);
        });
    }, 'json');

    $(document).on('click', '.edit-btn', function() {
        const userId = $(this).closest('tr').data('id');
        const row = $(this).closest('tr');
        const role = row.find('td').eq(0).text();
        const email = row.find('td').eq(1).text();
        const firstname = row.find('td').eq(2).text();
        $('#userId').val(userId);
        $('#role').val(role);
        $('#email').val(email);
        $('#firstname').val(firstname);
        $('#editModal').modal('show');
    });
    
    $('#editForm').submit(function(e) {
        e.preventDefault();
        const userId = $('#userId').val();
        const role = $('#role').val();  
        const email = $('#email').val();
        const firstname = $('#firstname').val();
        $.ajax({
            url: '/update_user',
            method: 'POST',
            contentType: 'application/json',
            data: JSON.stringify({ id: userId, role: role, email: email, firstname: firstname }),
            success: function(response) {
                const result = JSON.parse(response);
                alert(result.success ? 'บันทึกข้อมูลสำเร็จ' : 'เกิดข้อผิดพลาด: ' + result.error);
                if (result.success) {
                    location.reload();
                }
            },
            error: function() {
                alert('เกิดข้อผิดพลาดในการติดต่อเซิร์ฟเวอร์');
            }
        });
        $('#editModal').modal('hide');
    });
    
    $(document).on('click', '.delete-btn', function() {
        const userId = $(this).closest('tr').data('id');
        if (userId) {
            if (confirm('คุณแน่ใจหรือไม่ที่จะลบข้อมูลนี้?')) {
                $.post('/delete_user', JSON.stringify({ id: userId }), function(response) {
                    const result = JSON.parse(response);
                    alert(result.success ? 'ลบข้อมูลสำเร็จ' : 'เกิดข้อผิดพลาด: ' + result.error);
                    if (result.success) location.reload();
                }).fail(function() {
                    alert('เกิดข้อผิดพลาดในการติดต่อเซิร์ฟเวอร์');
                });
            }
        }
    });
}