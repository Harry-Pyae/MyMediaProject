<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\ActionLog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TrendPostController extends Controller
{
    // trend post page
    public function index(){
        $action_data = ActionLog::select('action_logs.*', 'posts.*', DB::raw('count(action_logs.post_id) as action_count'))
                    ->leftJoin('posts', 'posts.post_id', 'action_logs.post_id')
                    ->groupBy('action_logs.post_id')
                    ->get();
                    // ->paginate(6);
        return view('admin.trend_post.index', compact('action_data'));
    }

    // trend post details
    public function details($id){
        $post = Post::where('post_id', $id)->first();
        return view('admin.trend_post.details', compact('post'));
    }
}
