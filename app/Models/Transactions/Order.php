<?php

namespace App\Models\Transactions;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Order extends Model
{
    public $timestamps = false;

    protected $table = 'orders';

    protected $fillable = ['products_id', 'customers_id', 'qty', 'rate', 'total_amount', 'created_at', 'complete'];

    protected $guarded = ['id'];

    const PENDING_ORDER = 0;
    const COMPLETE_ORDER = 1;

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function product()
    {
        return $this->belongsTo('App\Models\Product', 'products_id', 'id');
    }

    /**
     * @param int $completeStatus
     *
     * @return array
     */
    public static function orders($completeStatus)
    {
        $pendingOrders = DB::table('orders')
            ->join('customers', 'orders.customers_id', '=', 'customers.id')
            ->join('products', 'orders.products_id', '=', 'products.id')
            ->select('orders.id', 'orders.rate', 'orders.qty', 'orders.total_amount', 'customers.company', 'products.code', 'products.title')
            ->where('orders.complete', '=', $completeStatus)
            ->get();

        foreach ($pendingOrders as $key => $pendingOrder)
        {
            $pendingOrders[$key] = (array) $pendingOrder;
        }

        return $pendingOrders;
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function customer()
    {
        return $this->belongsTo('App\Models\Customer', 'customers_id', 'id');
    }
}