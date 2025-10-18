<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Producto extends Model
{
    public function tienda():BelongsTo{
        return $this->belongsTo(Tienda::class)->withDefault(['nombre'=>'EMPTY','id'=>-1]);
    }

    public function carritos():BelongsToMany{
        return $this->belongsToMany(Carrito::class)->withPivot('cantidad');
    }
}
