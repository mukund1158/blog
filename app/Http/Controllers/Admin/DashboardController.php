<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\image;
use App\Services\UserServices;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    /**
     * DashboardController constructor.
     *
     * @param  UserServices  $services
     */
    public function __construct(
        protected UserServices $services
    ) {
    }

    /**
     * For search single user and list all users.
     *
     * @param  Request  $request
     * @return Illuminate\Contracts\View\View
     */
    public function dashboard(Request $request)
    {
        $search = $request->search;
        $data = $this->services->list($search);

        return view('admin.dashboard', compact('data'));
    }

    /**
     * View form for upload multiple image.
     *
     * @return Illuminate\Contracts\View\View
     */
    public function multiple()
    {
        return view('admin/multipleImage');
    }

    /**
     * For upload multiple image.
     *
     * @param  Request  $request
     * @return mixed
     */
    public function uploadImage(Request $request)
    {
        if ($request->hasFile('photos')) {
            $this->services->multiImageUpload($request);

            return redirect('admin/showMultiple');
        } else {
            return 'failed';
        }
    }

    /**
     * View multiple image page.
     *
     * @return Illuminate\Contracts\View\View
     */
    public function showUploadImage()
    {
        $data = image::all();

        return view('admin/viewMultipleImage', compact('data'));
    }
}
