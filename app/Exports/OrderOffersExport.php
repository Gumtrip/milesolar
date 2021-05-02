<?php

namespace App\Exports;

use App\Models\Order\OrderOffer;
use Maatwebsite\Excel\Concerns\FromView;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\WithDrawings;
use PhpOffice\PhpSpreadsheet\Worksheet\Drawing;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Concerns\RegistersEventListeners;
use Maatwebsite\Excel\Events\BeforeExport;
use Maatwebsite\Excel\Events\BeforeWriting;
use Maatwebsite\Excel\Events\BeforeSheet;
use Maatwebsite\Excel\Events\AfterSheet;

class OrderOffersExport implements FromView, WithDrawings, ShouldAutoSize
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
            $result[] = $drawing;
        }
        return $result;
    }


    /*    public function registerEvents(): array
        {
            return [
                AfterSheet::class  => function(AfterSheet $event) {
                    //设置行高，$i为数据行数
                    for ($i = 0; $i<=10; $i++) {
                        $event->sheet->getDelegate()->getRowDimension($i)->setRowHeight(100);
                    }

                }
            ];
        }*/
}
