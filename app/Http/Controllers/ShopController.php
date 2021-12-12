<?php

namespace App\Http\Controllers;

use App\Models\Shop;
use App\Models\Area;
use App\Models\Genre;
use Illuminate\Http\Request;

class ShopController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $items = Shop::all();
        foreach ($items as $item) {
            $item->area_name = 1;
            $item->genre_name = $item->genre->genre_name;
            $item->favorites = $item->getFavorites;
            $item->reservations = $item->getReservations;
        };
        return response()->json([
            'data' => $items,
        ], 200);
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if ($request->pic_path != null) {
            $picture = $request->file('pic_path');
            $picture_name = $picture->getClientOriginalName();
            $picture->storeAs('public', $picture_name);
            $pic_path = "http://127.0.0.1:8000/storage/".$picture_name;
        }
        $area_id = Area::where('area_name', $request->area_name)->first();
        $genre_id = Genre::where('genre_name', $request->genre_name)->first();
        $item_content = [
            'area_id' => $area_id->id,
            'genre_id' => $genre_id->id,
            'shop_name' => $request->shop_name,
            'description' => $request->description,
            'pic_path' => $pic_path,
        ];
        Shop::create($item_content);

        return redirect("https://infinite-plateau-76316.herokuapp.com");
    }
    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Shop  $shop
     * @return \Illuminate\Http\Response
     */
    public function show(Shop $shop)
    {
        $item = [
            'shop_name' => $shop->shop_name,
            'description' => $shop->description,
            'pic_path' => $shop->pic_path,
            'area_name' => $shop->area->area_name,
            'genre_name' => $shop->genre->genre_name,
        ];
        return response()->json([
            'data' => $item
        ], 200);
    }
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Shop  $shop
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Shop $shop)
    {
        $update = [
            'message' => $request->message,
            'url' => $request->url
        ];
        $item = Shop::where('id', $shop->id)->update($update);
        if ($item) {
            return response()->json([
                'message' => 'Updated successfully',
            ], 200);
        } else {
            return response()->json([
                'message' => 'Not found',
            ], 404);
        }
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Shop  $shop
     * @return \Illuminate\Http\Response
     */
    public function destroy(Shop $shop)
    {
        $item = Shop::where('id', $shop->id)->delete();
        if ($item) {
            return response()->json([
                'message' => 'Deleted successfully',
            ], 200);
        } else {
            return response()->json([
                'message' => 'Not found',
            ], 404);
        }
    }
}
