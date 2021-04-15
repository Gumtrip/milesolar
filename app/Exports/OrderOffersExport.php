<?php

namespace App\Exports;

use App\Models\Order\OrderOffer;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Facades\Excel;

class OrderOffersExport implements FromQuery, WithHeadings
{
    private $model, $id;

    public function __construct(int $id)
    {
        $this->id = $id;
        return $this;
    }


    public function query()
    {
//        $query = OrderOffer::query()->with(['items','client'])->where('id',$this->id);
        $query = OrderOffer::with(['items', 'client']);
//        $query = OrderOffer::where('id',$this->id)->with(['items','client']);
        return $query;
    }


    public function map($offer): array
    {
        dd(__LINE__);

        return [
            1,
            2,
            3,
            4,
            5,
            6,
        ];
    }


    public function headings(): array
    {
        return [
            'Item',
            'Photo',
            'Description',
            'Unit Price',
            'Quantity',
            'Amount',
        ];
    }

}
