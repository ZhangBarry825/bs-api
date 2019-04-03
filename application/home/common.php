<?php

use think\exception\HttpResponseException;
function getUser()
{
    if (session('user')) {
        return session('user');
    } else {
        return false;
    }
}

function unsetUser()
{
    session('user', null);
}

function throwError($message, $code = 400)
{
    $messageObj=[
        'msg'  => $message,
        'data' => '',
        'code' => $code
    ];

    throw new HttpResponseException(json($messageObj));
}