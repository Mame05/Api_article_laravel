<?php

namespace App\Http\Controllers;

use App\Models\Article;
use Illuminate\Http\Request;

class ArticleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return Article::all();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'body' => 'required|string',
        ]);

        $article = Article::create($request->all());
        return response()->json($article, 201); // Répondre avec le code 201 pour indiquer que la ressource a été créée
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $article = Article::find($id);
        if (!$article) {
            return response()->json(['message' => 'Article non trouvé'], 404); // Correction du message d'erreur
        }
        return response()->json($article);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $article = Article::find($id);
        if (!$article) {
            return response()->json(['message' => 'Article non trouvé'], 404); // Correction du message d'erreur
        }

        $request->validate([
            'title' => 'required|string|max:255', // Correction de 'require' en 'required'
            'body' => 'required|string',
        ]);

        $article->update($request->all());
        return response()->json($article);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $article = Article::find($id);
        if (!$article) {
            return response()->json(['message' => 'Article non trouvé'], 404); // Correction du message d'erreur
        }

        $article->delete();
        return response()->json(['message' => 'Article supprimé avec succès']); // Correction du message de succès
    }
}
