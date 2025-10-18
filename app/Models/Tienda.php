<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Tienda extends Model
{
    public function usuario():BelongsTo{
        return $this->belongsTo(Usuario::class);
    }

    public function productos():HasMany{
        return $this->hasMany(Producto::class);
    }
}
