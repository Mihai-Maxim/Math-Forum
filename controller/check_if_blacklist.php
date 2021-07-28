<?php
session_start();
include_once ('/fenrir/studs/mihai.maxim/html/model/blacklistManip.php');
function isBlacklisted($Username)
{
    $blacklist=new blacklistManip();
    $black=$blacklist->checkBlock($Username);
    if($black[0][0]==0)
    {
        return false;
    }
    else
        return true;

}