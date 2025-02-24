<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Location;

class DrawController extends Controller
{
    public function drawData()
    {
        $actualYear = now()->year;
        $locations = Location::where('year', $actualYear)->with('crew')->get();

        $grid = array_fill(0, 10, array_fill(0, 10, null));
        $crewName = array_fill(0, 10, array_fill(0, 10, null));

        foreach ($locations as $location) {
            if ($location->crew && $location->crew->isNotEmpty()) {
                $grid[$location->y][$location->x] = $location->crew->first()->logo;
                $crewName[$location->y][$location->x] = $location->crew->first()->name;
            }
        }

        $isGridEmpty = true;
        foreach ($grid as $row) {
            foreach ($row as $cell) {
                if ($cell !== null) {
                    $isGridEmpty = false;
                    break 2;
                }
            }
        }

        if ($isGridEmpty) {
            $grid = [];
            $crewName = [];
        }

        return response()->json([
            'grid' => $grid,
            'crewName' => $crewName,
        ]);
    }

}
