<?php

class Formate
{

    public function formatDate($date)
    {
        date_default_timezone_set("Asia/Dhaka");
        return date("m/d/Y h:i:s a", time());
    }

    public function textShorten($text, $limit = 400)
    {
        $text = $text . " ";
        $text = substr($text, 0, $limit);
        $text = substr($text, 0, strrpos($text, ' '));
        $text = $text . ".....";
        return $text;
    }
}
