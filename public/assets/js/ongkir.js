
$('#asal_provinsi').select2({
    placeholder: 'Pilih Provinsi',
    allowClear: true
});
$('#asal_kab').select2({
    placeholder: 'Pilih Kab/Kota',
    allowClear: true
});

$('select[name="asal_provinsi"]').on('change', function () {
    let provinceId = $(this).val();

    if (provinceId) {
        $.ajax({
            url: '/api/province/' + provinceId + '/cities',
            type: "GET",
            dataType: "JSON",
            success: function (data) {
                $('select[name="asal_kab"]').empty();
                $.each(data, function (key, value) {
                    $('select[name="asal_kab"]').append(`
                        <option value="${key}">${value}</option>`);
                });
                $('#asal_kab').trigger('change.select2');

            },
            error: function (xhr, status, error) {
                console.error('Error:', error);
            }
        });
    } else {
        $('select[name="asal_kab"]').empty();
    }
});

$('#tujuan_provinsi').select2({
    placeholder: 'Pilih Provinsi',
    allowClear: true
});
$('#tujuan_kab').select2({
    placeholder: 'Pilih Kab/Kota',
    allowClear: true
});

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
                    $('select[name="tujuan_kab"]').append(`
                        <option value="${key}">${value}</option>`)
                })
            },
        })
    } else {
        $('select[name="tujuan_kab"]').empty();
    }
})

// $("#tujuan_kab").select2({
//     ajax: {
//         url: 'api/cities',
//         type: "POST",
//         dataType: "JSON",
//         delay: 150,
//         data: function (params) {
//             return {
//                 _token: $('meta[name="csrf-token"]').attr('content'),
//                 search: $.trim(params.term)
//             };
//         },
//         processResults: function (response) {
//             return {
//                 results: response // Menggunakan 'results' bukan 'result'
//             };
//         },
//         cache: true
//     }
// });

