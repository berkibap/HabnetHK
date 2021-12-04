<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HkLogs extends Model
{
    use HasFactory;
    public $table = "hk_logs";
    public $timestamps = false;

    public static function logAction($staffId, $action, $ip_address, $failed, $user_id = 0, $comment = "") {
        $log = new HkLogs();
        $log->staff_id = $staffId;
        $log->action = $action;
        $log->ip_address = $ip_address;
        $log->failed = $failed;
        $log->user_id = $user_id;
        $log->comment = $comment;
        $log->save();
        return true;
    }
}
