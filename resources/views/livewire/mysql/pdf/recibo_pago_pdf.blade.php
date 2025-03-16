<div>
    <style>
        body {
            font-family: Arial, sans-serif;
            font-size: 12px;
        }

        h1,
        h2 {
            text-align: center;
        }

        .header {
            text-align: center;
            margin-bottom: 20px;
        }

        .table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 10px;
        }

        .table th,
        .table td {
            border: 1px solid black;
            padding: 5px;
            text-align: left;
        }

        .table th {
            background-color: #f2f2f2;
            font-weight: bold;
        }

        .summary {
            text-align: center;
            margin-top: 10px;
        }

        .signature {
            margin-top: 20px;
            text-align: center;
        }
    </style>
    <div class="header">
        <img src="img/logo.png" width="100" height="80">
        <h2>FUNDACIÓN MISIÓN JOSÉ GREGORIO HERNÁNDEZ</h2>
        <p>Recibo CONTRATADO</p>
    </div>

    <table class="table">
        <tr>
            <th>Apellidos y Nombres</th>
            <td>{{ $recibo_pago['primera-quincena']->personal->apeper }},
                {{ $recibo_pago['primera-quincena']->personal->nomper }}</td>
            <th>Cédula</th>
            <td>{{ $recibo_pago['primera-quincena']->personal->cedper }}</td>
        </tr>
        <tr>
            <th>Cargo</th>
            <td>{{ $recibo_pago['primera-quincena']->personal->descar }}</td>
            <th>Fecha Ingreso</th>
            <td>{{ $recibo_pago['primera-quincena']->personal->fecingper }}</td>
        </tr>
    </table>
    <p class="summary">
        <strong>{{ $recibo_pago['primera-quincena']->periodo->fechasper }}: </strong><br>
    </p>
    <table class="table">
        <tr>
            <th>CONCEPTOS</th>
            <th>ASIGNACIÓN</th>
            <th>CONCEPTOS</th>
            <th>DEDUCCIÓN</th>
        </tr>
        @php
            $maxRows = max(
                count($recibo_pago['primera-quincena']->asignaciones),
                count($recibo_pago['primera-quincena']->deducciones),
            );
            $asignaciones = array_values($recibo_pago['primera-quincena']->asignaciones);
            $deducciones = array_values($recibo_pago['primera-quincena']->deducciones);
        @endphp

        @for ($i = 0; $i < $maxRows; $i++)
            <tr>
                <td>{{ $asignaciones[$i]->nomcon ?? '' }}</td>
                <td>{{ $asignaciones[$i]->valsal ?? '' }}</td>
                <td>{{ $deducciones[$i]->nomcon ?? '' }}</td>
                <td>{{ $deducciones[$i]->valsal ?? '' }}</td>
            </tr>
        @endfor
    </table>



    @if ($recibo_pago['segunda-quincena'])
        <p class="summary">
            <strong>{{ $recibo_pago['segunda-quincena']->periodo->fechasper }}: </strong><br>
        </p>
        <table class="table">
            <tr>
                <th>CONCEPTOS</th>
                <th>ASIGNACIÓN</th>
                <th>CONCEPTOS</th>
                <th>DEDUCCIÓN</th>
            </tr>
            @php
                $maxRows = max(
                    count($recibo_pago['segunda-quincena']->asignaciones),
                    count($recibo_pago['segunda-quincena']->deducciones),
                );
                $asignaciones = array_values($recibo_pago['segunda-quincena']->asignaciones);
                $deducciones = array_values($recibo_pago['segunda-quincena']->deducciones);
            @endphp

            @for ($i = 0; $i < $maxRows; $i++)
                <tr>
                    <td>{{ $asignaciones[$i]->nomcon ?? '' }}</td>
                    <td>{{ $asignaciones[$i]->valsal ?? '' }}</td>
                    <td>{{ $deducciones[$i]->nomcon ?? '' }}</td>
                    <td>{{ $deducciones[$i]->valsal ?? '' }}</td>
                </tr>
            @endfor
        </table>
    @endif
    <table class="table">
        <tr>
            <th>Total Ingresos: </th>
            <td>{{ $recibo_pago['total_asignaciones'] }} </td>
            <th>Total Deducciones</th>
            <td>{{ $recibo_pago['total_deducciones'] }}</td>

        </tr>
        <tr>
            <th>Neto a cobrar: </th>
            <td>{{ $recibo_pago['total_asignaciones'] + $recibo_pago['total_deducciones'] }}</td>
            <th>Cuenta bancaria </th>
            <td>{{ $recibo_pago['primera-quincena']->personal->codcueban }}</td>
        </tr>
    </table>

    <div class="signature">
        <p>Recibí Conforme: ___________________________</p>
    </div>







</div>
