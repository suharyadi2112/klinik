<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Action extends Model
{
    use HasFactory;
    protected $table = 'tindakan';
    protected $fillable = [
        'tndid', 'tndnama', 'tndkattndid','tndharga','tndnote',
    ];
}
