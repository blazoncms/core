<?php

namespace BlazonCms\Core;

class Module
{
    public function __invoke()
    {
        return require __DIR__.'/../config/config.php';
    }
}
