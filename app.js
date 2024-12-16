function send(hashid) {
    $(document).ready(function () {
        $(hashid).submit(function (e) {
            e.preventDefault();
            let url = $(this).attr('action')
            let method = $(this).attr('method')
            let data = $(this).serialize()

            $.ajax({
                url: url,
                type: method,
                data: data,
                success: function (data) {
                    console.log(data)
                }
            })
        })
    })
}