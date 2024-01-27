<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Car;

class CarController extends Controller
{
    public function addCar(Request $request)
    {
        // Validasi data
        $request->validate([
            'brand' => 'required|string',
            'model' => 'required|string',
            'license_plate' => 'required|string|unique:cars',
            'rental_rate_per_day' => 'required|numeric',
        ]);

        // Simpan data mobil
        $car = new Car();
        $car->brand = $request->brand;
        $car->model = $request->model;
        $car->license_plate = $request->license_plate;
        $car->rental_rate_per_day = $request->rental_rate_per_day;
        $car->save();

        return response()->json(['message' => 'Car added successfully'], 201);
    }

    public function searchCars(Request $request)
    {
        // Cari mobil berdasarkan merek, model, atau ketersediaan
        $cars = Car::where('brand', 'like', "%$request->keyword%")
                    ->orWhere('model', 'like', "%$request->keyword%")
                    ->get();

        return response()->json($cars);
    }

    public function getAllCars()
    {
        // Ambil daftar semua mobil yang tersedia
        $cars = Car::all();
        return response()->json($cars);
    }
}
