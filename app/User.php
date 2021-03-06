<?php

namespace App;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Carbon\Carbon;
class User extends Authenticatable
{
    protected $fillable=[
    	"username","fname","lname","birthdate","password","password_confirmation","address","email_add","contact_no","usertype","title","userimage","name"
    ];

     protected $appends=[
    	"age",
        'fullname',
        'image_path'
    ];

    public function getAgeAttribute()
    {
    
	return Carbon::createFromFormat('Y-m-d',$this->birthdate,'Asia/Manila')->diffInYears(Carbon::now('Asia/Manila'));
    }
    
    use SoftDeletes;
    protected $dates = ['deleted_at'];

    public function getFullnameAttribute()
    {
        return "{$this->fname} {$this->lname}";
    }


    public function getImagePathAttribute()
    {
        return asset("uploads/{$this->userimage}");
    }
}
