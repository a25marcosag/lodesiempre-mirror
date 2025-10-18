<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Usuario extends Model
{
    public function tienda():HasOne{
        return $this->hasOne(Tienda::class);
    }

    public function carrito():HasOne{
        return $this->hasOne(Carrito::class);
    }
}
