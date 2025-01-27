<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Invoice
 *
 * @property $id
 * @property $week_id
 * @property $customer_name
 * @property $yacht_name
 * @property $location
 * @property $email
 * @property $date
 * @property $file
 * @property $created_at
 * @property $updated_at
 *
 * @property Week $id
 * @package App
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
class Invoice extends Model
{

    static $rules = [
		'week_id' => 'required',
		'due_date' => 'required',
		'yacht_name' => 'required',
		'location' => 'required',
		'email' => 'required',
		'date' => 'required',
        'notes' => 'nullable',
    ];

    protected $perPage = 20;

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['week_id','due_date','yacht_name','location','email','date','file','notes'];

    public function week()
    {
        return $this->belongsTo(Week::class);
    }

    public function details()
    {
        return $this->hasMany(InvoiceDetail::class);
    }

}
