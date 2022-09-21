<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TypeOfBilling extends Model
{
    use HasFactory;

    protected $table = 'jenispembayaran';
    protected $fillable = [
        'pemid', 'pemnama',
    ];
}
