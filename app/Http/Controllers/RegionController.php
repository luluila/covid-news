<?php

namespace App\Http\Controllers;

use App\Models\Region;
use Illuminate\Http\Request;

class RegionController extends Controller
{
    public function getall(){
        $region = DB::table('region')
                    ->get();
        return response()->json([
            'status' => 'success',
            'region' => $region
        ]);
    }

    public function getbyid(Request $request){
        $region = App\Models\Region::find($request->id);
        if (isset($region)) {
            return response()->json([
                'status' => 'success',
                'region' => $region
            ]);
        } else {
            return response()->json([
                'status' => 'failed',
                'Message' => 'daerah tidak ditemukan'
            ]);
        }
    }

    public function getbyname(Request $request){
        $regionName = $request->name;
        $region = getregionbyname($regionName);
        if (isset($region)) {
            return response()->json([
                'status' => 'success',
                'region' => $region
            ]);
        } else {
            return response()->json([
                'status' => 'failed',
                'Message' => 'region tidak ditemukan'
            ]);
        }
    }

    public function getregionbyname($name){
        $region = DB::table('region')
                    ->where('region',$regionName)
                    ->get()->first();
        return $region;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $regionName = $request->name;
        $affect = DB::table('region')
                ->where('region',$regionName)
                ->get()->count();
        if ($affect > 0) {
            $message = "region sudah ada";
        } else {
            $region = new regionSuffer();
            $region->region = $regionName;
            $region->save();

            $message = "berhasil";
        }
        return response()->json([
            'status' => $message,
            'region' => $regionNews
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Region  $region
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $id = $request->id;
        $name = $request->name;

        $region = getregionbyname($name);
        if (isset($region)) {
            $region = App\Models\Region::find($request->id);
            if (!isset($region)) {
                $region->category = $name;
                $region->save();

                return response()->json([
                    'status' => 'success',
                    'region' => $region
                ]);

            } else {
                return response()->json([
                    'status' => 'failed',
                    'Message' => 'region tidak ditemukan'
                ]);
            }
        } else {
            return response()->json([
                'status' => 'failed',
                'Message' => 'region sudah digunakan'
            ]);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Region  $region
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $id = $request->id;
        $region = App\Models\Region::find($id);
        if (isset($region)) {
            $region->delete();
            $message = "berhasil";    
        } else {
            $message = "region tidak ditemukan";
        }
        return response()->json([
            'status' => $message
        ]);
    }
}
