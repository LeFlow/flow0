<?php

namespace App\Config;

class Config{

    public $base_url;

    function getBaseUrl() {
        return $base_url = '/flow/';
    }

}

