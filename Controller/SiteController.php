<?php

namespace Controller;

use Library\Controller;
use Library\Request;

class SiteController extends Controller
{
    public function indexAction(Request $request)
    {
        return $this->render('index.phtml');
    }

}