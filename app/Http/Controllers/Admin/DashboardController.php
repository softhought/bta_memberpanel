<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Member;

class DashboardController extends Controller
{
    public function index()
    {
        $data = [];
        $data['bodyView'] = view('admin.dashboard', $data);
        return $this->renderView($data);
    }

    public function transactions()
    {
        $data['memberList'] = Member::all();

        $data['bodyView'] = view('admin.transactions.index', $data);
        return $this->renderView($data);
    }
}
