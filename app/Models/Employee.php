<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Employee extends Model
{
    use HasFactory;

    protected $fillable = [
        'full_name',
        'hire_date',
        'email',
        'phone_number',
        'salary',
        'photo',
        'admin_created_id',
        'admin_updated_id',
        'position_id',
    ];

    protected $with = [
        'position',
    ];

    protected $casts = [
        'hire_date' => 'date:d.m.Y',
        'created_at' => 'date:d.m.Y',
        'updated_at' => 'date:d.m.Y',
    ];

    protected function photo(): Attribute
    {
        return Attribute::make(
            get: fn (string $value) => Storage::has($value) ? asset(Storage::url($value)) : $value,
        );
    }

    public function position() {
        return $this->belongsTo(Position::class);
    }
}
