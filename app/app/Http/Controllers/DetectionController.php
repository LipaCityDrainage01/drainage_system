<?php

namespace App\Http\Controllers;

use App\Models\Detection;
use App\Models\Settings;
use GuzzleHttp\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class DetectionController extends Controller
{

    protected $client;

    public function __construct(Client $client)
    {
        $this->client = new Client([
            'base_uri' => 'https://api.openweathermap.org/data/3.0/',
        ]);

    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //

        $response = Http::get('https://api.openweathermap.org/data/2.5/weather', [
            'lat' => 15.4947522,
            'lon' => 120.9806166,
            'appid' => '49f42e2aad44e0e209ca5d90b81914c7',
        ]);

        // This would return an array of the response
        $weatherData = $response->json();

        $sensor1 = $request->get('s1');
        $sensor2 = $request->get('s2');
        $sensor3 = $request->get('s3');
        $sensor4 = $request->get('s4');

        $rainfall = $weatherData["rain"]["1h"] ?? 10;

        $filter1 = new KalmanFilter(12, $rainfall, 10, $request->get('s1'));
        $filter2 = new KalmanFilter(13, $rainfall, 15, $request->get('s2'));
        $filter3 = new KalmanFilter(21, $rainfall, 23, $request->get('s3'));
        $filter4 = new KalmanFilter(24, $rainfall, 24, $request->get('s4'));

        $filtered1 = $filter1->update($sensor1);
        $filtered2 = $filter2->update($sensor2);
        $filtered3 = $filter3->update($sensor3);
        $filtered4 = $filter4->update($sensor4);

        $data_combined = ($filtered1 + $filtered2 + $filtered3 + $filtered4) / 4;

        $baseValue = 32;
        $targetValue = 20;
        $targetPercentage = 75;

         if ($data_combined > 40) {
             $adjustedSensor = 0;
         } else {
             $adjustedSensor = $this->mapValue($data_combined, $baseValue, $targetValue, $targetPercentage);
         }

         $settings = Settings::find(1);
         $status = $this->calculateFloodingCondition($adjustedSensor, $settings->rainfall, $settings->waterflow);

//        $adjustedSensor = 50.00;

        $detection = Detection::create([
            'location_id' => 1,
            'sensor_1' => $request->get('s1'),
            'sensor_2' => $request->get('s2'),
            'sensor_3' => $request->get('s3'),
            'sensor_4' => $request->get('s4'),
            'sensor_data' => min(95, abs($adjustedSensor)),
            'status' => $status,
            'remarks' => 'NA'
        ]);

        return response()->json($detection);
    }


    function calculateFloodingCondition ($adjustedSensor, $rainfall, $waterfall) {
        $totalCondition = floatval($adjustedSensor) + floatval($rainfall) + floatval($waterfall);

        if($totalCondition <= 90) {
            return "low";
        } elseif($totalCondition > 60 && $totalCondition <= 150) {
            return "medium";
        } else {
            return "high";
        }
    }

// Map a sensor value to the percentage scale
    function mapValue($sensorValue, $baseValue, $targetValue, $targetPercentage) {
        $range = $baseValue - $targetValue;
        $adjustedValue = $sensorValue - $targetValue;
        $percentage = (1 - ($adjustedValue / $range)) * $targetPercentage;

        if($percentage > 100) {
            $percentage = 95;
        }
        return $percentage;
    }

    /**
     * Display the specified resource.
     */
    public function show(Detection $detection)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Detection $detection)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Detection $detection)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Detection $detection)
    {
        //
    }
}
