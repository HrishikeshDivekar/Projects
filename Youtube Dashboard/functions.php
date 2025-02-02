<?php

function filterIframe($iframe){
    $from1 = strpos($iframe,"\" src=\"")+7;
    $till1 = strpos($iframe,"\" title")-$from1;
    $trim1 = substr($iframe,$from1,$till1);
    return $trim1;
}

function getSeconds($t){
    if(strval($t>=5)){
        $hour = floor($t/10000);
        $min = floor($t%10000);
        $min = floor($min/100);
        $sec = $t%100;

        $time = ($hour*3600)+($min*60)+($sec);

        return $time;
    }
    elseif(strval($t)<5 && strval($t)>2){
        $min = floor($t/100);
        $sec = floor($t%100);
        $time = ($min*60)+($sec);

        return $time;
    }
    elseif(strval($t)==1 || strval($t)==2){
        $time = $t;
        return $time;
    }
}

function filterLink($jumper){
    $link = $jumper;
    $till = strpos($link,"?si");
    $trim = substr($link,0,$till);
    return $trim;
}

function validateLink($link){
    $https = substr($link,0,17);
    $cond = '"https://youtu.be/"';
    if($https == $cond){
        return true;
    }
    else{
        return false;
    }
}

function validateIframe($iframe){
    $start = substr($iframe,0,37);
    $cond = '<iframe width="560" height="315" src=';
    if($start==$cond){
        return true;
    }
    else{
        return false;
    }
}
?>