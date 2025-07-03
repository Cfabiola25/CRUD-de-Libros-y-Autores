<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class AuthorBook
 *
 * @property $id
 * @property $author_id
 * @property $book_id
 * @property $created_at
 * @property $updated_at
 *
 * @package App
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
class AuthorBook extends Model
{
    

    protected $perPage = 20;

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['author_id', 'book_id'];



}
