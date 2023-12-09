<?php

namespace App\Http\Controllers;

use App\Models\Favorite;
use Illuminate\Http\Request;
use App\Models\Enrollment;
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
            'user_id' => 'required',
            'video_id' => 'required',
        ]);

        Favorite::create($request->all());

        return redirect()->route('favorites.index')->with('success', 'Favorite created successfully');
    }

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

    public function destroy(Favorite $favorite)
    {
        // Delete the specified favorite
        $favorite->delete();

        return redirect()->route('favorites.index')->with('success', 'Favorite deleted successfully');
    }
    //create function get favorite by user id
    public function getFavoriteByUserId($id)
    {
        try {
            $favorites = Favorite::join('users', 'users.UserID', '=', 'favorites.UserID')
                ->join('videos', 'videos.VideoID', '=', 'favorites.VideoID')
                ->where('users.UserID', $id)
                ->get();
    
            $formattedFavorites = [];
    
            foreach ($favorites as $favorite) {
                $formattedFavorites[] = [
                    'id' => $favorite->id,
                    'user' => [
                        'id' => $favorite->UserID,
                        'UserName' => $favorite->UserName,
                        'Role' => $favorite->Role,
                        'image_path' => $favorite->image_path,
                    ],
                    'video' => [
                        'id' => $favorite->VideoID,
                        'VideoTitle' => $favorite->VideoTitle,
                        'VideoURL' => $favorite->VideoURL,
                        'Thumbnail' => $favorite->Thumbnail,
                        'VideoCode' => $favorite->VideoCode,
                        'ChannelName' => $favorite->ChannelName,
                    ],
                ];
            }
    
            return response()->json(['data' => $formattedFavorites], 200);
        } catch (\Exception $e) {
            return response()->json(['error' => 'An error occurred while processing your request.'], 500);
        }
    }
    
    

}
