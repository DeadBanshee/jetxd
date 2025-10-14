<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Media;
use Illuminate\Http\Request;

class MediaController extends Controller
{
    // GET /api/media
    public function index()
    {
        $media = Media::orderBy('releaseDate', 'desc')->get()->map(function ($item) {
            $item->image_url = url('storage/' . $item->image_path);
            return $item;
        });

        return response()->json($media);
    }

    // GET /api/media/{id}
    public function show($id)
    {
        $media = Media::find($id);

        if (!$media) {
            return response()->json(['message' => 'Media not found'], 404);
        }

        // Adiciona a URL da imagem
        $media->image_url = url('storage/' . $media->image_path);

        return response()->json($media);
    }

    public function search(Request $request)
    {
        $query = $request->query('q');

        // Se não há termo, apenas retorna vazio
        if (!$query) {
            return response()->json([]);
        }

        $results = Media::where('name', 'like', "%{$query}%")
            ->orderBy('releaseDate', 'desc')
            ->take(10)
            ->get()
            ->map(function ($item) {
                $item->image_url = url('storage/' . $item->image_path);
                return $item;
            });

        return response()->json($results);
    }

}
