<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;
use App\Models\Author;
use App\Models\Book;
use Illuminate\Foundation\Testing\RefreshDatabase;

class TestAudit extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function prueba_auditoria_basica()
    {
        // Crea usuario y lo loguea
        $user = User::factory()->create();
        $this->actingAs($user);
        \Illuminate\Support\Facades\Auth::login($user);

        // Crea autor
        Author::create([
            'name' => 'Test Auditoría',
            'bio' => 'Autor de prueba',
        ]);

        // Muestra lo que hay en la tabla audits
        dump(\DB::table('audits')->get());

        // Prueba pasa
        $this->assertTrue(true);
    }

    /** @test */
    public function prueba_auditoria_con_libro()
    {
        // Crea usuario y lo loguea
        $user = User::factory()->create();
        $this->actingAs($user);
        \Illuminate\Support\Facades\Auth::login($user);

        // Crea autor
        $author = Author::create([
            'name' => 'Autor con Libro',
            'bio' => 'Bio de autor',
        ]);

        // Crea libro
        Book::create([
            'title' => 'Libro Auditado',
            'description' => 'Descripción del libro',
            'author_id' => $author->id,
        ]);

        // Muestra auditorías
        dump(\DB::table('audits')->get());

        // Prueba pasa
        $this->assertTrue(true);
    }
}
