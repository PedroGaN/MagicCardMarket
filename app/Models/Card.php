<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Card extends Model
{
    use HasFactory;

    protected $casts = [
        'collection_id' => 'array'
    ];

    public function collections()
    {
        return $this->belongsToMany(Collection::class);
    }

    public function forSaleCards()
    {
        return $this->belongsTo(ForSaleCard::class);
    }

}
