<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Cek Ongkir</title>
    <link href="https://fonts.googleapis.com/css?family=Karla:400,700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.materialdesignicons.com/4.8.95/css/materialdesignicons.min.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="{{ asset('assets/css/bd-wizard.css') }}">
</head>

<body>
    <main class="my-5">
        <div class="container">
            <div id="wizard">
                <h3>
                    <div class="media">
                        <div class="bd-wizard-step-icon"><i class="mdi mdi-truck"></i></div>
                        <div class="media-body">
                            <div class="bd-wizard-step-title mt-2">Cek Ongkir</div>
                        </div>
                    </div>
                </h3>
                <section>
                    <form id="cekOngkirForm" action="{{ route('store') }}" method="POST">
                        @csrf
                        <div class="content-wrapper">
                            <h4 class="section-heading">Asal Pengirim : </h4>
                            <div class="d-flex flex-row bd-highlight mb-3">
                                <div class="d-flex flex-column col-md-6 bd-highlight mb-3">
                                    <div class="bd-highlight mb-4">
                                        <label for="asal_provinsi" class="sr-only">Provinsi</label>
                                        <select class="form-control custom-select" name="asal_provinsi"
                                            id="asal_provinsi">
                                            <option value="">===Pilih Provinsi===</option>
                                            @foreach ($province as $key => $value)
                                                <option value="{{ $key }}">{{ $value }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="bd-highlight mb-3">
                                        <label for="asal_kab" class="sr-only">Kota/Kabupaten</label>
                                        <select class="form-control custom-select" name="asal_kab"
                                            id="asal_kab"></select>
                                    </div>
                                </div>
                                <div class="d-flex flex-column col-md-6 bd-highlight mb-3">
                                    <span class="bd-wizard-step-title">Pilih Ekspedisi :</span>
                                    <div class="d-flex flex-row bd-highlight mb-3">
                                        @foreach ($courier as $value)
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input" type="checkbox"
                                                    id="courier-{{ $value->code }}" value="{{ $value->code }}"
                                                    name="courier[]">
                                                <label class="form-check-label text-uppercase"
                                                    for="courier-{{ $value->code }}">{{ $value->code }}</label>
                                            </div>
                                        @endforeach
                                    </div>
                                    <div class="d-flex flex-row bd-highlight mb-3">
                                        <div class="input-group mb-3">
                                            <input type="text" class="form-control" name="weight" id="weight"
                                                placeholder="Masukkan Berat" aria-label="Masukkan Berat"
                                                aria-describedby="basic-addon2">
                                            <div class="input-group-append">
                                                <span class="input-group-text" id="basic-addon2">Gram</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <h4 class="section-heading">Tujuan Pengirim : </h4>
                            <div class="d-flex flex-row bd-highlight mb-3">
                                <div class="d-flex flex-column col-md-6 bd-highlight mb-3">
                                    <div class="bd-highlight mb-4">
                                        <label for="tujuan_provinsi" class="sr-only">Provinsi</label>
                                        <select class="form-control custom-select" name="tujuan_provinsi"
                                            id="tujuan_provinsi">
                                            <option value="">===Pilih Provinsi===</option>
                                            @foreach ($province as $key => $value)
                                                <option value="{{ $key }}">{{ $value }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="bd-highlight mb-3">
                                        <label for="tujuan_kab" class="sr-only">Kota/Kabupaten</label>
                                        <select class="form-control custom-select" name="tujuan_kab"
                                            id="tujuan_kab"></select>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="actions clearfix">
                            <ul role="menu" aria-label="Pagination">
                                <li class="next">
                                    <button type="submit" class="btn btn-primary">Cek Ongkir</button>
                                </li>
                            </ul>
                        </div>
                    </form>
                </section>
            </div>
            <section>
                <div class="content-wrapper">
                    <div id="result" class="mt-4">
                    </div>
                </div>
            </section>
        </div>
    </main>
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script src="{{ asset('/assets/js/jquery.steps.min.js') }}"></script>
    <script src="{{ asset('/assets/js/bd-wizard.js') }}"></script>
    <script src="{{ asset('/assets/js/ongkir.js') }}"></script>
    <script>
        $(document).ready(function() {
            $('#cekOngkirForm').submit(function(e) {
                e.preventDefault();
                var form = $(this);
                var url = form.attr('action');
                var formData = form.serialize();
                $.ajax({
                    type: 'POST',
                    url: url,
                    data: formData,
                    success: function(response) {
                        // $('#result').html(response);
                        displayResults(response.results);

                    },
                    error: function(xhr, status, error) {
                        console.error(error);
                        alert('Terjadi kesalahan saat mengambil data ongkir.');
                    }
                });
            });

            function displayResults(results) {
                var resultHtml = '';
                results.forEach(function(result) {
                    result.rajaongkir.results.forEach(function(service) {
                        resultHtml += '<div class="card mb-3">';
                        resultHtml += '<div class="card-header">' + service.name + '</div>';
                        resultHtml += '<div class="card-body">';
                        service.costs.forEach(function(cost) {
                            cost.cost.forEach(function(c) {
                                var formattedValue = new Intl.NumberFormat(
                                    'id-ID', {
                                        style: 'currency',
                                        currency: 'IDR'
                                    }).format(c.value);
                                resultHtml += '<p class="card-text">' + cost
                                    .description + ' (' + c.etd + ' hari): ' +
                                    formattedValue + '</p>';
                            });
                        });
                        resultHtml += '</div></div>';
                    });
                });
                $('#result').html(resultHtml);
            }
        });
    </script>
</body>

</html>
