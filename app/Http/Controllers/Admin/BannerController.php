<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Banner;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;

class BannerController extends Controller {

    public function getCreateUpdateBanners(Request $request): View|Factory|Application|RedirectResponse {
        if($request->isMethod('POST')) {
            $data = $request->all();

            $file = $request->file('image');
            $imageName = date('dmYHis') . "_" . Str::random(3) . "." . $file->guessClientExtension();
            $file->move(public_path('images/banners'), $imageName);

            $data['image'] = $imageName;

            DB::transaction(function() use ($data) {
                Banner::create($data);
            });

            return back()
                ->with('alert', alert('success', 'Success!', 'Banner Created', 7));
        }
        if ($request->isMethod('PUT')) {
            $data = $request->all();

            $banner = Banner::find($data['banner_id']);

            if($request->hasFile('image')) {
                $file = $request->file('image');
                $imageName = date('dmYHis') . "_" . Str::random(3) . "." . $file->guessClientExtension();
                $file->move(public_path('images/banners'), $imageName);

                $data['image'] = $imageName;

                if(File::exists(public_path('images/banners/' . $banner->image))){
                    File::delete(public_path('images/banners/' . $banner->image));
                }
            }

            DB::transaction(function() use ($banner, $data) {
                $banner->update($data);
            });

            return back()
                ->with('alert', alert('success', 'Success!', 'Banner Updated', 7));
        }


        $banners = Banner::where('type', 'Slider')->latest()->get()->toArray();
        $ads = Banner::where('type', 'Box')->latest()->get()->toArray();

        return view('Admin.Pages.banners')
            ->with(compact('banners', 'ads'));
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request) {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id) {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id) {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int                      $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id) {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id) {
        //
    }
}
