<?php

use Illuminate\Support\Facades\Session;

function JSONResponse($data = array())
{
    echo json_encode($data);
}

function JSONResponseDefault($result, $message)
{
    return JSONResponse(array(
        'RESULT' => $result,
        'MESSAGE' => $message
    ));
}

function isLogin()
{
    return (Session::get('is_login') == true);
}

function getCurrentIdUser()
{
    return Session::get('userId');
}

function isAdmin()
{
    return (Session::get('role') == 'Admin');
}

function isSeller(){
    return (Session::get('role') == "Penjual");
}