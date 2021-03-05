<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Expense extends Model
{
    use HasFactory;

    protected $fillable = [
        'employee_id' ,'name' ,'date' ,'attachment' ,'amount' ,'status'
    ];

    function employee() {
        return $this->belongsTo(User::class ,'employee_id');
    }

    function GetAttachmentAttribute($value) {
        return asset('storage/attachments/'.$value);
    }

    function SetAttachmentAttribute($attach) {
        if (is_file($attach)) {
            $micortime = explode("." ,microtime());
            $name = str_replace(" " ,"" ,$micortime[1]).'-'.$attach->getClientOriginalName();
            $attach->storeAs('public/attachments' ,$name);
            return $this->attributes['attachment'] = $name;
        }
    }
}
