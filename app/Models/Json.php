<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Json extends Model
{
    use HasFactory;

    const EMOTION_TEXT = [
       '1.0'=> 'Giận dữ',
       '2.0' => 'Phàn nàn',
       '3.0' => 'Bình thường',
       '4.0' => 'Vui vẻ'
    ];
}
