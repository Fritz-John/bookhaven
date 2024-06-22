<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Categories extends Model
{
    use HasFactory;

    protected $fillable = ['name'];

    public function store_category($request)
    {

        $data = $request->validate([
            'name' => 'required|unique:categories,name',
        ]);

        UserActivityLog::create([
            'user_id' => auth()->id(),
            'activity' => 'Added a category ' . $request->name,
            'details' => 'Added a category from ' . $request->ip(),
        ]);

        Categories::create($data);
    }

    public function delete_category($category_id)
    {
        $category = Categories::find($category_id);

        if ($category->books) {
            foreach ($category->books as $books) {
                $imagePath = 'public/' . $books->image_path;

                if (Storage::exists($imagePath)) {

                    Storage::delete($imagePath);
                } else {
                    return false;
                }
            }
        }

        UserActivityLog::create([
            'user_id' => auth()->id(),
            'activity' => 'Removed a category ' .  $category->name,
            'details' => 'Removed a category',
        ]);

        $category->delete();

        return true;
    }



    public function books()
    {
        return $this->hasMany(Books::class, 'categories_id');
    }
}
