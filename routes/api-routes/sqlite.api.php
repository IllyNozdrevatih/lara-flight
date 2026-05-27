<?php
use Illuminate\Support\Facades\Route;
use App\Models\FirtDBLite;
use App\Models\Flight;
use Illuminate\Support\Facades\DB;

Route::get('/sqlite', function () {
    $data = FirtDBLite::all();
    return response()->json($data);
});

Route::post('/sqlite', function () {
    $data = FirtDBLite::create([
        'name' => 'Test'
    ]);
    return response()->json($data);
});

Route::get('/sqlite/airlines', function () {
    $result =   DB::table('airlines')
    ->orderBy('id', 'desc')
    ->get();    
    return response()->json(['result' => $result]);
});

Route::get('/sqlite/flights', function () {
    $flights = Flight::with('airline')->orderBy('id', 'desc')->get();
    return response()->json(['result' => $flights]);
    // $result =   DB::table('flights')
    // ->orderBy('id', 'desc')
    // ->join('airlines', 'flights.airline_id', '=', 'airlines.id')
    // ->get();    
    // return response()->json(['result' => $result]);
});
    
Route::delete('/sqlite/flights/{id}', function ($id) {
    $flight = Flight::findOrFail($id)->delete();
    return response()->json(['result' => 'Flight deleted successfully']);
});