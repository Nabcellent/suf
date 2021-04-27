<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\AdBox;
use App\Models\Banner;
use App\Models\Policy;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;

class PageContentController extends Controller
{
    public function getCreateUpdateBanners(): Factory|View|Application {
        $banners = Banner::latest()->get()->toArray();

        return view('Admin.Pages.banners')
            ->with(compact('banners'));
    }

    public function getCreateUpdateAds(): Factory|View|Application {
        $ads = AdBox::latest()->get()->toArray();

        return view('Admin.Pages.ads')
            ->with(compact('ads'));
    }

    public function getCreateUpdatePolicies(): Factory|View|Application {
        $policies = Policy::latest()->get()->toArray();

        return view('Admin.Pages.policies')
            ->with(compact('policies'));
    }
}
