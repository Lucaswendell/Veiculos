<?php
function url($param = null){
    $url = SITE['url'];
    if(isset($param)){
        $url = $url."/".$param; 
    }
    return $url;
}