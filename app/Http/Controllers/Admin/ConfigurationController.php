<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Configuration;
use Illuminate\Http\Request;
use App\Helper\Custom;
use Illuminate\Support\Facades\Auth;

/**
 * Class ConfigurationController for CRUD operation of Configurations.
 *
 * Author : Prajakta Sisale.
 */
class ConfigurationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\View\View
     */
    public function index(Request $request)
    {

        $configuration = array();
        $result = array();

        if ($request->ajax()) {

            $totalRecords = Configuration::count();
            $limit = $request->input('length');
            if ($limit == -1) {
                $limit = $totalRecords;
            }
            $offset = $request->input('start');
            $search = $request->input('search');
            $keyword = $search['value'];
            $search_word = trim($keyword, ' ');
            $draw = $request->input('draw');


            $column = $request->input('columns');

            $order = $request->input('order');

            $sortBy = $order[0]['column'];

            $sortOf = $order[0]['dir'];

            $conf_key = $column[$sortBy]['data'];

            $configuration = Configuration::select('id', 'conf_key', 'conf_value');
            if ($keyword != '') {

                $configuration = Configuration::where('conf_key', 'LIKE', "%$search_word%")
                    ->orWhere('conf_value', 'LIKE', "%$search_word%");

            }


            $configuration = $configuration
                ->skip($offset)
                ->take($limit)
                ->orderBy($conf_key, $sortOf)
                ->get();

            if ($search_word != '') {
                $recordsFiltered = $configuration->count();
                $recordsTotal = $configuration->count();

            } else {
                $recordsFiltered = Configuration::count();
                $recordsTotal = Configuration::count();
            }

            $final = array();
            foreach ($configuration as $key => $val) {
                $res_data = array();
                $res_data['id'] = $val['id'];
                $res_data['conf_key'] = $val['conf_key'];
                $res_data['conf_value'] = $val['conf_value'];
                $final[] = $res_data;
            }

            $result['draw'] = $draw;
            $result['recordsFiltered'] = $recordsFiltered;
            $result['recordsTotal'] = $recordsTotal;
            $result['data'] = $final;

            return $result;
        }

        $authUser = Auth::user();

        return view('admin.configuration.index', array('authUser' => $authUser, 'configuration' => $configuration, 'js' => 'configuration_listing'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {

        $authUser = Auth::user();

        return view('admin.configuration.create', array('authUser' => $authUser));
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
            'conf_key' => 'required',
            'conf_value' => 'required',
            'status' => 'required'
        ]);

        $requestData = $request->all();

        Configuration::create($requestData);

        return redirect('admin/configuration')->with('flash_message', 'Configuration added!');
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
        $configuration = Configuration::findOrFail($id);

        $authUser = Auth::user();

        return view('admin.configuration.show', array('authUser' => $authUser, 'configuration' => $configuration));
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
        $configuration = Configuration::findOrFail($id);

        $authUser = Auth::user();

        return view('admin.configuration.edit', array('authUser' => $authUser, 'configuration' => $configuration));
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
            'conf_key' => 'required',
            'conf_value' => 'required'
        ]);

        $requestData = $request->all();

        $configuration = Configuration::findOrFail($id);
        $configuration->update($requestData);

        return redirect('admin/configuration')->with('flash_message', 'Configuration updated!');
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
        Configuration::destroy($id);

        return redirect('admin/configuration')->with('flash_message', 'Configuration deleted!');
    }
}
