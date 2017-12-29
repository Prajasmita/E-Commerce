<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Coupon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CouponsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\View\View
     */
    public function index(Request $request)
    {
        $coupons = array();
        $result = array();
        if($request->ajax()) {

            $totalRecords=Coupon::count();
            $limit=$request->input('length');
            if($limit == -1){
                $limit = $totalRecords;
            }
            $offset=$request->input('start');
            $search=$request->input('search');
            $search_word=trim($search['value']);
            $draw = $request->input('draw');
            $column = $request->input('columns');
            $order = $request->input('order');
            $sortBy = $order[0]['column'];
            $sortOf = $order[0]['dir'];
            $code = $column[$sortBy]['data'];
            $coupons = Coupon::select('id','code','percent_off');
            if ($search_word != '' ) {

                $coupons = Coupon::where('code', 'LIKE', "%$search_word%")
                    ->orWhere('percent_off', 'LIKE', "%$search_word%");
            }
                $coupons = $coupons
                    ->skip($offset)
                    ->take($limit)
                    ->orderBy($code , $sortOf)
                    ->get();

            if ($search_word != '' ) {
                $recordsFiltered = $coupons->count();
                $recordsTotal = $coupons->count();

            }else{
                $recordsFiltered = Coupon::count();
                $recordsTotal = Coupon::count();
            }
                $final = array();
                foreach($coupons as $key => $val){
                    $res_data = array();
                    $res_data['id'] = $val['id'];
                    $res_data['code'] = $val['code'];
                    $res_data['percent_off'] = $val['percent_off'];
                    $final[] = $res_data;
                }
                $result['draw'] = $draw;
                $result['recordsFiltered'] =$recordsFiltered;
                $result['recordsTotal'] = $recordsTotal;
                $result['data'] =   $final;

            return $result;
        }

        $authUser = Auth::user();

        return view('admin.coupons.index', compact('coupons','authUser'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {

        $authUser = Auth::user();

        return view('admin.coupons.create',array('authUser'=>$authUser));
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
            'code' => 'required|alpha_num',
            'percent_off' => 'required|numeric',
        ]);

        $requestData = $request->all();
        
        Coupon::create($requestData);

        return redirect('admin/coupons')->with('flash_message', 'Coupon added!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     *
     * @return \Illuminate\View\View
     */
    public function show($id)
    {
        $coupon = Coupon::findOrFail($id);

        $authUser = Auth::user();

        return view('admin.coupons.show', compact('coupon','authUser'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     *
     * @return \Illuminate\View\View
     */
    public function edit($id)
    {
        $coupon = Coupon::findOrFail($id);

        $authUser = Auth::user();

        return view('admin.coupons.edit', compact('coupon','authUser'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param  int  $id
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function update(Request $request, $id)
    {
        request()->validate([
            'code' => 'required|alpha_num',
            'percent_off' => 'required|numeric',
        ]);
        $requestData = $request->all();
        
        $coupon = Coupon::findOrFail($id);
        $coupon->update($requestData);

        return redirect('admin/coupons')->with('flash_message', 'Coupon updated!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function destroy($id)
    {
        Coupon::destroy($id);

        return redirect('admin/coupons')->with('flash_message', 'Coupon deleted!');
    }
}
