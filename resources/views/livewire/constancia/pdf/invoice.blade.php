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

        .table th,
        .table td {
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
            margin-top: 20px;
            text-align: center;
        }
        .signature2 {
          
            text-align: right;
            margin-top: 50px;
        }
        .signature3 {
          
            text-align: left;
            margin-top: 20px;
        }
    

        .signature p {
            /*     border-top: 1px solid #000; */
            width: 400px;
            margin: 0 auto;
            text-align: justify padding-top: 5px;

        }
        .signature2 p {
            /*     border-top: 1px solid #000; */
            width: 100%;
            text-align: right;
            padding: 0

        }
        .signature3 p {
            /*     border-top: 1px solid #000; */
            width: 100%;
            text-align: left;
            padding: 0;
            margin: 0

        }
        .firma {
            text-align: center;
            margin-top: 50px;
        }
    </style>
</head>

<body>
    <img src="{{ public_path('img/cintillo2.png') }}" alt="Logo" style="margin-top: -20px; width:800px;">

    {{-- <div class="header">
        <h1>Fundación José Gregorio Hernández</h1>
        <p><strong>RIF:</strong> J-12345678-9</p>
    </div> --}}
    <br>
 
    <div class="content">
        <strong>
            <p style="text-align: center; font-size: 16px">CONSTANCIA</p>
        </strong>
       
        <p style="font-size: 16px; text-align: justify">Quien suscribe, <strong>GERENTE DE LA OFICINA DE GESTIÒN
                HUMANA</strong> de la <strong>FUNDACIÓN MISIÓN JOSÉ GREGORIO HERNÁNDEZ</strong> (FMJGH)
            por medio de la presente hace constar que el (la) ciudadano(a) <strong>{{ $datos_trabajador['apellido'] }},
                {{ $datos_trabajador['nombre'] }} </strong>,
            de nacionalidad <strong>Venezolano (a)</strong>, titular de la Cédula de Identidad N° <strong>{{
                number_format(Auth::user()->cedper, 0,'','.') }}</strong>,
            presta sus servicios en esta institución desde el <strong>{{ $datos_trabajador['fecing'] }}</strong>,
            adscrito(a)
            a la <strong>{{ $datos_trabajador['oficina'] }}</strong>, desempeñando el cargo de <strong>{{
                $datos_trabajador['cargo'] }}</strong>,
            devengando un salario mensual de <strong>{{$datos_trabajador['salario_letras']}} </strong>
            <strong>( {{ number_format($datos_trabajador['sueldo_integral'],2,',','.')  }} Bs.)</strong>
            más bono de alimentación por un monto de <strong>{{ number_format($datos_trabajador['cesta_tikets']['valcon'],2,',','.')  }} </strong> Bs mensuales
        </p>

        <p style="text-indent: 25px; font-size: 16px">Constancia que se expide a solicitud de la parte interesada, el
            dia {{now()->day}} de {{now()->monthName}} del {{now()->year}}</p>
        <p style="text-align: center; font-size: 16px">Atentamente, </p>
    </div>
    <div class="firma">
        <img style="text-align: center" src="{{ public_path('img/firma.png') }}" height="100px" width="300px"  alt="Logo">

    </div>

    <div class="signature">
        <strong>
            <p style="font-size: 16px">{{env('GERENTE_GESTION_HUMANA')}}</p>
        </strong>
        <strong>
            <p style="font-size: 14px">GERENTE DE LA OFICINA DE GESTIÓN HUMANA</p>
        </strong>
        <strong>
            <p style="font-size: 14px">Fundación Misión José Gregorio Hernández</p>
        </strong>
        <p style="text-align: center">
            <i> Providencia Administrativa N° 024/2018 – 26 Junio 2018
                </i>
        </p>
       

    </div>
    <div  class="signature2">

        
            <p>“Dejémonos guiar por el tino, la sabiduría y el coraje de nuestro pueblo,</p>
    
            <p>Allí está la clave para que nuestra Revolución siga victoriosa”</p>
            <p><strong> Comandante Eterno Hugo Chávez Frías</strong></p>
        


    </div>
    <div class="signature3" style="text-align: left; width:100%; ">
        <strong>
            <p style="font-size: 14px">Va sin enmienda</p>
        </strong>
        <strong>
            <p style="font-size: 14px">Válido por 3 Meses a partir de la fecha de emisión.</p>
        </strong>
    </div>



    <div style="margin-top: 60px" class="footer">
        <p>Av. Urdaneta, Edf. Centro Financiero Latino, Piso 25, Of. 25-4 Urb. La Candelaria, Caracas, Distrito Capital.
            Teléfonos: 0212-5633072, 0414-3380398 -04241365553
            <strong> <span> RIF.: G-200108932</span></strong>
        </p>
    </div>

</body>

</html>