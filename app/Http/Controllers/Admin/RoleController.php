<?php

namespace App\Http\Controllers\Admin;

use App\Helpers\Aid;
use App\Http\Controllers\Controller;
use App\Models\User;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Log;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RoleController extends Controller {
    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return RedirectResponse
     */
    public function store(Request $request): RedirectResponse {
        $data = explode(',', $request->input('name'));

        $roles = [];
        foreach($data as $role) {
            $roles[] = [
                'name'       => $role,
                'created_at' => now(),
                'updated_at' => now()
            ];
        }

        try {
            Role::insert($roles);

            return Aid::createOk('Created successfully!', 'admin.permission.index');
        } catch(Exception $e) {
            Log::error($e->getMessage());

            return Aid::returnToastError($e->getMessage(), 'Error creating roles');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return Response
     */
    public function show(int $id): Response {
        $data['role'] = Role::with('permissions')->withCount('users')->find($id);

//        dd($data['role']);

        return response()->view('Admin.Users.Roles.show', $data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return Response
     */
    public function edit(int $id): Response {
        $data['role'] = Role::findById($id);

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
            Role::findById($id)->update($request->except([
                '_token',
                '_method'
            ]));

            return Aid::updateOk('Update successful!', 'admin.permission.index');
        } catch(Exception $e) {
            Log::error($e->getMessage());

            return Aid::returnToastError($e->getMessage(), 'Error updating role');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @return Response
     */
    public function showAssign(): Response {
        return response()->view('Admin.Users.Roles.assign');
    }

    public function storeAssign(Request $request): RedirectResponse {
        $action = $request->input('action');
        $users = $request->input('users');
        $roles = $request->input('roles');
        $permissions = $request->input('permissions');

        try {
            if($action === 'Give user(s) permission(s) to') {
                User::findMany($users)->each(function($user) use($permissions) {
                    $user->givePermissionTo($permissions);
                });
            } else if($action === 'Assign role(s) to user(s)') {
                User::findMany($users)->each(function($user) use($roles) {
                    foreach($roles as $role) {
                        $user->assignRole($role);
                    };
                });
            } else if($action === 'Sync permission(s) to user(s)') {
                User::findMany($users)->each(function($user) use($permissions) {
                    $user->syncPermissions($permissions);
                });
            } else if($action === 'Sync role(s) to user(s)') {
                User::findMany($users)->each(function($user) use($roles) {
                    $user->syncRoles($roles);
                });
            } else if($action === 'Give role(s) permission(s) to...') {
                Role::whereIn('name', $roles)->each(function($role) use ($permissions) {
                    foreach($permissions as $permission) {
                        $role->givePermissionTo($permission);
                    }
                });
            } else if($action === 'Remove role(s) from user(s)') {
                User::findMany($users)->each(function($user) use($roles) {
                    foreach($roles as $role) {
                        $user->removeRole($role);
                    }
                });
            } else if($action === 'Revoke permission(s) from user(s)') {
                User::findMany($users)->each(function($user) use($permissions) {
                    foreach($permissions as $permission) {
                        $user->revokePermissionTo($permission);
                    }
                });
            } else if($action === 'Revoke permission(s) from role(s)') {
                Role::whereIn('name', $roles)->each(function($role) use ($permissions) {
                    foreach($permissions as $permission) {
                        $role->revokePermissionTo($permission);
                    }
                });
            } else {
                return Aid::goWithError('admin.role.assign.index', 'Invalid action!');
            }

            return Aid::updateOk();
        } catch(Exception $e) {
            return Aid::returnToastError($e->getMessage(), 'Something went terribly wrong');
        }
    }

    public function getAssignData(): JsonResponse {
        $data = [
            'users'       => User::get([
                'id',
                'email'
            ]),
            'roles'       => Role::all([
                'id',
                'name'
            ]),
            'permissions' => Permission::all([
                'id',
                'name'
            ]),
            'actions' => [
                ['action' => 'Give user(s) permission(s) to'],
                ['action' => 'Give role(s) permission(s) to...'],
                ['action' => 'Assign role(s) to user(s)'],
                ['action' => 'Sync permission(s) to user(s)'],
                ['action' => 'Sync role(s) to user(s)'],
                ['action' => 'Remove role(s) from user(s)'],
                ['action' => 'Revoke permission(s) from user(s)'],
                ['action' => 'Revoke permission(s) from role(s)'],
            ]
        ];

        return response()->json($data);
    }
}
