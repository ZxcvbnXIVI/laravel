<?php

namespace App\Http\Controllers;

use App\Models\Video;
use App\Http\Resources\VideoResource;
use Illuminate\Http\Request;
use GuzzleHttp\Client;
use Symfony\Component\DomCrawler\Crawler;

class VideoController extends Controller
{
    public function index()
{
    $videos = Video::with(['subjects'])->get();
    return VideoResource::collection($videos);
}
public function fetchVideos(Request $request)
{
    $playlistUrl = $request->input('playlistUrl');

    if (!preg_match('/^https:\/\/www\.youtube\.com\/playlist\?list=[a-zA-Z0-9_-]+$/', $playlistUrl)) {
        return response()->json(['error' => 'Invalid YouTube playlist URL'], 400);
    }

    $client = new Client();

    try {
        $response = $client->get($playlistUrl);

        $html = $response->getBody()->getContents();

        $crawler = new Crawler($html);

        $videos = $crawler->filter('.style-scope.ytd-playlist-video-renderer')->each(function ($node) {
            $title = $node->filter('.style-scope.ytd-playlist-video-renderer')->text();
            $url = 'https://www.youtube.com' . $node->filter('a')->attr('href');

            return [
                'title' => $title,
                'url' => $url,
            ];
        });

        // นำข้อมูลที่ดึงได้มาใช้งาน และบันทึกลงในฐานข้อมูลตามตาราง videos

        return response()->json($videos);
    } catch (\Exception $e) {
        // Handle GuzzleHttp exceptions or other errors
        return response()->json(['error' => 'Error fetching videos'], 500);
    }
}
    public function show($id)
    {
        $video = Video::with(['subjects'])->findOrFail($id);
        return new VideoResource($video);
    }
    public function store(Request $request)
{
    $request->validate([
        'SubjectID' => 'required',
        'VideoTitle' => 'required',
        'VideoURL' => 'required',
        'Thumbnail' => 'required',
        'VideoCode'=> 'required',
        'ChannelName' => 'required',
        
    ]);

    $video = Video::create([
        'SubjectID' => $request->input('SubjectID'),
        'VideoTitle' => $request->input('VideoTitle'),
        'VideoURL' => $request->input('VideoURL'),
        'Thumbnail' => $request->input('Thumbnail'),
        'VideoCode'=> $request->input('VideoCode'),
        'ChannelName' => $request->input('ChannelName'),

    ]);

    $video->load(['subjects', 'categories']); 

    return new VideoResource($video);
}
public function update(Request $request, $id)
{
    $request->validate([
        'SubjectID' => 'required',
        'VideoTitle' => 'required',
        'VideoURL' => 'required',
        'Thumbnail' => 'required',
        'VideoCode' => 'required',
        'ChannelName' => 'required',
    ]);

    $video = Video::findOrFail($id);

    $video->update([
        'SubjectID' => $request->input('SubjectID'),
        'VideoTitle' => $request->input('VideoTitle'),
        'VideoURL' => $request->input('VideoURL'),
        'Thumbnail' => $request->input('Thumbnail'),
        'VideoCode' => $request->input('VideoCode'),
        'ChannelName' => $request->input('ChannelName'),
    ]);

    $video->load(['subjects', 'categories']); 

    return new VideoResource($video);
}
public function destroy($id)
{
    $video = Video::findOrFail($id);
    $video->delete();

    return response()->json(['message' => 'Video deleted successfully']);
}   
}
