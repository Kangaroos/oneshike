<?php

class AdminSystemController extends BaseController
{
    public function getAdminIndex()
    {
        $resource     = 'system.admin';
        $resourceName = '管理员管理';
        $resourceDesc = '';
        return View::make('admin.system.admin')->with(compact('resource', 'resourceName', 'resourceDesc'));
    }
}
