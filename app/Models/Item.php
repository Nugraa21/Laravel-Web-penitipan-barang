<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'name',
        'description',
        'item_type',
        'brand',
        'color',
        'characteristics',
        'estimated_value',
        'notes',
        'photo_path',
        'status',
        'expected_retrieval_date',
        'receipt_token',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function histories()
    {
        return $this->hasMany(ItemHistory::class)->latest();
    }

    public function photos()
    {
        return $this->hasMany(ItemPhoto::class);
    }

    public function messages()
    {
        return $this->hasMany(ChatMessage::class)->latest();
    }
}
