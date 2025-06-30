<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

class DashboardController extends Controller
{
    public function index()
    {
        $data = [];
        $data['bodyView'] = view('admin.dashboard', $data);
        return $this->renderView($data);
    }
}
