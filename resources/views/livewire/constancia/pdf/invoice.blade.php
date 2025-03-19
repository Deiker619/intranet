<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Constancia de Trabajo</title>
    <style>
        /* Estilos generales */
body {
    font-family: 'Arial', sans-serif;
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
    font-size: 16px
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
    border-top: 1px solid #000;
    width: 200px;
    margin: 0 auto;
    padding-top: 5px;
    font-weight: bold;
}

    </style>
</head>
<body>

    <div class="header">
        <img src="{{ public_path('img/logo.png') }}" alt="Logo">
        <h1>Fundación José Gregorio Hernández</h1>
        <p><strong>RIF:</strong> J-12345678-9</p>
    </div>

    <div class="content">
        <p>A QUIEN PUEDA INTERESAR:</p>
        <p>Por medio de la presente hacemos constar que el(la) ciudadano(a) <strong>{{ 'Algo' }}</strong>, 
        identificado(a) con C.I. <strong>{{ 'Algo'  }}</strong>, 
        labora en nuestra institución desde el <strong>{{'Algo'}}</strong> 
        desempeñando el cargo de <strong>{{ 'Algo' }}</strong>.</p>

        <p>Su salario mensual es de <strong>{{ number_format($datos_trabajador['salario'] ?? 0, 2, ',', '.')}} Bs.</strong>
            <strong>{{ $datos_trabajador['salario_letras'] ?? 'N/A' }} Bolívares</strong>.</p>

        <p>Esta constancia se expide a solicitud de la parte interesada en <strong>{{ date('d/m/Y') }}</strong>.</p>
    </div>

    <div class="signature">
        <p>Firma Autorizada</p>
    </div>

    <div class="footer">
        <p>Dirección: Calle Ejemplo, Ciudad, País | Teléfono: +58 123-4567890</p>
    </div>

</body>
</html>
