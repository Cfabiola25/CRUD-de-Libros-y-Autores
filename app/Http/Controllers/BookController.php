<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Author;
use Illuminate\Http\Request;

class BookController extends Controller
{
    /**
     * Mostrar lista de libros con su autor
     */
    public function index()
    {
        $books = Book::with('author')->paginate(10);
        return view('books.index', compact('books'));
    }

    /**
     * Formulario para crear libro
     */
    public function create()
    {
        $authors = Author::all();
        return view('books.create', compact('authors'));
    }

    /**
     * Guardar libro nuevo
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string|max:1000',
            'author_id' => 'required|exists:authors,id',
        ]);

        try {
            Book::create([
                'title' => $request->title,
                'description' => $request->description,
                'author_id' => $request->author_id,
            ]);

            return redirect()->route('books.index')
                ->with('success', 'Libro creado correctamente.');
        } catch (\Exception $e) {
            return back()->withErrors('Error al crear el libro: ' . $e->getMessage())->withInput();
        }
    }

    /**
     * Formulario para editar libro
     */
    public function edit(Book $book)
    {
        $authors = Author::all();
        return view('books.edit', compact('book', 'authors'));
    }

    /**
     * Guardar cambios del libro editado
     */
    public function update(Request $request, Book $book)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string|max:1000',
            'author_id' => 'required|exists:authors,id',
        ]);

        try {
            $book->update([
                'title' => $request->title,
                'description' => $request->description,
                'author_id' => $request->author_id,
            ]);

            return redirect()->route('books.index')
                ->with('success', 'Libro actualizado correctamente.');
        } catch (\Exception $e) {
            return back()->withErrors('Error al actualizar: ' . $e->getMessage())->withInput();
        }
    }

    /**
     * Eliminar libro
     */
    public function destroy(Book $book)
    {
        try {
            $book->delete();

            return redirect()->route('books.index')
                ->with('success', 'Libro eliminado correctamente.');
        } catch (\Exception $e) {
            return back()->withErrors('Error al eliminar: ' . $e->getMessage());
        }
    }
}
