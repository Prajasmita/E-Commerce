<?php

namespace App\Http\Controllers\Admin;

use App\Helper\Custom;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Banner;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
Use Illuminate\Support\Carbon;

/**
 * Class BannersController for CRUD operation of banner images.
 *
 * Author : Prajakta Sisale.
 */
class BannersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\View\View
     */
    public function index(Request $request)
    {
        $banners = array();
        $result = array();

        if ($request->ajax()) {

            $totalRecords = Banner::count();
            $limit = $request->input('length');
            if ($limit == -1) {
                $limit = $totalRecords;
            }
            $offset = $request->input('start');
            $search = $request->input('search');
            $search_word = trim($search['value']);
            $draw = $request->input('draw');
            $column = $request->input('columns');
            $order = $request->input('order');
            $sortBy = $order[0]['column'];
            $sortOf = $order[0]['dir'];
            $banner_name = $column[$sortBy]['data'];

            $banners = Banner::select('id', 'banner_name', 'banner_image','status');

            if ($search_word != '') {
                $banners = Banner::where('banner_name', 'LIKE', "%$search_word%")
                    ->orWhere('banner_image', 'LIKE', "%$search_word%");
            }

            $banners = $banners->skip($offset)
                ->take($limit)
                ->orderBy($banner_name, $sortOf)
                ->get();


            if ($search_word != '') {

                $recordsFiltered = $banners->count();
                $recordsTotal = $banners->count();
            } else {
                $recordsFiltered = Banner::count();
                $recordsTotal = Banner::count();
            }
            $final = array();
            foreach ($banners as $key => $val) {
                $res_data = array();
                $res_data['id'] = $val['id'];
                $res_data['banner_name'] = $val['banner_name'];
                $res_data['banner_image'] = $val['banner_image'];
                $res_data['status'] = $val['status'];
                $final[] = $res_data;
            }

            $result['draw'] = $draw;
            $result['recordsFiltered'] = $recordsFiltered;
            $result['recordsTotal'] = $recordsTotal;
            $result['data'] = $final;

            return $result;
        }

        $authUser = Auth::user();

        return view('admin.banners.index', array('authUser' => $authUser, 'banners' => $banners, 'js' => 'banner_listing'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        $authUser = Auth::user();

        return view('admin.banners.create', array('authUser' => $authUser));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function store(Request $request)
    {

        $requestData = array();

        $current_time = time();

        $this->validate($request, [
            'banner_name' => 'required',
            'banner_image' => 'mimes:jpeg,png,jpg|required|image|max:2048',
            'status' => 'required'

        ]);

        $image = $request->file('banner_image');
        $img_name = pathinfo($image->getClientOriginalName(), PATHINFO_FILENAME);
        $input['imagename'] = $img_name . '_' . $current_time . '.' . $image->getClientOriginalExtension();
        $destinationPath = 'img/banner';

        $image->move($destinationPath, $input['imagename']);
        $requestData['banner_name'] = $request->banner_name;
        $requestData['banner_image'] = $input['imagename'];
        $requestData['status'] = $request->status;

        Banner::create($requestData);

        return redirect('admin/banners')->with('flash_message', 'Banner added!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     *
     * @return \Illuminate\View\View
     */
    public function show($id)
    {

        $banner = Banner::findOrFail($id);

        $authUser = Auth::user();

        return view('admin.banners.show', array('authUser' => $authUser, 'banner' => $banner));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     *
     * @return \Illuminate\View\View
     */
    public function edit($id)
    {
        $banner = Banner::findOrFail($id);

        $authUser = Auth::user();

        return view('admin.banners.edit', array('authUser' => $authUser, 'banner' => $banner));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param  int $id
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function update(Request $request, $id)
    {
        $requestData = array();
        $this->validate($request, [
            'banner_name' => 'required',
            'banner_image' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
            'status' => 'required'

        ]);
        if ($request->banner_image) {
            $current_time = time();

            $image = $request->file('banner_image');
            $img_name = pathinfo($image->getClientOriginalName(), PATHINFO_FILENAME);

            $input['imagename'] = $img_name . '_' . $current_time . '.' . $image->getClientOriginalExtension();

            $destinationPath = 'img/banner';

            $image->move($destinationPath, $input['imagename']);
            $requestData['banner_image'] = $input['imagename'];
        }

        $requestData['banner_name'] = $request->banner_name;

        $requestData['status'] = $request->status;

        $banner = Banner::findOrFail($id);
        $banner->update($requestData);

        return redirect('admin/banners')->with('flash_message', 'Banner updated!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function destroy($id)
    {
        Banner::destroy($id);

        return redirect('admin/banners')->with('flash_message', 'Banner deleted!');
    }
}
