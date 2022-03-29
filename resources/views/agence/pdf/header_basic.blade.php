<!doctype html>
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <link href="{{ asset('/css/pdf.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('/css/pdf_style.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('/assets/plugins/global/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet" type="text/css" />
</head>
<body>
<header>
    <div class="logo">
        <img src="{{ public_path('/storage/logo_long_color_540.png') }}" alt="{{ $agence->name }}">
    </div>
    <span class="letter-code">{{ Str::upper(Str::random(4)) }} {{ Str::upper(Str::random(4)) }} {{ Str::upper(Str::random(4)) }} CPT{{ isset($customer->wallets()->first()->number_account)?$customer->wallets()->first()->number_account:Str::upper(Str::random(10)) }} {{ Str::upper(Str::random(5)) }} {{ Str::upper(Str::random(4)) }}</span>
    <div style="margin: 20px">
        <strong>Agence:</strong> {{ $agence->name }}
    </div>
</header>

</body>
</html>
