<?php

namespace App\Http\Controllers;

use App\Models\CategoryNews;
use Illuminate\Http\Request;
use DB;

class CategoryNewsController extends Controller
{
    public function getAll(){
        $categorys = DB::table('category_news')
                    ->get();
        return response()->json([
            'status' => 'success',
            'category' => $categorys
        ]);
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $categoryName = $request->name;
        $affect = DB::table('category_news')
                ->where('category',$categoryName)
                ->get()->count();
        if ($affect > 0) {
            $reponse = "category sudah ada";
        } else {
            $categoryNews = new CategoryNews();
            $categoryNews->category = $categoryName;
            $categoryNews->save();

            return response()->json([
                'status' => 'success',
                'category' => $categoryNews
            ]);
        }
    }

    public function getbyid(Request $request){
        $category = App\Models\CategoryNews::find($request->id);
        if (isset($category)) {
            return response()->json([
                'status' => 'success',
                'category' => $category
            ]);
        } else {
            return response()->json([
                'status' => 'failed',
                'Message' => 'category tidak ditemukan'
            ]);
        }
    }

    public function getbyname(Request $request){
        $categoryName = $request->name;
        $category = getcategorybyname($categoryName);
        if (isset($category)) {
            return response()->json([
                'status' => 'success',
                'category' => $category
            ]);
        } else {
            return response()->json([
                'status' => 'failed',
                'Message' => 'category tidak ditemukan'
            ]);
        }
    }

    public function getcategorybyname($name){
        $category = DB::table('category_news')
                    ->where('category',$categoryName)
                    ->get()->first();
        return $category;
    }
    

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\CategoryNews  $categoryNews
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        //
        $id = $request->id;
        $name = $request->name;

        $category = getcategorybyname($name);
        if (isset($category)) {
            $category = App\Models\CategoryNews::find($request->id);
            if (!isset($category)) {
                $category->category = $name;
                $category->save();

                return response()->json([
                    'status' => 'success',
                    'category' => $category
                ]);

            } else {
                return response()->json([
                    'status' => 'failed',
                    'Message' => 'category tidak ditemukan'
                ]);
            }
        } else {
            return response()->json([
                'status' => 'failed',
                'Message' => 'category sudah digunakan'
            ]);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\CategoryNews  $categoryNews
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        //
        $id = $request->id;
        $category = App\Models\CategoryNews::find($request->id);
        if (isset($category)) {
            $category->delete();
            $message = "berhasil";    
        } else {
            $message = "category tidak ditemukan";
        }
        return response()->json([
            'status' => $message
        ]);
    }
}
