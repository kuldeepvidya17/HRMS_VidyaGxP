<?php

use App\Models\AcitivityLog;

function storeActivityLog($userId, $action, $description, $moduleName, $moduleId ,$status)
{   
    $store=new AcitivityLog;
    $store->user_id=$userId;
    $store->action=$action;
    $store->description=$description;
    $store->module=$moduleName;
    $store->module_id=$moduleId;
    $store->status=$status;
    $store->save();

    // $controller = new YourController();
    // $controller->storeActivityLog($userId, $action, $description, $moduleName, $moduleId);
}

