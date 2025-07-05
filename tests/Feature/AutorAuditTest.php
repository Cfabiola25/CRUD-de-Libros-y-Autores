<?php

namespace Tests\Feature;

use App\Models\User;
use App\Models\Author;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Auth;
use Tests\TestCase;

class AutorAuditTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function crea_autor_y_se_registra_auditoria()
    {
        $user = User::factory()->create();
        $this->actingAs($user);
        Auth::login($user);

        $author = new Author([
            'name' => 'Gabriel García Márquez',
            'bio' => 'Escritor colombiano.',
        ]);
        $author->save();

        $this->assertDatabaseHas('audits', [
            'auditable_type' => Author::class,
            'auditable_id' => $author->id,
            'event' => 'created',
            'user_id' => $user->id,
        ]);
    }

    /** @test */
    public function actualiza_autor_y_se_registra_auditoria()
    {
        $user = User::factory()->create();
        $this->actingAs($user);
        Auth::login($user);

        $author = new Author([
            'name' => 'Gabo',
            'bio' => 'Breve bio',
        ]);
        $author->save();

        $author->update([
            'name' => 'García Márquez',
        ]);

        $this->assertDatabaseHas('audits', [
            'auditable_type' => Author::class,
            'auditable_id' => $author->id,
            'event' => 'updated',
            'user_id' => $user->id,
        ]);
    }

    /** @test */
    public function elimina_autor_y_se_registra_auditoria()
    {
        $user = User::factory()->create();
        $this->actingAs($user);
        Auth::login($user);

        $author = new Author([
            'name' => 'Para eliminar',
            'bio' => null,
        ]);
        $author->save();

        $author->delete();

        $this->assertDatabaseHas('audits', [
            'auditable_type' => Author::class,
            'auditable_id' => $author->id,
            'event' => 'deleted',
            'user_id' => $user->id,
        ]);
    }
}
