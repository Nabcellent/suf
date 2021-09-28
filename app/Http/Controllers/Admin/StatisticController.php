<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Response;

class StatisticController extends Controller {
    public function index(): Response {
        return response()->view('admin.stats.index');
    }
}
