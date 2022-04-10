<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ImageGallery_model extends Model
{
    protected $table='tblgallery';
    protected $primaryKey='id';
    protected $fillable=['products_id','image'];
}
