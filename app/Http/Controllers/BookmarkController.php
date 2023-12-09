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
        // Validate and store the new bookmark
        $request->validate([
            'user_id' => 'required',
            'video_id' => 'required',
        ]);

        Bookmark::create($request->all());

        return redirect()->route('bookmarks.index')->with('success', 'Bookmark created successfully');
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

    public function destroy(Bookmark $bookmark)
    {
        // Delete the specified bookmark
        $bookmark->delete();

        return redirect()->route('bookmarks.index')->with('success', 'Bookmark deleted successfully');
    }
    //get bookmark by user id
    public function getBookmarkByUserId($id)
    {
        try {
            $bookmarks = Bookmark::join('users', 'users.UserID', '=', 'bookmarks.UserID')
                ->join('videos', 'videos.VideoID', '=', 'bookmarks.VideoID')
                ->where('users.UserID', $id)
                ->get();
    
            $formattedbookmarks = [];
    
            foreach ($bookmarks as $favorite) {
                $formattedbookmarks[] = [
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
    
            return response()->json(['data' => $formattedbookmarks], 200);
        } catch (\Exception $e) {
            return response()->json(['error' => 'An error occurred while processing your request.'], 500);
        }
    }
}
