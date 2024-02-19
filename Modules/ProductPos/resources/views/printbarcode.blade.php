<html>

<head>
    <title>Print Barcode </title>
    <link href="{{ asset('assets/plugins/global/plugins.bundle.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets/css/style.bundle.css') }}" rel="stylesheet" type="text/css" />
    <style>
        .grid {
            display: grid;
            /* 5 cols (each 100px in width) */
            grid-template-rows: 100px 100px 100px 100px;
            margin: 50px;
            grid-template-columns: repeat(6, 230px);
            align-self: center;
            grid-gap: 5px;
        }

        .grid>div {
            background-color: white;
            padding: 20px;
            text-align: center;
            page-break-inside: avoid;
            border: 1px solid black;
            height: 150px;
        }
    </style>
</head>

<body onload="window.print()">
    <div class = "grid">
        {!! $html !!}
    </div>
</body>

</html>
