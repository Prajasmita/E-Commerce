<?php

namespace App\Http\Controllers\Admin;

use App\Category_product;
use App\Helper\Custom;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Category;
use Illuminate\Http\Request;
use DB;
use Illuminate\Support\Facades\Log;

/**
 * Class CategoriesController for CRUD operation of categories.
 *
 * Author : Prajakta Sisale.
 */
class CategoriesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\View\View
     */
    public function index(Request $request)
    {

        $categories = array();
        $result = array();

        if ($request->ajax()) {

            $totalRecords = Category::count();
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
            $name = $column[$sortBy]['data'];

            $categories = Category::leftJoin('categories as cat', 'categories.parent_id', '=', 'cat.id')
                ->select('categories.id', 'categories.name', 'cat.name as pname','categories.status');
            if ($search_word != '') {
                $recordsFiltered = $categories->count();
                $recordsTotal = $categories->count();

            } else {
                $recordsFiltered = Category::count();
                $recordsTotal = Category::count();
            }
            if ($search_word != '') {

                $categories->where('categories.name', 'LIKE', "%$search_word%")
                    ->orWhere('categories.parent_id', 'LIKE', "%$search_word%");

            }
            $categories = $categories->skip($offset)
                ->take($limit)
                ->orderBy($name, $sortOf)
                ->get();

            $cat_having_products = Category_product::get();
            $cat = array();

            foreach ($cat_having_products as $key => $list) {
                array_push($cat, $list->category_id);
            }
            $category = array_unique($cat);


            $final = array();
            foreach ($categories as $key => $val) {

                $res_data = array();

                if(in_array($val->id,$category)){
                    $res_data['flag'] = 'true';
                }
                else{
                    $res_data['flag'] = 'false';
                }
                $res_data['id'] = $val['id'];
                $res_data['name'] = $val['name'];
                $val['pname'] == null ? $res_data['category'] = 'Parent Category' : $res_data['category'] = $val['pname'];
                $res_data['status'] = $val['status'];
                $final[] = $res_data;
            }

            //Custom::showAll($category);die;

            $result['draw'] = $draw;
            $result['recordsFiltered'] = $recordsFiltered;
            $result['recordsTotal'] = $recordsTotal;
            $result['data'] = $final;

            //Custom::showAll($result['data']);die;

            return $result;
        }


        $authUser = Auth::user();

        return view('admin.categories.index', array('authUser' => $authUser, 'categories' => $categories,'js' => 'categories_listing'));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {

        $category = Category::where('parent_id', '=', '0')
            ->get();

        $authUser = Auth::user();

        return view('admin.categories.create', array('authUser' => $authUser, 'category' => $category));

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
            'name' => 'required',
            'parent_id' => 'required'
        ]);

        $requestData = $request->all();

        Category::create($requestData);

        return redirect('admin/categories')->with('flash_message', 'Category added!');

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
        $category = Category::leftJoin('categories as cat', 'categories.parent_id', '=', 'cat.id')
            ->select('categories.id', 'categories.name', 'cat.name as pname')
            ->where('categories.id', 'LIKE', "%$id%")
            ->get()->first();

        $authUser = Auth::user();

        return view('admin.categories.show', array('authUser' => $authUser, 'category' => $category));


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

        $selected_category = Category::findOrFail($id);

        $category = Category::where('parent_id', '=', '0')->get();

        $authUser = Auth::user();

        return view('admin.categories.edit', array('authUser' => $authUser, 'category' => $category, 'selected_category' => $selected_category));

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
            'name' => 'required',
            'parent_id' => 'required'
        ]);
        $requestData = $request->all();

        $category = Category::findOrFail($id);
        $category->update($requestData);

        return redirect('admin/categories')->with('flash_message', 'Category updated!');
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
        Category::destroy($id);

        return redirect('admin/categories')->with('flash_message', 'Category deleted!');
    }
}
