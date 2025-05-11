<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DownloadHistory extends Model
{
    protected $fillable = [
        'demande_id',
        'user_id',
        'copies_downloaded',
        'last_download_at'];
    
    public function demande()
    {
        return $this->belongsTo(Demande::class);
    }
    
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}