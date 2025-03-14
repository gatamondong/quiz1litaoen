<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class InventoryModel extends Model
{
    protected $table = 'inventory';

    protected $fillable = ['name', 'quantity', 'price'];

    public static function addItem($name, $quantity, $price)
    {
        return self::create([
            'name' => $name,
            'quantity' => $quantity,
            'price' => $price,
        ]);
    }

    public static function updateItem($id, $name, $quantity, $price)
    {
        $item = self::find($id);
        if ($item) {
            $item->update([
                'name' => $name,
                'quantity' => $quantity,
                'price' => $price,
            ]);
        }
        return $item;
    }

    public static function deleteItem($id)
    {
        $item = self::find($id);
        if ($item) {
            $item->delete();
        }
        return $item;
    }
}


