<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reporte Dashboard - LocalConnect</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            font-size: 12px;
            line-height: 1.4;
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
            font-size: 24px;
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

        .page-break {
            page-break-before: always;
        }
    </style>
</head>

<body>
    <div class="header">
        <h1>LocalConnect</h1>
        <p>Reporte del Dashboard Administrativo</p>
        <p>Generado el: {{ $fecha }}</p>
    </div>

    <div class="section">
        <div class="section-title">Métricas Principales</div>
        <div class="metrics-grid">
            <div class="metric-item">
                <span class="metric-value">{{ $totalNegocios }}</span>
                <span class="metric-label">Total Negocios</span>
            </div>
            <div class="metric-item">
                <span class="metric-value">{{ $negociosPendientes }}</span>
                <span class="metric-label">Pendientes</span>
            </div>
            <div class="metric-item">
                <span class="metric-value">{{ $totalUsuarios }}</span>
                <span class="metric-label">Total Usuarios</span>
            </div>
            <div class="metric-item">
                <span class="metric-value">{{ $totalCategorias }}</span>
                <span class="metric-label">Categorías</span>
            </div>
        </div>
    </div>

    <div class="section">
        <div class="section-title">Métricas de Interacción</div>
        <div class="metrics-grid">
            <div class="metric-item">
                <span class="metric-value">{{ $totalVistas }}</span>
                <span class="metric-label">Total Vistas</span>
            </div>
            <div class="metric-item">
                <span class="metric-value">{{ $totalMeGusta }}</span>
                <span class="metric-label">Me Gusta</span>
            </div>
            <div class="metric-item">
                <span class="metric-value">{{ $totalFavoritos }}</span>
                <span class="metric-label">Favoritos</span>
            </div>
            <div class="metric-item">
                <span class="metric-value">{{ $totalValoraciones }}</span>
                <span class="metric-label">Valoraciones</span>
            </div>
        </div>
    </div>

    <div class="section">
        <div class="section-title">Top 5 Categorías</div>
        <table class="table">
            <thead>
                <tr>
                    <th>Posición</th>
                    <th>Categoría</th>
                    <th>Negocios</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($topCategorias as $index => $categoria)
                    <tr>
                        <td>{{ $index + 1 }}</td>
                        <td>{{ $categoria->nombre_categoria }}</td>
                        <td>{{ $categoria->negocios_count }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <div class="section">
        <div class="section-title">Negocios Más Populares</div>
        <table class="table">
            <thead>
                <tr>
                    <th>Negocio</th>
                    <th>Vistas</th>
                    <th>Me Gusta</th>
                    <th>Favoritos</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($negociosPopulares as $negocio)
                    <tr>
                        <td>{{ $negocio->nombre_negocio }}</td>
                        <td>{{ $negocio->vistas_count }}</td>
                        <td>{{ $negocio->me_gusta_count }}</td>
                        <td>{{ $negocio->favoritos_count }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <div class="section">
        <div class="section-title">Últimas Solicitudes Pendientes</div>
        <table class="table">
            <thead>
                <tr>
                    <th>Negocio</th>
                    <th>Usuario</th>
                    <th>Ubicación</th>
                    <th>Fecha</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($ultimasSolicitudes as $negocio)
                    <tr>
                        <td>{{ $negocio->nombre_negocio }}</td>
                        <td>{{ $negocio->usuario->name ?? 'Sin usuario' }}</td>
                        <td>{{ $negocio->ubicacion->ciudad ?? 'Sin ubicación' }}</td>
                        <td>{{ $negocio->created_at ? $negocio->created_at->format('d/m/Y H:i') : 'Sin fecha' }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <div class="footer">
        <p>Reporte generado automáticamente por LocalConnect</p>
        <p>© {{ date('Y') }} LocalConnect - Todos los derechos reservados</p>
    </div>
</body>

</html>
