<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Media;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

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

        public function stream($id)
        {
            $user = auth()->user();

            if (!$user || !isset($user->membership_plan_id)) {
                return response()->json([
                    'message' => 'User not properly authenticated or no membership'
                ], 400);
            }

            $media = Media::find($id);

            if (!$media || !$media->video_path) {
                return response()->json(['message' => 'Media not found or missing video'], 404);
            }

            $path = Storage::disk('local')->path($media->video_path);

                if (!file_exists($path)) {
                    return response()->json(['message' => 'File not found on disk'], 404);
                }

                $size = filesize($path);
                $length = $size;
                $start = 0;
                $end = $size - 1;

                if (isset($_SERVER['HTTP_RANGE'])) {
                    $range = explode('=', $_SERVER['HTTP_RANGE'])[1];
                    [$start, $end] = array_pad(explode('-', $range), 2, null);
                    $start = intval($start);
                    $end = $end ? intval($end) : $size - 1;
                    $length = $end - $start + 1;

                    header('HTTP/1.1 206 Partial Content');
                } else {
                    header('HTTP/1.1 200 OK');
                }

                header("Content-Type: video/mp4");
                header("Accept-Ranges: bytes");
                header("Content-Length: $length");
                header("Content-Range: bytes $start-$end/$size");

                $fp = fopen($path, 'rb');
                fseek($fp, $start);
                $buffer = 1024 * 8;

                while (!feof($fp) && ($pos = ftell($fp)) <= $end) {
                    if ($pos + $buffer > $end) {
                        $buffer = $end - $pos + 1;
                    }
                    echo fread($fp, $buffer);
                    flush();
                }
                fclose($fp);
                exit;

            
        }

}
