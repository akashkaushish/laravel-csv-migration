<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Seller extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'uuid',
        'seller_id',
		'seller_firstname',
		'seller_lastname',
		'date_joined',
		'country',
		'contact_region',
		'contact_date',
		'contact_customer_fullname',
		'contact_type',
		'contact_product_type_offered_id',
        'contact_product_type_offered',
		'sale_net_amount',
		'sale_gross_amount',
		'sale_tax_rate',
		'sale_product_total_cost',
	];
}
