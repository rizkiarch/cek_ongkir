$('select[name="asal_provinsi"]').on('change', function () {
    let provinceId = $(this).val()

    if (provinceId) {
        jQuery.ajax({
            url: '/api/province/' + provinceId + '/cities',
            type: "GET",
            dataType: "JSON",
            success: function (data) {
                $('select[name="asal_kab"]').empty();
                $.each(data, function (key, value) {
                    $('select[name="asal_kab"]').append(`<option value="${key}">${value}</option>`)
                })
            },
        })
    } else {
        $('select[name="asal_kab"]').empty();
    }
})

$('select[name="tujuan_provinsi"]').on('change', function () {
    let provinceId = $(this).val()

    if (provinceId) {
        jQuery.ajax({
            url: '/api/province/' + provinceId + '/cities',
            type: "GET",
            dataType: "JSON",
            success: function (data) {
                $('select[name="tujuan_kab"]').empty();
                $.each(data, function (key, value) {
                    $('select[name="tujuan_kab"]').append(`<option value="${key}">${value}</option>`)
                })
            },
        })
    } else {
        $('select[name="tujuan_kab"]').empty();
    }
})
