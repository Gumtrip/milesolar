<?php

namespace App\Models\Order;

use App\Models\Client\Client;
use Illuminate\Database\Eloquent\Model;

class OrderOffer extends Model
{
    protected $fillable = [
        'client_phone',
        'client_info',
        'offer_start',
        'offer_end',
        'term',
        'total_amount',
        'rmb_total_amount'
    ];

    public function items()
    {
        return $this->hasMany(OrderOfferItem::class);
    }

    public function client()
    {
        return $this->belongsTo(Client::class);
    }


    protected static function boot()
    {
        parent::boot();
        // 监听模型创建事件，在写入数据库之前触发
        static::creating(function ($model) {
            // 如果模型的 no 字段为空
            if (!$model->no) {
                // 调用 findAvailableNo 生成订单流水号
                $model->no = static::findAvailableNo();
                // 如果生成失败，则终止创建订单
                if (!$model->no) {
                    return false;
                }
            }
        });
    }

    /** 生成订单号
     * @return bool|string
     * @throws \Exception
     */
    public static function findAvailableNo()
    {
        // 订单流水号前缀
        $prefix = date('YmdHis');
        for ($i = 0; $i < 10; $i++) {
            // 随机生成 6 位的数字
            $no = $prefix . str_pad(random_int(0, 99), 2, '0', STR_PAD_LEFT);
            // 判断是否已经存在
            if (!static::query()->where('no', $no)->exists()) {
                return $no;
            }
        }
        \Log::warning('find order no failed');

        return false;
    }
}
