<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <link rel="icon" type="image/png" href="{{ asset('static/images/favicon.png') }}">
    <title>Maintenance</title>
    <style>
        body {
            font-family: sans-serif;
            text-align: center;
            padding: 100px;
            background-color: #f2f2f2;
        }

        h1 {
            font-size: 48px;
            color: #333;
        }

        p {
            font-size: 18px;
            color: #666;
        }
    </style>
</head>

<body>
    <section class="wrapper bg-light">
        <div class="container pt-12 pt-md-14 pb-14 pb-md-16">
            <div class="row">
                <div class="col-lg-9 col-xl-8 mx-auto">
                    <figure class="mb-10">
                        <img class="img-fluid" style="max-width: 300px; height: auto;"
                            src="{{ asset('client/assets/img/illustrations/maintenance.png') }}"
                            srcset="{{ asset('client/assets/img/illustrations/maintenance@2x.png 2x') }}"
                            alt="maintenance">
                    </figure>
                </div>
                <!-- /column -->
                <div class="col-lg-8 col-xl-7 col-xxl-6 mx-auto text-center">
                    <h1 class="mb-3">Situs Sedang Dalam Pemeliharaan</h1>
                    <p>Kami sedang melakukan pemeliharaan rutin. Silakan kembali beberapa saat lagi.</p>
                </div>
                <!-- /column -->
            </div>
            <!-- /.row -->
        </div>
        <!-- /.container -->
    </section>
</body>

</html>
