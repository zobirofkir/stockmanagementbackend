<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Permission\Traits\HasRoles;

class Supplier extends Model
{
    use HasFactory, HasRoles;

    protected $fillable = [
        'name',
        'contact_name',
        'contact_phone',
        'contact_email',
        'address',
    ];

    public function products()
    {
        return $this->hasMany(Product::class);
    }
}
