<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Harga Ongkir</title>
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
                        <div class="bd-wizard-step-icon"><i class="mdi mdi-truck-check"></i></div>
                        <div class="media-body">
                            <div class="bd-wizard-step-title mt-2">Harga Ongkir</div>
                        </div>
                    </div>
                </h3>
                <section>
                    <div class="content-wrapper">
                        <h4 class="section-heading">Result</h4>
                        <div id="result">
                            @foreach ($results as $result)
                                <div class="card mb-3">
                                    <div class="card-header">
                                        {{ $result['name'] ?? 'N/A' }}
                                    </div>
                                    <div class="card-body">
                                        @foreach ($result['costs'] as $cost)
                                            <h5 class="card-title">{{ $cost['service'] }} - {{ $cost['description'] }}
                                            </h5>
                                            @foreach ($cost['cost'] as $details)
                                                <p class="card-text">Biaya: {{ $details['value'] }}</p>
                                                <p class="card-text">Estimasi waktu: {{ $details['etd'] }} hari</p>
                                                <p class="card-text">Catatan: {{ $details['note'] }}</p>
                                            @endforeach
                                            <hr>
                                        @endforeach
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </section>
            </div>
        </div>
    </main>
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script src=" {{ asset('/assets/js/jquery.steps.min.js') }}"></script>
    <script src=" {{ asset('/assets/js/bd-wizard.js ') }}"></script>
    <script src=" {{ asset('/assets/js/ongkir.js ') }}"></script>
</body>

</html>
