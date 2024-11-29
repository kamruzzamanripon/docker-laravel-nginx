<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Region extends Model
{
    use HasFactory;

    public function getAllRegion()
    {
        $regions = DB::select('select * from regions');
        return json_encode($regions);
    }

    public function createRegion($regionName)
    {
        return DB::insert('INSERT INTO regions (region_name) VALUES (?)', [$regionName]);
    }

    public function updateRegion($id, $regionName)
    {
        return DB::update('UPDATE regions SET region_name = ? WHERE region_id = ?', [$regionName, $id]);
    }

    public function deleteRegion($id)
    {
        return DB::delete('DELETE FROM regions WHERE region_id = ?', [$id]);
    }
}
