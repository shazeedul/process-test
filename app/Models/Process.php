<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Process extends Model
{
    use HasFactory;

    protected $fillable = [
        'pid',
        'status'
    ];

    protected $enumValues = ['running', 'stopped'];

    public function getStatusAttribute($value)
    {
        return in_array($value, $this->enumValues) ? $value : null;
    }

    public function setStatusAttribute($value)
    {
        $this->attributes['status'] = in_array($value, $this->enumValues) ? $value : null;
    }

    public function logs()
    {
        return $this->hasMany(ProcessLog::class, 'process_id', 'id');
    }
}
