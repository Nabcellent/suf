<?php

namespace App\Http\Controllers;

use App\Models\CmsPage;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;

class CmsController extends Controller {
    public function index(): Factory|View|Application {
        $cms = CmsPage::all();

        $data = [
            'cms' => $cms,
            'metaKeywords' => implode(', ',$cms->pluck('meta_keywords')->toArray()),
            'metaDesc' => $cms->random()->meta_desc->toPlainText(),
        ];

        return view('info', $data);
    }

    public function showAboutUs(): Factory|View|Application {
        return view('about');
    }
}
