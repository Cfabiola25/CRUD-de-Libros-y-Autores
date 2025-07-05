<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use OwenIt\Auditing\Contracts\Auditable as AuditableContract;
use OwenIt\Auditing\Auditable;

/**
 * Modelo Book
 * 
 * Representa un libro que pertenece a un autor.
 *
 * @property int $id
 * @property string $title
 * @property string|null $description
 * @property int $author_id
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 *
 * Relaciones:
 * - Un libro pertenece a un autor (Author)
 */
class Book extends Model implements AuditableContract
{
    use HasFactory, Auditable;

    /**
     * Atributos que se pueden asignar masivamente.
     *
     * @var array<string>
     */
    protected $fillable = ['title', 'description', 'author_id'];

    /**
     * Relación: Un libro pertenece a un autor.
     */
    public function author()
    {
        return $this->belongsTo(Author::class);
    }

    /**
     * Campos que Audity debe auditar.
     *
     * @var array<string>
     */
    protected $auditInclude = [
        'title',
        'description',
        'author_id',
    ];

    /**
     * Devuelve el ID del usuario autenticado para la auditoría.
     */
    public function resolveUserId()
    {
        return auth()->check() ? auth()->id() : null;
    }

    /**
     * Devuelve la IP desde donde se hizo la acción.
     */
    public function resolveIpAddress()
    {
        return request()->ip();
    }

    /**
     * Devuelve el user agent del navegador.
     */
    public function resolveUserAgent()
    {
        return request()->userAgent();
    }

    /**
     * Devuelve la URL desde donde se hizo el cambio.
     */
    public function resolveUrl()
    {
        return url()->current();
    }
}
