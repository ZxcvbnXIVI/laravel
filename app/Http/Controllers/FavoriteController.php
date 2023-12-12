<?php

namespace App\Http\Controllers;

use App\Models\Favorite;
use Illuminate\Http\Request;
use App\Models\Enrollment;
use Illuminate\Cache\RateLimiting\Limit;

class FavoriteController extends Controller
{
    public function index()
    {
        // Retrieve all favorites
        $favorites = Favorite::all();

        return view('favorites.index', compact('favorites'));
    }

    public function create()
    {
        // Show the form to create a new favorite
        return view('favorites.create');
    }
    public function store(Request $request)
    {
        // Validate and store the new favorite
        $request->validate([
            'UserID' => 'required',
            'VideoID' => 'required',
        ]);
    
        // Check if the favorite already exists
        $existingFavorite = Favorite::where('UserID', $request->UserID)
            ->where('VideoID', $request->VideoID)
            ->first();
    
        if ($existingFavorite) {
            $favorites = Favorite::join('users', 'users.UserID', '=', 'favorites.UserID')
            ->join('videos', 'videos.VideoID', '=', 'favorites.VideoID')
            ->where('users.UserID', $existingFavorite->UserID)
            ->orderBy('favorites.id', 'desc')
            ->limit(1)
            ->get();
    
            $formattedFavorites = [];

            foreach ($favorites as $favorite) {
                $formattedFavorites[] = [
                    'id' => $favorite->id,
                    'user' => [
                        'user_id' => $favorite->UserID,
                        'user_name' => $favorite->UserName,
                        'role' => $favorite->Role,
                        'image' => $favorite->image_path,
                        'created_at' => $favorite->created_at,
                    ],
                    'video' => [
                        'VideoID' => $favorite->VideoID,
                        'VideoTitle' => $favorite->VideoTitle,
                        'VideoURL' => $favorite->VideoURL,
                        'Thumbnail' => $favorite->Thumbnail,
                        'VideoCode' => $favorite->VideoCode,
                        'SubjectID' => $favorite->SubjectID,
                        'ChannelName' => $favorite->ChannelName,
                        'created_at' => $favorite->created_at,
                        'updated_at' => $favorite->updated_at,
                    ],
                ];
            }
            return response()->json(['data' => $formattedFavorites], 201);

        }
    
        // If the favorite does not exist, create and return the new favorite
        $favorite = Favorite::create($request->all());
    
        // Fetch the created favorite with additional information
        $favorites = Favorite::join('users', 'users.UserID', '=', 'favorites.UserID')
            ->join('videos', 'videos.VideoID', '=', 'favorites.VideoID')
            ->where('users.UserID', $favorite->UserID)
            ->orderBy('favorites.id', 'desc')
            ->limit(1)
            ->get();
    
            $formattedFavorites = [];

            foreach ($favorites as $favorite) {
                $formattedFavorites[] = [
                    'id' => $favorite->id,
                    'user' => [
                        'user_id' => $favorite->UserID,
                        'user_name' => $favorite->UserName,
                        'role' => $favorite->Role,
                        'image' => $favorite->image_path,
                        'created_at' => $favorite->created_at,
                    ],
                    'video' => [
                        'VideoID' => $favorite->VideoID,
                        'VideoTitle' => $favorite->VideoTitle,
                        'VideoURL' => $favorite->VideoURL,
                        'Thumbnail' => $favorite->Thumbnail,
                        'VideoCode' => $favorite->VideoCode,
                        'SubjectID' => $favorite->SubjectID,
                        'ChannelName' => $favorite->ChannelName,
                        'created_at' => $favorite->created_at,
                        'updated_at' => $favorite->updated_at,
                    ],
                ];
            }
        
    
        return response()->json(['data' => $formattedFavorites], 201);
    }
    

    // public function store(Request $request)
    // {
    //     // Validate and store the new favorite
    //     $request->validate([
    //         'UserID' => 'required|integer',
    //         'VideoID' => 'required|integer',
    //     ]);
    
    //     $favorite = Favorite::create($request->all());
    
    //     // Fetch the associated User and Video details
    //     $user = $favorite->user;
    //     $video = $favorite->vdoDetail;
    
    //     // Format the response data
    //     $formattedFavorites = [
    //         'id' => $favorite->id,
    //         'user' => [
    //             'user_id' => $favorite->UserID,
    //             'user_name' => $favorite->UserName,
    //             'role' => $favorite->Role,
    //             'image' => $favorite->image_path,
    //             'created_at' => $favorite->created_at,
    //         ],
    //         'video' => [
    //             'VideoID' => $favorite->VideoID,
    //             'VideoTitle' => $favorite->VideoTitle,
    //             'VideoURL' => $favorite->VideoURL,
    //             'Thumbnail' => $favorite->Thumbnail,
    //             'VideoCode' => $favorite->VideoCode,
    //             'SubjectID' => $favorite->SubjectID,
    //             'ChannelName' => $favorite->ChannelName,
    //             'created_at' => $favorite->created_at,
    //             'updated_at' => $favorite->updated_at,
    //         ],
    //     ];
    
    //     return response()->json(['data' => [$formattedFavorites]], 201);
    // }
    
    

    public function edit(Favorite $favorite)
    {
        // Show the form to edit the specified favorite
        return view('favorites.edit', compact('favorite'));
    }

    public function update(Request $request, Favorite $favorite)
    {
        // Validate and update the favorite
        $request->validate([
            'user_id' => 'required',
            'video_id' => 'required',
        ]);

        $favorite->update($request->all());

        return redirect()->route('favorites.index')->with('success', 'Favorite updated successfully');
    }

    public function destroy($id)
    {
        try {
            $favorite = Favorite::findOrFail($id);
            $favorite->delete();

            return response()->json(['message' => 'Favorite deleted successfully'], 200);
        } catch (\Exception $e) {
            return response()->json(['error' => 'An error occurred while deleting the favorite.'], 500);
        }
    }
    //create function get favorite by user id
    public function getFavoriteByUserId($id)
{
    try {
        $favorites = Favorite::join('users', 'users.UserID', '=', 'favorites.UserID')
            ->join('videos', 'videos.VideoID', '=', 'favorites.VideoID')
            ->where('users.UserID', $id)
            ->orderBy('favorites.created_at', 'desc') // Add this line to order by created date
            ->get();

        $formattedFavorites = [];

        foreach ($favorites as $favorite) {
            $formattedFavorites[] = [
                'id' => $favorite->id,
                'user' => [
                    'user_id' => $favorite->UserID,
                    'user_name' => $favorite->UserName,
                    'role' => $favorite->Role,
                    'image' => $favorite->image_path,
                    'created_at' => $favorite->created_at,
                ],
                'video' => [
                    'VideoID' => $favorite->VideoID,
                    'VideoTitle' => $favorite->VideoTitle,
                    'VideoURL' => $favorite->VideoURL,
                    'Thumbnail' => $favorite->Thumbnail,
                    'VideoCode' => $favorite->VideoCode,
                    'SubjectID' => $favorite->SubjectID,
                    'ChannelName' => $favorite->ChannelName,
                    'created_at' => $favorite->created_at,
                    'updated_at' => $favorite->updated_at,
                ],
            ];
        }

        return response()->json(['data' => $formattedFavorites], 200);
    } catch (\Exception $e) {
        return response()->json(['error' => 'An error occurred while processing your request.'], 500);
    }
}

    
    

}
