<?php

namespace App\Models;

use Carbon\Carbon;
use App\Models\Process;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ProcessLog extends Model
{
    use HasFactory;

    protected $fillable = [
        'process_id',
        'creation_time',
    ];

    public function process()
    {
        return $this->belongsTo(Process::class);
    }

    public function getCreationTimeAttribute($value)
    {
        return $value ? Carbon::parse($value)->format('h:i A d.m.Y') : now()->format('h:i A d.m.Y');
    }

    public function setCreationTimeAttribute($value)
    {
        $this->attributes['creation_time'] = Carbon::parse($value)->format('Y-m-d H:i:s');
    }
}
