<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Constancia de Trabajo</title>
    <style>
        /* Estilos generales */
body {
    font-family: 'Times New Roman', Times, serif;
    font-size: 12px;
    color: #000;
    line-height: 1.5;
}

/* Encabezado */
.header {
    text-align: center;
    margin-bottom: 20px;
}

.header img {
    width: 100px;
}

.header h1 {
    font-size: 16px;
    text-transform: uppercase;
    margin: 5px 0;
}

/* Contenido principal */
.content {
    text-align: justify;
    margin: 0 40px;
}

.content p {
    font-size: 16px,
    text-align:center,
    margin-bottom: 15px;
}

/* Tabla de datos */
.table {
    width: 100%;
    border-collapse: collapse;
    margin-top: 20px;
}

.table th, .table td {
    border: 1px solid #000;
    padding: 8px;
    text-align: left;
}

.table th {
    background-color: #f2f2f2;
}

/* Pie de página */
.footer {
    text-align: center;
    margin-top: 40px;
    font-size: 11px;
}

/* Firma */
.signature {
    margin-top: 50px;
    text-align: center;
}

.signature p {
/*     border-top: 1px solid #000; */
    width: 200px;
    margin: 0 auto;
    padding-top: 5px;
    font-weight: bold;
}

    </style>
</head>
<body>
    <img src="{{ public_path('img/cintillo.png') }}" alt="Logo">

    {{-- <div class="header">
        <h1>Fundación José Gregorio Hernández</h1>
        <p><strong>RIF:</strong> J-12345678-9</p>
    </div> --}}
    <br>
    <br>
    <br>
    <div class="content">
       <strong> <p style="text-align: center; font-size: 16px">CONSTANCIA</p></strong>
       <br>
       <p style="font-size: 16px">Quien suscribe, <strong>{{$datos_trabajador['cargo']}}</strong> de la <strong>FUNDACIÓN MISIÓ JOSÉ GREGORIO HERNÁNDEZ</strong> (FMJGH)
        por medio de la presente hace constar que el (la) ciudadano(a) <strong>{{ $datos_trabajador['apellido'] }}, {{ $datos_trabajador['apellido'] }} </strong>,
        de nacionalidad <strong>Venezolano (a)</strong>, titular de la Cédula de Identidad N° <strong>{{ number_format(Auth::user()->cedper, 0,'','.') }}</strong>,
        presta sus servicios en esta institución desde el <strong>{{ $datos_trabajador['fecing'] }}</strong>, adscrito(a)
        a la <strong>{{ $datos_trabajador['oficina'] }}</strong>, desempeñando el cargo de <strong>{{ $datos_trabajador['cargo'] }}</strong>,
        devengando un salario mensual de <strong>{{$datos_trabajador['salario_letras']}}</strong> <strong>( {{ number_format($datos_trabajador['sueldo'],2,',','.')  }} Bs.)</strong>  
        más bono de alimentación por un monto de  2.000 bs mensuales
        </p>

        <p style="text-indent: 25px; font-size: 16px">Constancia que se expide a solicitud de la parte interesada, el dia {{now()->day}} de {{now()->monthName}} del {{now()->year}}</p>
        <p style="text-align: center; font-size: 16px">Atentamente, </p>
    </div>
    <br>

    <div class="signature">
        <p>{{env('GERENTE_GESTION_HUMANA')}}</p>
    </div>

    <div class="footer">
        <p>Dirección: Calle Ejemplo, Ciudad, País | Teléfono: +58 123-4567890</p>
    </div>

</body>
</html>
