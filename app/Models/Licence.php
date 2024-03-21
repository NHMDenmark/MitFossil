<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Licence extends Model
{
    use HasFactory;

    protected $fillable = [
      'description',
      'created_at',
      'update_at'
    ];

    public static function getDropdown() {
        return self::all()
            ->map( function ($item, $key) {
                return [
                  'value' => $item->id,
                  'label' => $item->description
                ];
            });
    }
}
