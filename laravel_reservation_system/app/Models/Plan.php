<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Plan extends Model
{
    use HasFactory;
    protected $fillable = [
        'title',
        'detail',
    ];
    public function images()
    {
        return $this->hasMany(Image::class); // または適切なリレーションを定義
    }
    // Plan モデルのリレーションシップでキャスケード削除を追加
    public function charges()
    {
        return $this->hasMany(Charge::class)->cascadeOnDelete();
    }

}
