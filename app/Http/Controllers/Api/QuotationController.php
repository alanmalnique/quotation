<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Validator\QuotationRequestValidator;
use App\Models\Currency;
use App\Models\Quotation;
use Carbon\Carbon;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Config;

class QuotationController extends Controller
{
    private array $parameters;
    private QuotationRequestValidator $request;

    public function __construct()
    {
        $this->parameters = Config::get('parameters');
    }

    public function store(QuotationRequestValidator $request): JsonResponse
    {
        $this->request = $request;
        $ages = $this->getAges();
        $daysOfTrip = $this->getDaysOfTrip();
        $fixedRate = $this->parameters['fixed_rate'];
        $tripValue = $this->calculateTripValue($fixedRate, $ages, $daysOfTrip);
        $quotation = $this->createQuotation($fixedRate, $daysOfTrip, $tripValue);

        return response()->json([
            'total' => $tripValue,
            'currency_id' => $quotation->currency->iso_code,
            'quotation_id' => $quotation->id
        ]);
    }

    private function getAges(): array
    {
        return explode(",", $this->request->age);
    }

    private function getDaysOfTrip(): int
    {
        $startDate = $this->request->start_date;
        $endDate = $this->request->end_date;

        return Carbon::createFromDate($startDate)->subDay()->diffInDays($endDate);
    }

    private function calculateTripValue(int $fixedRate, array $ages, int $daysOfTrip): float {
        $tripValue = 0;

        collect($ages)->map(function ($age) use ($fixedRate, $daysOfTrip, &$tripValue) {
            $load = $this->getLoadFromAge($age);
            $tripValue += $fixedRate * $load * $daysOfTrip;
        });

        return number_format($tripValue, 2);
    }

    private function getLoadFromAge(int $age): float
    {
        return collect($this->parameters['age_load'])
            ->filter(fn ($value, $key) => $age >= $key)
            ->last();
    }

    private function createQuotation(int $fixedRate, int $daysOfTrip, float $value): Quotation
    {
        $quotation = new Quotation();
        $quotation->age = $this->request->age;
        $quotation->currency_id = Currency::query()->where('iso_code', $this->request->currency_id)->first()->id;
        $quotation->trip_days = $daysOfTrip;
        $quotation->fixed_rate = $fixedRate;
        $quotation->value = $value;
        $quotation->save();

        return $quotation;
    }
}
