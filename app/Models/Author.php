<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use OwenIt\Auditing\Contracts\Auditable as AuditableContract;
use OwenIt\Auditing\Auditable;

/**
 * Modelo Author
 * 
 * Representa un autor que puede tener muchos libros.
 *
 * @property int $id
 * @property string $name
 * @property string|null $bio
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 *
 * Relaciones:
 * @property \Illuminate\Database\Eloquent\Collection $books
 */
class Author extends Model implements AuditableContract
{
    use HasFactory, Auditable, SoftDeletes;

    /**
     * Atributos que se pueden asignar masivamente.
     *
     * @var array<string>
     */
    protected $fillable = [
        'name',
        'bio',
    ];

    /**
     * Número de resultados por página en paginación.
     *
     * @var int
     */
    protected $perPage = 20;

    /**
     * Relación: Un autor puede tener muchos libros.
     */
    public function books()
    {
        return $this->hasMany(Book::class);
    }

    /**
     * Campos que Audity debe auditar.
     *
     * @var array<string>
     */
    protected $auditInclude = [
        'name',
        'bio',
    ];
}
