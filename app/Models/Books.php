<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\UserActivityLog;
class Books extends Model
{
    use HasFactory;


    public function scopeFilter($query, array $filters)
    {


        if ($filters['category'] ?? false) {
            $query->whereHas('categories', function ($query) use ($filters) {
                $query->where('name', 'like', '%' . $filters['category'] . '%');
            });
            UserActivityLog::create([
                'user_id' => auth()->id(),
                'activity' => 'Searching',
                'details' => 'Searching for category: ' . $filters['category'],
            ]);
        }

        if ($filters['search'] ?? false) {
            $query->where('title', 'like', '%' . $filters['search'] . '%')
                ->orWhere('description', 'like', '%' . $filters['search'] . '%')
                ->orWhere('author', 'like', '%' . $filters['search'] . '%')
                ->orWhereHas('categories', function ($query) use ($filters) {
                    $query->where('name', 'like', '%' . $filters['search'] . '%');
                });

            UserActivityLog::create([
                'user_id' => auth()->id(),
                'activity' => 'Searching',
                'details' => 'Searching for: ' . $filters['search'],
            ]);
        }
    }

    public function categories()
    {
        return $this->belongsTo(Categories::class, 'categories_id', 'id');
    }
}
