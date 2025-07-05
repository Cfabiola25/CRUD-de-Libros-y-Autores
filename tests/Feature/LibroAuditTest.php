<?php

namespace Tests\Feature;

use App\Models\User;
use App\Models\Book;
use App\Models\Author;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Auth;
use Tests\TestCase;

class LibroAuditTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function crea_libro_y_se_registra_auditoria()
    {
        $user = User::factory()->create();
        $this->actingAs($user);
        Auth::login($user);

        $author = Author::factory()->create();

        $book = new Book([
            'title' => 'Mi Libro Nuevo',
            'description' => 'Probando auditoría',
            'author_id' => $author->id,
        ]);
        $book->save();

        $this->assertDatabaseHas('audits', [
            'auditable_type' => Book::class,
            'auditable_id' => $book->id,
            'event' => 'created',
            'user_id' => $user->id,
        ]);
    }

    /** @test */
    public function actualiza_libro_y_se_registra_auditoria()
    {
        $user = User::factory()->create();
        $this->actingAs($user);
        Auth::login($user);

        $author = Author::factory()->create();

        $book = new Book([
            'title' => 'Original',
            'description' => 'Desc',
            'author_id' => $author->id,
        ]);
        $book->save();

        $book->update([
            'title' => 'Modificado',
        ]);

        $this->assertDatabaseHas('audits', [
            'auditable_type' => Book::class,
            'auditable_id' => $book->id,
            'event' => 'updated',
            'user_id' => $user->id,
        ]);
    }

    /** @test */
    public function elimina_libro_y_se_registra_auditoria()
    {
        $user = User::factory()->create();
        $this->actingAs($user);
        Auth::login($user);

        $author = Author::factory()->create();

        $book = new Book([
            'title' => 'Para eliminar',
            'description' => 'Desc',
            'author_id' => $author->id,
        ]);
        $book->save();

        $book->delete();

        $this->assertDatabaseHas('audits', [
            'auditable_type' => Book::class,
            'auditable_id' => $book->id,
            'event' => 'deleted',
            'user_id' => $user->id,
        ]);
    }
}
