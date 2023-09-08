<?php

namespace App\Data\Models;

use App\Data\Constants;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Data\Models\Setting
 *
 * @property int $id
 * @property string $name
 * 
 * @mixin \Eloquent
 */
class Setting extends Model
{
    use HasFactory;

    protected $guarded = [];
}
