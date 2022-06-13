<?php
namespace App\Controller;

use Composer\Autoload\ClassLoader;
use Core\Controller;

Class HomeController extends Controller{

    public function index()
    {
        $data = [];
        $path= 'pages/home/home.html.twig';
        $this->renderView($path, $data);
    }
}
