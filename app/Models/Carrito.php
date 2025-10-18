<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Carrito extends Model
{
    public function usuario():BelongsTo{
        return $this->belongsTo(Usuario::class);
    }

    public function productos():BelongsToMany{
        return $this->belongsToMany(Producto::class)->withPivot('cantidad');
    }
}
