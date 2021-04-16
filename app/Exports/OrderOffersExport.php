<?php

namespace App\Exports;

use App\Models\Order\OrderOffer;
use App\Models\Order\OrderOfferItem;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\FromView;
use Illuminate\Contracts\View\View;

class OrderOffersExport implements FromView
{
    private $model, $id;

    public function __construct(int $id)
    {
        $this->id = $id;
        $this->model = OrderOffer::with(['items', 'client'])->findOrFail($this->id);
        return $this;
    }


    public function view(): View
    {
        return view('exports.offer', [
            'order' => $this->model
        ]);
    }



}
