<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reporte Negocios - LocalConnect</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            font-size: 11px;
            line-height: 1.3;
            color: #333;
            margin: 0;
            padding: 15px;
        }

        .header {
            text-align: center;
            border-bottom: 2px solid #3b82f6;
            padding-bottom: 10px;
            margin-bottom: 20px;
        }

        .header h1 {
            color: #3b82f6;
            margin: 0;
            font-size: 22px;
        }

        .header p {
            margin: 5px 0 0 0;
            color: #666;
        }

        .summary {
            background-color: #f9fafb;
            border: 1px solid #e5e7eb;
            padding: 10px;
            margin-bottom: 20px;
            border-radius: 4px;
        }

        .summary-grid {
            display: table;
            width: 100%;
        }

        .summary-item {
            display: table-cell;
            text-align: center;
            padding: 5px;
        }

        .summary-value {
            font-size: 16px;
            font-weight: bold;
            color: #3b82f6;
            display: block;
        }

        .summary-label {
            font-size: 10px;
            color: #6b7280;
        }

        .table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 15px;
            font-size: 10px;
        }

        .table th {
            background-color: #f3f4f6;
            padding: 6px 8px;
            text-align: left;
            font-weight: bold;
            border: 1px solid #d1d5db;
            font-size: 10px;
        }

        .table td {
            padding: 6px 8px;
            border: 1px solid #e5e7eb;
            font-size: 9px;
            vertical-align: top;
        }

        .table tr:nth-child(even) {
            background-color: #f9fafb;
        }

        .status-approved {
            background-color: #dcfce7;
            color: #166534;
            padding: 2px 6px;
            border-radius: 3px;
            font-size: 8px;
            font-weight: bold;
        }

        .status-pending {
            background-color: #fef3c7;
            color: #92400e;
            padding: 2px 6px;
            border-radius: 3px;
            font-size: 8px;
            font-weight: bold;
        }

        .footer {
            margin-top: 20px;
            text-align: center;
            font-size: 9px;
            color: #6b7280;
            border-top: 1px solid #e5e7eb;
            padding-top: 10px;
        }

        .page-break {
            page-break-before: always;
        }

        .truncate {
            max-width: 150px;
            overflow: hidden;
            text-overflow: ellipsis;
            white-space: nowrap;
        }
    </style>
</head>

<body>
    <div class="header">
        <h1>LocalConnect</h1>
        <p>Reporte de Negocios</p>
        <p>Generado el: {{ now()->format('d/m/Y H:i') }}</p>
    </div>

    <div class="summary">
        <div class="summary-grid">
            <div class="summary-item">
                <span class="summary-value">{{ $negocios->count() }}</span>
                <span class="summary-label">Total Negocios</span>
            </div>
            <div class="summary-item">
                <span class="summary-value">{{ $negocios->where('verificado', 1)->count() }}</span>
                <span class="summary-label">Aprobados</span>
            </div>
            <div class="summary-item">
                <span class="summary-value">{{ $negocios->where('verificado', 0)->count() }}</span>
                <span class="summary-label">Pendientes</span>
            </div>
            <div class="summary-item">
                <span class="summary-value">{{ $negocios->unique('usuario_id')->count() }}</span>
                <span class="summary-label">Usuarios Únicos</span>
            </div>
        </div>
    </div>

    <table class="table">
        <thead>
            <tr>
                <th>ID</th>
                <th>Negocio</th>
                <th>Usuario</th>
                <th>Ubicación</th>
                <th>Categorías</th>
                <th>Estado</th>
                <th>Fecha Creación</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($negocios as $negocio)
                <tr>
                    <td>{{ $negocio->id_negocio }}</td>
                    <td class="truncate" title="{{ $negocio->nombre_negocio }}">
                        {{ $negocio->nombre_negocio }}
                    </td>
                    <td>{{ $negocio->usuario->name ?? 'Sin usuario' }}</td>
                    <td>{{ $negocio->ubicacion->ciudad ?? 'Sin ubicación' }}</td>
                    <td class="truncate" title="{{ $negocio->categorias->pluck('nombre_categoria')->implode(', ') }}">
                        {{ $negocio->categorias->pluck('nombre_categoria')->implode(', ') }}
                    </td>
                    <td>
                        @if ($negocio->verificado)
                            <span class="status-approved">Aprobado</span>
                        @else
                            <span class="status-pending">Pendiente</span>
                        @endif
                    </td>
                    <td>{{ $negocio->created_at ? $negocio->created_at->format('d/m/Y') : 'Sin fecha' }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <div class="footer">
        <p>Reporte generado automáticamente por LocalConnect</p>
        <p>© {{ date('Y') }} LocalConnect - Todos los derechos reservados</p>
    </div>
</body>

</html>
