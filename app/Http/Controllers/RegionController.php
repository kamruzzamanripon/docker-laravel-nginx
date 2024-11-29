<?php

namespace App\Http\Controllers;

use App\Models\Region;
use Illuminate\Http\Request;

class RegionController extends Controller
{
    public function getAll()
    {
        $region = new Region();
        $regions = $region->getAllRegion();
        return response()->json(data: $regions);
    }

    public function create(Request $request)
    {
        $region = new Region();
        $result = $region->createRegion($request->input('region_name'));
        return response()->json(['success' => $result]);
    }

    public function update(Request $request, $id)
    {
        $region = new Region();
        $result = $region->updateRegion($id, $request->input('region_name'));
        return response()->json(['success' => $result]);
    }

    public function delete($id)
    {
        $region = new Region();
        $result = $region->deleteRegion($id);
        return response()->json(['success' => $result]);
    }
}
