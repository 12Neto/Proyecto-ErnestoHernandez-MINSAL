<?php

namespace App\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    protected $fillable = [
        'nombreProyecto',
        'fuenteFondos',
        'montoPlanificado',
        'montoPatrocinado',
        'montoFondosPropios'
    ];
    protected static function boot()
    {
        parent::boot();
        static::creating(function($project){
            $project->user_id = auth()->id();
        });
    }
    public function user(): BelongsTo{
        return $this->BelongsTo(USer::class);
    }
}
