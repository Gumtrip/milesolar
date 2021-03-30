<?php

namespace App\Models\Order;

use Illuminate\Database\Eloquent\Model;

class OrderExpense extends Model
{
    CONST TYPE_BANK_CHARGE = 'bank_charge';
    CONST TYPE_COMMISSION = 'commission';
    CONST TYPE_REPARATION = 'reparation';
    CONST TYPE_PORT_SURCHARGE = 'port_surcharge';
    CONST TYPE_FREIGHT = 'freight';

    public static $typeMap = [
        self::TYPE_BANK_CHARGE => '银行扣费',
        self::TYPE_COMMISSION => '佣金',
        self::TYPE_REPARATION => '赔款',
        self::TYPE_PORT_SURCHARGE => '港杂费',
        self::TYPE_FREIGHT => '运费',
    ];
    protected $fillable = ['title', 'fee', 'remark'];

    public function order()
    {
        return $this->belongsTo(Order::class);
    }

}
