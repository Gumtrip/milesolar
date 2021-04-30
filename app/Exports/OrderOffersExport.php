<?php

namespace App\Exports;

use App\Models\Order\OrderOffer;
use App\Models\Order\OrderOfferItem;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\FromView;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\WithDrawings;
use PhpOffice\PhpSpreadsheet\Worksheet\Drawing;

class OrderOffersExport implements FromView, WithDrawings
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

    public function drawings()
    {
        $result = [];
        foreach ($this->model->items as $k => $item) {
            $k += 3;
            $drawing = new Drawing();
            $drawing->setName($item->title);
            $drawing->setDescription($item->title);
            $drawing->setPath(public_path($item->img));
            $drawing->setHeight(50);
            $drawing->setCoordinates('B' . $k);
        }
        return $result;
    }

}
