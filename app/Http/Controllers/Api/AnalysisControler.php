<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Models\Order;
use App\Services\AnalysisService;
use App\Services\DecileService;
use App\Services\RFMService;
use Illuminate\Support\Facades\DB;

class AnalysisControler extends Controller
{
    public function index(Request $request) {

        $subQuery = Order::betweenDate($request->startDate, $request->endDate);
        if($request->type === 'preDay')
        {
            list($data, $labels, $totals) = AnalysisService::preDay($subQuery);
        }

        if($request->type === 'preMonth')
        {
            list($data, $labels, $totals) = AnalysisService::preMonth($subQuery);
        }

        if($request->type === 'preYear')
        {
            list($data, $labels, $totals) = AnalysisService::preYear($subQuery);
        }

        if($request->type === 'decile')
        {
            list($data, $labels, $totals) = DecileService::decile($subQuery);
        }
        
        if($request->type === 'rfm')
        {
            list($data, $totals, $eachCount) = RFMService::rfm($subQuery, $request->rfmPrms);

            return response()->json([
                'data' => $data,
                'type' => $request->type,
                'eachCount' => $eachCount,
                'totals' => $totals,
            ], Response::HTTP_OK);
        }

        return response()->json([
            'data' => $data,
            'type' => $request->type,
            'labels' => $labels,
            'totals' => $totals,
        ], Response::HTTP_OK);
    }
}
