<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class Deal extends Model
{
	use SoftDeletes;

	/* STATUS */
	const OPEN = 2; // открыта
    const AGGREEMENT = 3; // договор
    const PAYMENT = 4; // оплата
    const SHIPMENT = 5; // доставка
    const SERVE = 6; // обслуживание
    const CANCEL = 0; // отменена
    const CLOSE = 1; // закрыта

	/* type */
	const TYPE_SERVICE = 1;
	const TYPE_PRODUCT = 2;

	protected $fillable = [
        'name',
        'sum',
        'type',
        'status',
        'client_id',
        'file_id',
		'comment'
    ];

	public $timestamps = true;

	public function file()
    {
    	return $this->hasOne(Download::class);
    }

	public function client()
    {
    	return $this->hasOne(Organization::class);
    }
}
