<?php

namespace App\Controllers;

class MainController extends BaseController
{
    public function index(): string
    {
        return view('includes/header.php') .
            view('home.php') .
            view('includes/footer.php');
    }
    public function cart(): string
    {
        return view('includes/header.php') .
            view('cart.php') .
            view('includes/footer.php');
    }
    public function profile(): string
    {
        return view('includes/header.php') .
            view('profile.php') .
            view('includes/footer.php');
    }
}
