<?php

namespace Modules\Department\Entities;

use Illuminate\Database\Eloquent\Model;
use Modules\Staff\Entities\staff;
class Department extends Model
{
    protected $table= 'department';
    protected $fillable = ['Name','id_department'];
    protected $primaryKey = 'id';
    public $timestamps = false;
    public function staff() {
        return $this->hasMany(staff::class, "id_department",'id');
    }
}
