<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Estadísticas de {{ $negocio->nombre_negocio }} - PDF</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            font-size: 12px;
            color: #333;
            margin: 0;
            padding: 20px;
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

        .section {
            margin-bottom: 25px;
        }

        .section-title {
            background-color: #f3f4f6;
            padding: 8px 12px;
            font-weight: bold;
            font-size: 14px;
            color: #374151;
            border-left: 4px solid #3b82f6;
            margin-bottom: 15px;
        }

        .metrics-grid {
            display: table;
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 15px;
        }

        .metric-item {
            display: table-cell;
            width: 25%;
            text-align: center;
            padding: 10px;
            border: 1px solid #e5e7eb;
            background-color: #f9fafb;
        }

        .metric-value {
            font-size: 18px;
            font-weight: bold;
            color: #3b82f6;
            display: block;
        }

        .metric-label {
            font-size: 11px;
            color: #6b7280;
            margin-top: 5px;
        }

        .table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 15px;
        }

        .table th {
            background-color: #f3f4f6;
            padding: 8px 12px;
            text-align: left;
            font-weight: bold;
            border: 1px solid #d1d5db;
            font-size: 11px;
        }

        .table td {
            padding: 8px 12px;
            border: 1px solid #e5e7eb;
            font-size: 11px;
        }

        .table tr:nth-child(even) {
            background-color: #f9fafb;
        }

        .footer {
            margin-top: 30px;
            text-align: center;
            font-size: 10px;
            color: #6b7280;
            border-top: 1px solid #e5e7eb;
            padding-top: 10px;
        }
    </style>
</head>

<body>
    <div class="header">
        <h1>Estadísticas de {{ $negocio->nombre_negocio }}</h1>
        <p>Reporte generado el: {{ $fecha }}</p>
    </div>

    <div class="section">
        <div class="section-title">Métricas principales</div>
        <div class="metrics-grid">
            <div class="metric-item">
                <span class="metric-value">{{ $estadisticas['vistas_busqueda'] }}</span>
                <span class="metric-label">Vistas en búsqueda</span>
            </div>
            <div class="metric-item">
                <span class="metric-value">{{ $estadisticas['vistas_detalle'] }}</span>
                <span class="metric-label">Vistas de detalle</span>
            </div>
            <div class="metric-item">
                <span class="metric-value">{{ $estadisticas['me_gusta'] }}</span>
                <span class="metric-label">Me gusta</span>
            </div>
            <div class="metric-item">
                <span class="metric-value">{{ $estadisticas['favoritos'] }}</span>
                <span class="metric-label">Favoritos</span>
            </div>
        </div>
    </div>

    <div class="section">
        <div class="section-title">Evolución de interacciones (últimos 14 días)</div>
        <table class="table">
            <thead>
                <tr>
                    <th>Día</th>
                    <th>Vistas en búsqueda</th>
                    <th>Vistas de detalle</th>
                    <th>Me gusta</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($labels as $i => $dia)
                    <tr>
                        <td>{{ $dia }}</td>
                        <td>{{ $vistasBusqueda[$i] ?? 0 }}</td>
                        <td>{{ $vistas[$i] ?? 0 }}</td>
                        <td>{{ $meGusta[$i] ?? 0 }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <div class="section">
        <div class="section-title">Resumen del negocio</div>
        <table class="table">
            <tr>
                <th>Nombre</th>
                <td>{{ $negocio->nombre_negocio }}</td>
            </tr>
            <tr>
                <th>Descripción</th>
                <td>{{ $negocio->descripcion }}</td>
            </tr>
            <tr>
                <th>Ubicación</th>
                <td>{{ $negocio->ubicacion->direccion ?? '-' }}, {{ $negocio->ubicacion->distrito ?? '' }}</td>
            </tr>
            <tr>
                <th>Categorías</th>
                <td>
                    @foreach ($negocio->categorias as $cat)
                        {{ $cat->nombre_categoria }}@if (!$loop->last)
                            ,
                        @endif
                    @endforeach
                </td>
            </tr>
            <tr>
                <th>Características</th>
                <td>
                    @foreach ($negocio->caracteristicas as $car)
                        {{ $car->nombre }}@if (!$loop->last)
                            ,
                        @endif
                    @endforeach
                </td>
            </tr>
        </table>
    </div>

    <div class="footer">
        <p>Reporte generado automáticamente por LocalConnect</p>
        <p>© {{ date('Y') }} LocalConnect - Todos los derechos reservados</p>
    </div>
</body>

</html>
