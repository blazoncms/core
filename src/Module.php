<?php

namespace Ctt\BlazonCms;

class Module
{
    public function __invoke()
    {
        return require __DIR__.'/../config/config.php';
    }
}
