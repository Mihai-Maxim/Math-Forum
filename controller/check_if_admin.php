<?php
session_start();
include_once ('../model/adminsManip.php');
function isAdmin($Username)
{
    $admins=new adminsManip();
    $admin=$admins->checkAdmin($Username);
    if($admin[0][0]==0)
    {
        return false;
    }
    else
        return true;

}