<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DocumentList extends Model
{
    protected $table = 'document_list';
    protected $fillable = ['name','description'];
}
