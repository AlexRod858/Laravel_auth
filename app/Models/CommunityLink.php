<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CommunityLink extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'channel_id',
        'title',
        'link',
        'approved'
    ];

    public function creator()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
    public function channel()
    {
        return $this->belongsTo(Channel::class);
    }
// Para actualizar el timestamp almacenaremos en una variable el registro devuelto y llamamos al método touch() y save().
// Reescribe el código en el controlador para implementar esta funcionalidad
//  y que siga funcionando la anterior. Debes probar que un usuario verificado 
//  puede seguir enviando enlaces y si el enlace está repetido se actualiza 
//  el timestamp y se sube a la primera posición. Si un usuario no verificado 
//  sube un enlace duplicado el comportamiento será como hasta ahora.
    ///////////////////////////////////////
    public function users()
{
return $this->belongsToMany(User::class, 'community_link_users');
}
//////////////////////////////////
    protected static function hasAlreadyBeenSubmitted($link)
    {
        if ($existing = static::where('link', $link)->first()) {
            $existing->touch();
            $existing->save();
            return true;
        }
        return false;
    }
}