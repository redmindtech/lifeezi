<?php

use Carbon\Carbon;

function dateFormat($date = null,$time = false) {
    if($time)
     return Carbon::parse($date)->format('d-M-Y g:i A');
    
    return Carbon::parse($date)->format('d-M-Y');
}

function getTime($value){
    return date("g:i a", strtotime($value ."UTC"));
}

function getToken(){
    return csrf_token();
}