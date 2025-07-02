<table>
    <tr>
        <td colspan="2"
            style="font-size:18px; font-weight:bold; background:#f3f4f6; border:1px solid #e5e7eb; text-align:center;">
            Estadísticas de {{ $negocio->nombre_negocio }}
        </td>
    </tr>
    <tr>
        <th style="background:#e0e7ff; border:1px solid #a5b4fc; text-align:left; padding:6px;">Métrica</th>
        <th style="background:#e0e7ff; border:1px solid #a5b4fc; text-align:left; padding:6px;">Valor</th>
    </tr>
    <tr>
        <td style="border:1px solid #e5e7eb; padding:6px;">Nombre</td>
        <td style="border:1px solid #e5e7eb; padding:6px;">{{ $negocio->nombre_negocio }}</td>
    </tr>
    <tr>
        <td style="border:1px solid #e5e7eb; padding:6px;">Vistas en búsqueda</td>
        <td style="border:1px solid #e5e7eb; padding:6px;">{{ $estadisticas['vistas_busqueda'] ?? 0 }}</td>
    </tr>
    <tr>
        <td style="border:1px solid #e5e7eb; padding:6px;">Vistas de detalle</td>
        <td style="border:1px solid #e5e7eb; padding:6px;">{{ $estadisticas['vistas_detalle'] ?? 0 }}</td>
    </tr>
    <tr>
        <td style="border:1px solid #e5e7eb; padding:6px;">Me gusta</td>
        <td style="border:1px solid #e5e7eb; padding:6px;">{{ $estadisticas['me_gusta'] ?? 0 }}</td>
    </tr>
    <tr>
        <td style="border:1px solid #e5e7eb; padding:6px;">Favoritos</td>
        <td style="border:1px solid #e5e7eb; padding:6px;">{{ $estadisticas['favoritos'] ?? 0 }}</td>
    </tr>
    <tr>
        <td style="border:1px solid #e5e7eb; padding:6px;">Promedio Valoración</td>
        <td style="border:1px solid #e5e7eb; padding:6px;">
            {{ isset($estadisticas['promedio_valoracion']) ? number_format($estadisticas['promedio_valoracion'], 2) : (isset($negocio->valoraciones) ? number_format($negocio->valoraciones->avg('calificacion'), 2) : 'N/A') }}
        </td>
    </tr>
    <tr>
        <td style="border:1px solid #e5e7eb; padding:6px;">Total Valoraciones</td>
        <td style="border:1px solid #e5e7eb; padding:6px;">
            {{ $estadisticas['total_valoraciones'] ?? ($negocio->valoraciones->count() ?? 0) }}</td>
    </tr>
    <!-- Puedes agregar más métricas aquí -->
</table>

<br>

<table>
    <tr>
        <td colspan="4"
            style="font-size:16px; font-weight:bold; background:#f3f4f6; border:1px solid #e5e7eb; text-align:center;">
            Evolución diaria (últimos 14 días)
        </td>
    </tr>
    <tr>
        <th style="background:#e0e7ff; border:1px solid #a5b4fc; padding:6px;">Fecha</th>
        <th style="background:#e0e7ff; border:1px solid #a5b4fc; padding:6px;">Vistas Detalle</th>
        <th style="background:#e0e7ff; border:1px solid #a5b4fc; padding:6px;">Vistas Búsqueda</th>
        <th style="background:#e0e7ff; border:1px solid #a5b4fc; padding:6px;">Me gusta</th>
    </tr>
    @foreach ($estadisticas['labels'] ?? [] as $i => $fecha)
        <tr>
            <td style="border:1px solid #e5e7eb; padding:6px;">{{ $fecha }}</td>
            <td style="border:1px solid #e5e7eb; padding:6px;">{{ $estadisticas['vistas'][$i] ?? 0 }}</td>
            <td style="border:1px solid #e5e7eb; padding:6px;">{{ $estadisticas['vistasBusqueda'][$i] ?? 0 }}</td>
            <td style="border:1px solid #e5e7eb; padding:6px;">{{ $estadisticas['meGusta'][$i] ?? 0 }}</td>
        </tr>
    @endforeach
</table>
