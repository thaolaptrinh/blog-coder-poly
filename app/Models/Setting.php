<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    use HasFactory;

    protected $fillable = [
        'key',
        'value'
    ];


    public static function getValue($key)
    {

        return self::where('key', $key)->first()->value ?? '';
    }


    public static function getValues(array $keys)
    {
        $values = self::whereIn('key', $keys)->pluck('value', 'key')->toArray();

        return $values;
    }


    public static function updateValues($values)
    {
        foreach ($values as $key => $value) {
            self::updateOrCreate(['key' => $key], ['value' => $value]);
        }
    }
}
