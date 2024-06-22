<?php

namespace App\Models;

use App\Models\UserActivityLog;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Books extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'description', 'author', 'categories_id', 'price', 'stock_quantity', 'image_path', 'featured'];
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

    public function removeBook($books_item)
    {
        $book = Books::find($books_item);

        if ($book) {
            $imagePath = 'public/' . $book->image_path;

            if (Storage::exists($imagePath)) {

                Storage::delete($imagePath);
            } else {
                return false;
            }
            $book->delete();



            UserActivityLog::create([
                'user_id' => auth()->id(),
                'activity' => 'Removed a book ' . $book->title,
                'details' => 'Removed a book',
            ]);

            return true;
        } else {
            return false;
        }
    }

    public function store_book($request)
    {

        $data = $request->validate([
            'title' => 'required',
            'description' => 'required',
            'author' => 'required',
            'price' => 'required|numeric',
            'stock_quantity' => 'required|numeric',
            'categories' => 'required',
            'featured' => 'required'
        ]);

        if ($request->hasFile('image_path')) {
            $data['image_path'] = $request->file('image_path')->store('images', 'public');
        }

        $data['categories_id'] =  $request->categories;

        UserActivityLog::create([
            'user_id' => auth()->id(),
            'activity' => 'Added a book ' .$request->title,
            'details' => 'Added a book',
        ]);

        Books::create($data);
    }

    public function categories()
    {
        return $this->belongsTo(Categories::class, 'categories_id', 'id');
    }

    public function details()
    {
        return $this->hasMany(OrderDetails::class);
    }
}
