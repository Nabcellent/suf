<?php

namespace App\Http\Controllers\Admin;

use App\Helpers\Aid;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreCmsRequest;
use App\Models\CmsPage;
use Exception;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Log;

class CmsController extends Controller {
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index(): Response {
        $data['cmsPages'] = CmsPage::all();

        return response()->view('admin.pages.cms.list', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create(): Response {
        return response()->view('admin.pages.cms.upsert');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StoreCmsRequest $request
     * @return RedirectResponse
     */
    public function store(StoreCmsRequest $request): RedirectResponse {
        $data = $request->except(['_token', '_method']);

        try {
            CmsPage::create($data);

            return Aid::createOk('Created successfully!', 'admin.cms.index');
        } catch(Exception $e) {
            Log::error($e->getMessage());

            return Aid::returnToastError($e->getMessage(), 'Unable to create CMS');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param CmsPage $cmsPage
     * @return Response
     */
    public function show(CmsPage $cmsPage) {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param CmsPage $cmsPage
     * @return Response
     */
    public function edit(int $id): Response {
        $data['cms'] = CmsPage::find($id);

        //dd($data['cms']);

        return response()->view('admin.pages.cms.upsert', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param StoreCmsRequest $request
     * @param int             $id
     * @return RedirectResponse
     */
    public function update(StoreCmsRequest $request, int $id): RedirectResponse {
        $data = $request->except(['_token', '_method']);

        try {
            CmsPage::findOrFail($id)->update($data);

            return Aid::updateOk('Update successful!', 'admin.cms.index');
        } catch(Exception $e) {
            Log::error($e->getMessage());

            return Aid::returnToastError($e->getMessage(), 'Unable to create CMS');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param CmsPage $cmsPage
     * @return Response
     */
    public function destroy(CmsPage $cmsPage) {
        //
    }
}
