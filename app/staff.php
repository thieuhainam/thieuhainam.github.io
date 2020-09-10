<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class staff extends Model
{
    protected $table ='staff';
    protected $primaryKey = 'staff_id';
    protected $fillable = ['name','id_department','phone','address','is_active'];
    public $timestamps = true;
    public function department() {
        return $this->belongsTo(Department::class, "id_department",'id');
    }
}
