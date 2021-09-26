<?php

namespace App\Http\Controllers\Admin;

use App\Helpers\Aid;
use App\Http\Controllers\Controller;
use Exception;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Log;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class PermissionController extends Controller {
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index(): Response {
        $data = [
            'permissions' => Permission::all(),
            'roles'       => Role::all(),
        ];

        return response()->view('Admin.Users.Roles.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create(): Response {
        return response()->view('Admin.Users.Roles.upsert');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return RedirectResponse
     */
    public function store(Request $request): RedirectResponse {
        $data = explode(',', $request->input('name'));

        $permissions = [];
        foreach($data as $permission) {
            $permissions[] = ['name' => $permission, 'created_at' => now(), 'updated_at' => now()];
        }

        try {
            Permission::insert($permissions);

            return Aid::createOk('Created successfully!', 'admin.permission.index');
        } catch(Exception $e) {
            Log::error($e->getMessage());

            return Aid::returnToastError($e->getMessage(), 'Error creating permissions');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return Response
     */
    public function show(int $id): Response {
        $data['permission'] = Permission::with('roles')->withCount('users')->find($id);

        return response()->view('Admin.Users.Roles.show', $data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return Response
     */
    public function edit(int $id): Response {
        $data['permission'] = Permission::findById($id);

        return response()->view('Admin.Users.Roles.upsert', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param int     $id
     * @return RedirectResponse
     */
    public function update(Request $request, int $id): RedirectResponse {
        try {
            Permission::findById($id)->update($request->except(['_token', '_method']));

            return Aid::updateOk('Update successful!', 'admin.permission.index');
        } catch(Exception $e) {
            Log::error($e->getMessage());

            return Aid::returnToastError($e->getMessage(), 'Error updating permission');
        }
    }
}
