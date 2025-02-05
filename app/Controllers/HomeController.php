<?php

namespace App\Controllers;

use Core\Http\Controllers\Controller;
use Core\Http\Request;
use Lib\FlashMessage;

class HomeController extends Controller
{
    public function index(Request $request): void
    {
        $title = 'Home';
        $user = $this->current_user;
        $this->render('admin/index', compact('title', 'user'));
    }
}
