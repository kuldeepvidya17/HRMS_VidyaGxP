<?php

namespace App\Helpers;

use App\Models\ActivityLog;

class ActivityLogHelper
{
    public static function storeActivityLog($userId, $action, $description, $moduleName, $moduleId, $status)
    {
        ActivityLog::create([
            'user_id' => $userId,
            'action' => $action,
            'description' => $description,
            'module_name' => $moduleName,
            'module_id' => $moduleId,
            'status' => $status,
        ]);
    }
}
