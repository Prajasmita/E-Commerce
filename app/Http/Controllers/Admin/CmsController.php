<?php

/**
 * Class CmsController for CRUD operation for cms management.
 *
 * Author : Prajakta Sisale.
 */
namespace App\Http\Controllers\Admin;

use App\Cms;
use App\Helper\Custom;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CmsController extends Controller
{
    /**
     * Display a listing of the cms.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\View\View
     */
    public function index(Request $request)
    {

        $result = array();
        $cms = array();
        if ($request->ajax()) {

            $totalRecords = Cms::count();
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
            $title = $column[$sortBy]['data'];

            $cms = Cms::select('id', 'title', 'content');
            if ($search_word != '') {

                $cms = Cms::where('title', 'LIKE', "%$search_word%");
            }
            $cms = $cms
                ->skip($offset)
                ->take($limit)
                ->orderBy($title, $sortOf)
                ->get();

            if ($search_word != '') {
                $recordsFiltered = $cms->count();
                $recordsTotal = $cms->count();

            } else {
                $recordsFiltered = Cms::count();
                $recordsTotal = Cms::count();
            }
            $final = array();
            foreach ($cms as $key => $val) {
                $res_data = array();
                $res_data['id'] = $val['id'];
                $res_data['title'] = $val['title'];
                $res_data['content'] = $val['content'];
                $final[] = $res_data;
            }
            $result['draw'] = $draw;
            $result['recordsFiltered'] = $recordsFiltered;
            $result['recordsTotal'] = $recordsTotal;
            $result['data'] = $final;

            return $result;
        }

        $authUser = Auth::user();

        return view('admin.cms.index', compact('cms', 'authUser'), array('js' => 'cms_listing'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {

        $authUser = Auth::user();

        return view('admin.cms.create', array('authUser' => $authUser));
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
        request()->validate([
            'title' => 'required',
            'content' => 'required'
        ]);

        $requestData = $request->all();

        Cms::create($requestData);

        return redirect('admin/cms')->with('flash_message', 'Content added!');
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
        $cms = Cms::findOrFail($id);

        $authUser = Auth::user();

        return view('admin.cms.show', compact('cms', 'authUser'));
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
        $cms = Cms::findOrFail($id);

        $authUser = Auth::user();

        return view('admin.cms.edit', compact('cms', 'authUser'));
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
        request()->validate([
            'title' => 'required',
            'content' => 'required',
        ]);
        $requestData = $request->all();

        $cms = Cms::findOrFail($id);
        $cms->update($requestData);

        return redirect('admin/cms')->with('flash_message', 'Content updated!');
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
        Cms::destroy($id);

        return redirect('admin/cms')->with('flash_message', 'Content deleted!');
    }

}
