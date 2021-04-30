<?php


namespace App\Http\Controllers\Frontend\Export;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Order\OrderOffer;

class OfferExportController extends Controller
{

    public function show(Request $Request, OrderOffer $order)
    {
        $blade = 1;
        return view('exports.offer', compact(['order', 'blade']));
    }

}
