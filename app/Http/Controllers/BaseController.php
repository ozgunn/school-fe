<?php

namespace App\Http\Controllers;

use App\Http\Services\SiteService;

class BaseController extends \Illuminate\Routing\Controller
{
    public $service;

    public function __construct()
    {
        $this->service = new SiteService();
    }
}
