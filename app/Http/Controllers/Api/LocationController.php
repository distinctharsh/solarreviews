<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\City;
use App\Models\Pincode;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class LocationController extends Controller
{
    public function citiesByState(int $stateId): JsonResponse
    {
        $cities = City::query()
            ->where('state_id', $stateId)
            ->orderBy('name')
            ->get(['id', 'name']);

        return response()->json([
            'data' => $cities,
        ]);
    }

    public function pincodesByCity(int $cityId): JsonResponse
    {
        $pincodes = Pincode::query()
            ->where('city_id', $cityId)
            ->where('is_active', true)
            ->orderBy('pincode')
            ->get(['id', 'pincode']);

        return response()->json([
            'data' => $pincodes,
        ]);
    }

    public function resolveByPincode(Request $request): JsonResponse
    {
        $data = $request->validate([
            'pincode' => 'required|string|max:20',
        ]);

        $pincode = (string) $data['pincode'];

        $match = Pincode::query()
            ->where('pincode', $pincode)
            ->where('is_active', true)
            ->orderByDesc('city_id')
            ->first();

        if (!$match) {
            return response()->json([
                'data' => null,
            ]);
        }

        $cityName = null;
        if (!empty($match->city_id)) {
            $city = City::query()->find($match->city_id);
            $cityName = $city?->name;
        }
        if (!$cityName) {
            $cityName = $match->city_name;
        }

        return response()->json([
            'data' => [
                'state_id' => (int) $match->state_id,
                'city_id' => $match->city_id ? (int) $match->city_id : null,
                'city_name' => $cityName,
                'pincode' => (string) $match->pincode,
            ],
        ]);
    }
}
