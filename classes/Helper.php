<?php

class Helper 
{
    public static function formatDate($datetime) 
    {
        return date("d M Y, h:i A", strtotime($datetime));
    }

    public static function sanitize($value) 
    {
        return htmlspecialchars(trim($value));
    }
}
