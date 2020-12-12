<?php

function shortText($text)
{
    if(strlen($text)>10)
    {
        return substr($text,0,11);

    }
}

