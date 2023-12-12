<?php

namespace App\Http\Controllers;

use App\Models\Bookmark;
use Illuminate\Http\Request;

class BookmarkController extends Controller
{
    public function index()
    {
        // Retrieve all bookmarks
        $bookmarks = Bookmark::all();

        return view('bookmarks.index', compact('bookmarks'));
    }

    public function create()
    {
        // Show the form to create a new bookmark
        return view('bookmarks.create');
    }

    public function store(Request $request)
    {
        // Validate and store the new favorite
        $request->validate([
            'UserID' => 'required',
            'VideoID' => 'required',
        ]);
    
        // Check if the favorite already exists
        $existingBookmark =Bookmark::where('UserID', $request->UserID)
            ->where('VideoID', $request->VideoID)
            ->first();
    
        if ($existingBookmark) {
            $bookmarks =Bookmark::join('users', 'users.UserID', '=', 'bookmarks.UserID')
            ->join('videos', 'videos.VideoID', '=', 'bookmarks.VideoID')
            ->where('users.UserID', $existingBookmark->UserID)
            ->orderBy('bookmarks.id', 'desc')
            ->limit(1)
            ->get();
    
            $formattedBookmarks = [];

            foreach ($bookmarks as $favorite) {
                $formattedBookmaBookmarks[] = [
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
            return response()->json(['data' => $formattedBookmaBookmarks], 201);

        }
    
        // If the favorite does not exist, create and return the new favorite
        $favorite =Bookmark::create($request->all());
    
        // Fetch the created favorite with additional information
        $bookmarks =Bookmark::join('users', 'users.UserID', '=', 'bookmarks.UserID')
            ->join('videos', 'videos.VideoID', '=', 'bookmarks.VideoID')
            ->where('users.UserID', $favorite->UserID)
            ->orderBy('bookmarks.id', 'desc')
            ->limit(1)
            ->get();
    
            $formattedBookmaBookmarks = [];

            foreach ($bookmarks as $favorite) {
                $formattedBookmaBookmarks[] = [
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
        
    
        return response()->json(['data' => $formattedBookmaBookmarks], 201);
    }
    

    public function edit(Bookmark $bookmark)
    {
        // Show the form to edit the specified bookmark
        return view('bookmarks.edit', compact('bookmark'));
    }

    public function update(Request $request, Bookmark $bookmark)
    {
        // Validate and update the bookmark
        $request->validate([
            'user_id' => 'required',
            'video_id' => 'required',
        ]);

        $bookmark->update($request->all());

        return redirect()->route('bookmarks.index')->with('success', 'Bookmark updated successfully');
    }

    public function destroy($id)
    {
        try {
            $favorite = Bookmark::findOrFail($id);
            $favorite->delete();

            return response()->json(['message' => 'Bookmark deleted successfully'], 200);
        } catch (\Exception $e) {
            return response()->json(['error' => 'An error occurred while deleting the bookmark.'], 500);
        }
    }
    //get bookmark by user id
    public function getBookmarkByUserId($id)
    {
        try {
            $bookmarks = Bookmark::join('users', 'users.UserID', '=', 'bookmarks.UserID')
                ->join('videos', 'videos.VideoID', '=', 'bookmarks.VideoID')
                ->where('users.UserID', $id)
                ->orderBy('bookmarks.created_at', 'desc') // Add this line to order by created date
                ->get();
    
            $formattedBookmarks = [];
    
            foreach ($bookmarks as $bookmark) {
                $formattedBookmarks[] = [
                    'id' => $bookmark->id,
                    'user' => [
                        'user_id' => $bookmark->UserID,
                        'user_name' => $bookmark->UserName,
                        'role' => $bookmark->Role,
                        'image' => $bookmark->image_path,
                        'created_at' => $bookmark->created_at,
                        'updated_at' => $bookmark->updated_at,
                    ],
                    'video' => [
                        'VideoID' => $bookmark->VideoID,
                        'VideoTitle' => $bookmark->VideoTitle,
                        'VideoURL' => $bookmark->VideoURL,
                        'Thumbnail' => $bookmark->Thumbnail,
                        'VideoCode' => $bookmark->VideoCode,
                        'ChannelName' => $bookmark->ChannelName,
                        'created_at' => $bookmark->created_at,
                        'updated_at' => $bookmark->updated_at,
                        'SubjectID' => $bookmark->SubjectID,
                    ],
                ];
            }
    
            return response()->json(['data' => $formattedBookmarks], 200);
        } catch (\Exception $e) {
            return response()->json(['error' => 'An error occurred while processing your request.'], 500);
        }
    }
    
}
