<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HkPermissions extends Model
{
    use HasFactory;
    public $table = "hk_permissions";
    public $timestamps = false;
    public static $identifiers = [
        "login",
        "view_online_chart",
        "view_last_bans",
        "view_last_users",
        "ban_users",
        "see_user_ips",
        "manage_users",
        "manage_news",
        "view_chatlogs",
        "trade_logs",
        "shop_logs",
        "badge_management",
        "edit_users",
        "ingame_management",
        "manage_permissions",
        "view_hk_logs",
        "logs",
        "staff_logs",
        "detailed_user_search",
        "news_list",
        "news_delete",
        "new_article"
    ];

    public static function checkPermission($rank, $identifier) {
        $query = self::where("rank_id", $rank)->first();
        if(!$query) { return "error";}
        $permissions = explode(",", $query->perm_identifier);
        if(!in_array($identifier, self::$identifiers)) {
            return "identifier_not_found";
        }
        if(!in_array($identifier, $permissions)) {
            return false;
        }
        return true;
    }
}
