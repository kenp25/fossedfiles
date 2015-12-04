<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SystemDocument extends Model
{
    protected $table = 'system_documents';
    protected $fillable = ['name', 'description', 'system_code','document_code','path','user_id'];

    public function system()
    {
        return $this->belongsTo('App\System','system_code');
    }

    public function document()
    {
        return $this->belongsTo('App\DocumentList','document_code');
    }

    public function user(){
        return $this->belongsTo('App\User');
    }
}
