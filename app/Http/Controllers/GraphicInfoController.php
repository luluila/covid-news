<?php

namespace App\Http\Controllers;

use App\Models\GraphicInfo;
use App\Models\Region;
use App\Models\CategorySuffer;
use Illuminate\Http\Request;
use DB;
use \Carbon\Carbon;



class GraphicInfoController extends Controller
{

    public function getbydate(){
        $result = DB::table('graphic_info')
                ->select(DB::raw('DATE(created_at) as date'), DB::raw('count(*) as views'))
                ->groupBy('date','id_suffer')
                ->get();

        return response()->json([
            'status' => $response,
            'data' => $result
        ]);
    }

    public function getinfobyregion(Request $request){
        $result = DB::table('graphic_info')
                ->sum('last_total_count')
                ->where('id_region',$request->region)
                ->groupBy('id_suffer')
                ->get();

        return response()->json([
            'status' => $response,
            'data' => $result
        ]);
    }

    public function getallinfo(){
        $result = DB::table('graphic_info')
                ->sum('last_total_count')
                ->groupBy('id_suffer')
                ->get();

        return response()->json([
            'status' => $response,
            'data' => $result
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
        $count = $request->count;
        $region = Region::find($request->region);
        $suffer = CategorySuffer::find($request->suffer);

        $info = new GraphicInfo();
        $info->count = $count;
        $info->created_at = Carbon::now();
        $info->region()->associate($region);
        $info->category_suffer()->associate($suffer);
        $info->save();
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\GraphicInfo  $graphicInfo
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $count = $request->count;
        $region = Region::find($request->region);
        $suffer = CategorySuffer::find($request->suffer);

        $info = GraphicInfo::find($request->id);
        $info->count = $count;
        $info->region()->associate($region);
        $info->category_suffer()->associate($suffer);
        $info->save();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\GraphicInfo  $graphicInfo
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $id = $request->id;
        $info = GraphicInfo::find($id);
        $info->delete();
    }
}
