<?php

namespace App\Models\Negocio;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Carbon\Carbon;

class Promocion extends Model
{
    protected $table = 'promociones';
    protected $primaryKey = 'id_promocion';

    protected $fillable = [
        'id_negocio',
        'titulo',
        'descripcion',
        'descuento',
        'fecha_inicio',
        'fecha_fin',
        'activa'
    ];

    protected $casts = [
        'fecha_inicio' => 'date',
        'fecha_fin' => 'date',
        'activa' => 'boolean',
        'descuento' => 'decimal:2'
    ];

    /**
     * Relación con el negocio
     */
    public function negocio(): BelongsTo
    {
        return $this->belongsTo(Negocio::class, 'id_negocio', 'id_negocio');
    }

    /**
     * Verificar si la promoción está vigente
     */
    public function isVigente(): bool
    {
        $hoy = Carbon::today();
        return $this->activa &&
            $this->fecha_inicio <= $hoy &&
            $this->fecha_fin >= $hoy;
    }

    /**
     * Verificar si la promoción ha expirado
     */
    public function isExpirada(): bool
    {
        return Carbon::today() > $this->fecha_fin;
    }

    /**
     * Verificar si la promoción aún no ha comenzado
     */
    public function isPendiente(): bool
    {
        return Carbon::today() < $this->fecha_inicio;
    }

    /**
     * Obtener el estado de la promoción
     */
    public function getEstadoAttribute(): string
    {
        if (!$this->activa) {
            return 'inactiva';
        }

        if ($this->isExpirada()) {
            return 'expirada';
        }

        if ($this->isPendiente()) {
            return 'pendiente';
        }

        return 'vigente';
    }

    /**
     * Scope para promociones vigentes
     */
    public function scopeVigentes($query)
    {
        $hoy = Carbon::today();
        return $query->where('activa', true)
            ->where('fecha_inicio', '<=', $hoy)
            ->where('fecha_fin', '>=', $hoy);
    }

    /**
     * Scope para promociones activas (no expiradas)
     */
    public function scopeActivas($query)
    {
        $hoy = Carbon::today();
        return $query->where('activa', true)
            ->where('fecha_fin', '>=', $hoy);
    }

    /**
     * Scope para promociones expiradas
     */
    public function scopeExpiradas($query)
    {
        $hoy = Carbon::today();
        return $query->where('fecha_fin', '<', $hoy);
    }
}
