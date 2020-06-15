<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use \Carbon\Carbon;
use App\Models\News;
use App\Models\Region;
use App\Models\CategoryNews;
use App\Models\Viewer;

class NewsController extends Controller
{
    
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $title = $request->input('title');
        $content = $request->input('content');
        $id_region = $request->input('region');
        $id_category_news = $request->input('category');

        $region = Region::find($id_region);
        $category = CategoryNews::find($id_category_news);
        
        $affect = DB::table('news')
                ->where('title',$title)
                ->get()->first();
        if (isset($affect)) {
            $response = "judul telah digunakan";
        } else {
            $news = new News();
            $news->title = $title;
            $news->content = $content;
            $news->created_at = Carbon::now();
            $news->viewer = 0;
            $news->region()->associate($region);
            $news->category_news()->associate($category);
            $news->save();

            $response ="berhasil menyimpan";
        }
        return response()->json([
            'status' => $response
        ]);
    }

    public function getbytitle(Request $request)
    {
        $title = $request->input('title');
        $news = DB::table('news')
                ->where('title',$title)
                ->get()->first();
        // $count = $news->viewer;

        if (isset($news)) {
            $updated = DB::table('news')
                ->where('id_news',$news->ID_NEWS)
                ->increment('viewer',1);
            $response = "berhasil";
        } else {
            $response = "judul tidak ditemukan";
        }
        return response()->json([
            'status' => $response,
            'news' => $news
        ]);
    }

    public function getbyid(Request $request){
        $id = $request->id;
        $news = News::find($id);
        if (isset($news)) {
            $updated = DB::table('news')
                ->where('id_news',$news->ID_NEWS)
                ->increment('viewer',1);
            $response = "berhasil";
        } else {
            $response = "judul tidak ditemukan";
        }
        return response()->json([
            'status' => $response,
            'news' => $news
        ]);
    }

    public function gettrending(){
        $category = 'covid';
        $trending = DB::table('news')
                ->join('category_news','news.id_category_news','=','category_news.id_category_news')
                ->where('category_news.category',$category)
                ->take(5)
                ->get();
        return response()->json([
            'status' => 'success',
            'news' => $trending
        ]);
    }

    public function getpopularnews(){
        $popular_news = DB::table('news')
            ->orderBy('viewer','desc')
            ->take(5)
            ->get();
        return response()->json([
            'status' => 'success',
            'news' => $popular_news
        ]);
    }

    public function getlatestnews(){
        $latest_news = DB::table('news')
            ->orderBy('created_at','desc')
            ->take(5)
            ->get();
        return response()->json([
            'status' => 'success',
            'news' => $latest_news
        ]);
    }

    public function getforuser(Request $request){
        $id_user = $request->id_user;
        $latest_news = DB::table('news')
            ->join('region','news.id_region','=','region.id_region')
            ->join('end_user','region.id_region','=','end_user.id_region')
            ->orderBy('created_at','desc')
            ->where('end_user.id_user',$id_user)
            ->take(5)
            ->get();
        return response()->json([
            'status' => 'success',
            'news' => $latest_news
        ]);
    }
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\News  $news
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $id = $request->id;
        $content = $request->content;
        $title = $request->title;

        $news = DB::table('news')
                ->where('title',$title)
                ->get()->first();

        if (!isset($news)) {
            DB::table('news')
                ->where('id_news',$id)
                ->update([
                    'title'=>$title,
                    'content'=>$content,
                    'updated_at'=>Carbon::now()
                ]);
            $message = "berhasil diupdate";
        } else {
            $message = "judul telah digunakan";
        }
        return response()->json([
            'status' => $message
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\News  $news
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $id = $request->id;
        $news = News::find($id);
        if (isset($news)) {
            $news->delete();
            $message = "berhasil";    
        } else {
            $message = "category tidak ditemukan";
        }
        return response()->json([
            'status' => $message
        ]);
    }
}
