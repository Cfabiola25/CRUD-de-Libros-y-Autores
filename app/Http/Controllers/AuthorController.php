<?php

namespace App\Http\Controllers;

use App\Models\Author;
use Illuminate\Http\Request;

class AuthorController extends Controller
{
    /**
     * Lista de autores
     */
    public function index()
    {
        $authors = Author::paginate(10);
        return view('authors.index', compact('authors'));
    }

    /**
     * Formulario de creación
     */
    public function create()
    {
        return view('authors.create');
    }

    /**
     * Guardar nuevo autor
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'bio' => 'nullable|string|max:1000',
        ]);

        Author::create($request->all());

        return redirect()->route('authors.index')->with('success', 'Autor creado correctamente.');
    }

    /**
     * Formulario de edición
     */
    public function edit(Author $author)
    {
        return view('authors.edit', compact('author'));
    }

    /**
     * Actualizar autor
     */
    public function update(Request $request, Author $author)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'bio' => 'nullable|string|max:1000',
        ]);

        $author->update($request->all());

        return redirect()->route('authors.index')->with('success', 'Autor actualizado correctamente.');
    }

    /**
     * Eliminar autor
     */
    public function destroy(Author $author)
    {
        $author->delete();

        return redirect()->route('authors.index')->with('success', 'Autor eliminado correctamente.');
    }
}
