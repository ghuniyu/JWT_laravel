<?php

namespace App\Http\Controllers\API;

use App\Http\Traits\API;
use App\Photo;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Gate;
use JWTAuth;

class PhotoController extends Controller
{

    /**
     * PhotoController constructor.
     */
    public function __construct()
    {
        $this->middleware('jwt.auth');
    }

    public function index()
    {
        $photos = Photo::with('likes')->get();
        $respon = [
            'error' => false,
            'message' => "success",
            'data' => compact('photos')
        ];
        return response()->json($respon);
    }

    public function like($id)
    {
        $photo = Photo::find($id);
        $user = JWTAuth::parseToken()->authenticate();
        if (Gate::allows('like-photo')) {
            if(!$user->isLiked($id)){
                $user->likes()->attach($photo);
            }
            $respon = [
                'error' => false,
                'message' => "liked",
                'data' => compact('photo')
            ];
            return response()->json($respon);
        }else{
            return response()->json(['error' => 'not authorize'],403);
        }
    }

    public function store(Request $request)
    {
        $user = JWTAuth::parseToken()->authenticate();
        if (Gate::allows('upload-photo')) {
            $filename = uniqid() . '-' . uniqid() . '.' . $request->photo->
                getClientOriginalExtension();
            $path = $request->photo->storeAs('images', $filename);

            $photo = $user->photos()->create([
                'path' => $path
            ]);

            $respon = [
                'error' => false,
                'message' => "uploaded",
                'data' => compact('photo')
            ];
            return response()->json($respon);
        }else{
            return response()->json(['error' => 'not authorize'],403);
        }
    }

    public function file($id)
    {
        $photo = Photo::find($id);
        $path = storage_path('app/' . $photo->path);
        return response()->file($path);
    }
}
