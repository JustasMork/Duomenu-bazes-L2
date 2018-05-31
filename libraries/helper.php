<?php
/**
 * Created by PhpStorm.
 * User: Justas
 * Date: 4/12/2018
 * Time: 9:11 PM
 */

function vd($data)
{
    echo "<pre>";
    var_dump($data);
    echo "</pre>";
}

function vdd($data)
{
    vd($data);
    die;
}

function URL($module, $action, $params = [])
{
    $url = "/index.php?module=".$module."&action=".$action;

    $query = [];
    if(is_array($params) && !empty($params))
    {
        foreach ($params as $key=> $value)
        {
            $query[] = $key.'='.$value;
        }
    }

    if(!empty($query))
    {
        $url .= '&'.implode('&', $query);
    }

    return $url;
}

function redirect(string $module, string $action, $params = [])
{
    $url = Config::BASE_URL.URL($module, $action, $params);

    header("Location:".$url);
}

function setSession($key, $value)
{
    $_SESSION[$key] = $value;
}

function sessionExits($key)
{
    if(isset($_SESSION[$key]))
        return true;
    return false;
}

function sessionGetOnce($key)
{
    if(sessionExits($key))
    {
        $data = $_SESSION[$key];
        unset($_SESSION[$key]);
        return $data;
    }

    return '';
}

