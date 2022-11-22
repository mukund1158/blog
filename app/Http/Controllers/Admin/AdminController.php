<?php

namespace App\Http\Controllers\Admin;

use App\Exports\UserExport;
use App\Exports\UserTemplate;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Imports\ImportUser;
use App\Models\User;
use App\Services\UserServices;
use Illuminate\Auth\Access\Response;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Log;
use Maatwebsite\Excel\Facades\Excel;
use PDF;

class AdminController extends Controller
{
    /**
     * AdminController constructor.
     *
     * @param  UserServices  $services
     * @param  User  $user
     */
    public function __construct(
        protected UserServices $service,
        protected User $user,
    ) {
    }

    /**
     * Show the application registration form.
     *
     * @return Illuminate\Contracts\View\View
     */
    public function showRegisterForm()
    {
        return view('admin/register');
    }

    /**
     * For store a new user.
     *
     * @param  StoreUserRequest  $request
     * @return User
     */
    public function storeUser(StoreUserRequest $request)
    {
        try {
            $data = $request->validated();
            $this->service->store($data);

            return redirect('admin/dashboard');
        } catch (\Exception $exception) {
            Log::error($exception->getMessage());
        }
    }

    /**
     * For delete an user.
     *
     * @param  int  $id
     * @return mixed
     */
    public function deleteUser($id)
    {
        try {
            $this->user->find($id)->delete();

            return redirect('admin/dashboard');
        } catch (\Exception $exception) {
            Log::error($exception->getMessage());
        }
    }

    /**
     * For edit an user.
     *
     * @param  int  $id
     * @return Illuminate\Contracts\View\View
     */
    public function editUser($id)
    {
        try {
            $data = $this->user->findOrFail($id);

            return view('admin/edit', compact('data'));
        } catch (\Exception $exception) {
            Log::error($exception->getMessage());
        }
    }

    /**
     * For update an user.
     *
     * @param  UpdateUserRequest  $request
     * @return mixed
     */
    public function updateUser(UpdateUserRequest $request)
    {
        try {
            $data = $request->validated();
            $this->service->store($data);

            return redirect('admin/dashboard');
        } catch (\Exception $exception) {
            Log::error($exception->getMessage());
        }
    }

    /**
     * For download an user data in excel file.
     *
     * @return mixed
     */
    public function export()
    {
        try {
            return Excel::download(new UserExport(), 'user.xlsx');
        } catch (\Exception $exception) {
            Log::error($exception->getMessage());
        }
    }

    /**
     * Import an user data through excel file.
     *
     * @return mixed
     */
    public function import()
    {
        try {
            Excel::import(new ImportUser(), request()->file('user'));

            return redirect('admin/dashboard');
        } catch (\Exception $exception) {
            Log::error($exception->getMessage());
        }
    }

    /**
     * For download an user data in pdf file.
     *
     * @return mixed
     */
    public function downloadPdf()
    {
        try {
            $datas = $this->service->list(null);
            $pdf = PDF::loadView('myPdf', ['datas' => $datas]);

            return $pdf->download('myPdf.pdf');
        } catch (\Exception $exception) {
            Log::error($exception->getMessage());
        }
    }

    /**
     * For download an user data template excel file.
     *
     * @return mixed
     */
    public function template()
    {
        try {
            return Excel::download(new UserTemplate(), 'template.xlsx');
        } catch (\Exception $exception) {
            Log::error($exception->getMessage());
        }
    }

    /**
     * Define gate to authorize
     *
     * @return mixed
     */
    public function gate()
    {
        try {
            Gate::allows('isAdmin') ? Response::allow() : abort(403);

            return 'Authorize';
        } catch (\Exception $exception) {
            Log::error($exception->getMessage());
        }
    }

    /**
     * For list the admin and super-admin data with role and permission.
     *
     * @return Illuminate\Contracts\View\View
     */
    public function adminList()
    {
        try {
            $users = $this->user->with('roles')->Admin()->with('permissions')->get();

            return view('admin/adminList', compact('users'));
        } catch (\Exception $exception) {
            Log::error($exception->getMessage());
        }
    }

    /**
     * Show the add role form.
     *
     * @return Illuminate\Contracts\View\View
     */
    public function addRoleForm()
    {
        try {
            $users = $this->service->list(null);

            return view('admin/addRole', compact('users'));
        } catch (\Exception $exception) {
            Log::error($exception->getMessage());
        }
    }

    /**
     * Add role to user.
     *
     * @param  Request  $request
     * @return mixed
     */
    public function addRole(Request $request)
    {
        try {
            $user = $this->user->find($request->name);
            $user->syncRoles($request->role);

            return redirect('admin/list');
        } catch (\Exception $exception) {
            Log::error($exception->getMessage());
        }
    }

    /**
     * For change the local language.
     *
     * @param  Request  $request
     * @param  string  $language
     * @return mixed
     */
    public function languages(Request $request, $language)
    {
        try {
            if (array_key_exists($language, Config::get('languages'))) {
                session(['appLanguage' => $language]);
            }

            return redirect()->back();
        } catch (\Exception $exception) {
            Log::error($exception->getMessage());
        }
    }
}
