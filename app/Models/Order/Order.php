<?php

namespace App\Models\Order;

use Illuminate\Database\Eloquent\Model;
use App\Models\Client\Client;
use Illuminate\Database\Eloquent\SoftDeletes;
class Order extends Model
{

    use SoftDeletes;
    protected $fillable = [
        'no',
        'client_id',
        'total_amount',
        'currency',
        'exchange_rate',
        'rmb_total_amount',
        'remark',
        'status'
    ];

// 订单状态
    CONST STATUS_CREATED = 'created';
    CONST STATUS_PROCESS = 'process';
    CONST STATUS_CLOSE = 'close';
    CONST STATUS_FINISH = 'finish';

    public static $statusMap = [
        self::STATUS_CREATED => '创建',
        self::STATUS_PROCESS => '进行中',
        self::STATUS_CLOSE => '关闭',
        self::STATUS_FINISH => '完成',
    ];

    public function client()
    {
        return $this->belongsTo(Client::class);
    }


    /**支出
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function expenses()
    {
        return $this->hasMany(OrderExpense::class);
    }

    /**收款进度
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function proceeds()
    {
        return $this->hasMany(OrderProceed::class);
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
            $no = $prefix.str_pad(random_int(0, 99), 2, '0', STR_PAD_LEFT);
            // 判断是否已经存在
            if (!static::query()->where('no', $no)->exists()) {
                return $no;
            }
        }
        \Log::warning('find order no failed');

        return false;
    }

    /**关联报价订单
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function orderOffer()
    {
        return $this->belongsTo(OrderOffer::class);
    }

}
