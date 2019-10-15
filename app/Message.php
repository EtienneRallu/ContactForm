<?php
namespace App;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Validator;
class Message extends Model {

    use SoftDeletes;

    protected $table = 'messages';
    public $timestamps = true;
    public static $rules = [
        'firstName'=> 'required|string',
        'lastName'=> 'required|string',
        'email' => 'required|email',
        'phoneNumber' => 'string|nullable',
        'subject'=>'required|string',
        'content' => 'required|string',
        'optIn' =>'required|boolean'
    ];

    protected $hidden = [
        'created_at',
        'updated_at',
        'deleted_at'
    ];

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at'
    ];

    public static function getValidation($inputs)
    {
        $validator = Validator::make($inputs, self::$rules);
        return $validator;
    }

    public static function createOne($inputs)
    {
        $new = new self();

        $new->firstName =   $inputs['firstName'];
        $new->lastName  =   $inputs['lastName'];
        $new->email     =   $inputs['email'];
        $new->phoneNumber=  $inputs['phoneNumber'];
        $new->subject   =   $inputs['subject'];
        $new->content   =   $inputs['content'];
        $new->optIn   =   $inputs['optIn'];
        $new->save();

        return $new;
    }




}
