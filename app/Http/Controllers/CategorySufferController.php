<?php

namespace App\Http\Controllers;

use App\Models\CategorySuffer;
use Illuminate\Http\Request;

class CategorySufferController extends Controller
{
    
    public function getAll(){
        $categorys = DB::table('category_suffer')
                    ->get();
        return response()->json([
            'status' => 'success',
            'category' => $categorys
        ]);
    }

    public function getbyid(Request $request){
        $category = App\Models\CategorySuffer::find($request->id);
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
        $category = DB::table('category_suffer')
                    ->where('category_suffer',$categoryName)
                    ->get()->first();
        return $category;
    }

    public function store(Request $request)
    {
        
        $categoryName = $request->name;
        $affect = DB::table('category_suffer')
                ->where('category_suffer',$categoryName)
                ->get()->count();
        if ($affect > 0) {
            $message = "category sudah ada";
        } else {
            $category = new CategorySuffer();
            $category->catecategory_suffergory = $categoryName;
            $category->save();

            $message = "berhasil";
        }
        return response()->json([
            'status' => $message,
            'category' => $categoryNews
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\CategorySuffer  $categorySuffer
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $id = $request->id;
        $name = $request->name;

        $category = getcategorybyname($name);
        if (isset($category)) {
            $category = App\Models\CategorySuffer::find($request->id);
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
     * @param  \App\Models\CategorySuffer  $categorySuffer
     * @return \Illuminate\Http\Response
     */
    public function destroy(CategorySuffer $categorySuffer)
    {
        $id = $request->id;
        $category = App\Models\CategorySuffer::find($request->id);
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
