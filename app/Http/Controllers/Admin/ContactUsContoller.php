<?php
namespace App\Http\Controllers\Admin;

use App\Contact_us;
use App\Helper\Custom;
use App\Http\Controllers\Controller;
use App\Http\Requests;
use Illuminate\Http\Request;
use PhpParser\Node\Stmt\Return_;
Use Auth;

/**
* Class Contact us Controller for check message and reply.
*
* Author : Prajakta Sisale.
*/

class ContactUsContoller extends Controller
{

    /**
     * Display a list of the users queries.
     *
     * @return \Illuminate\View\View
     */
    public function index(Request $request)
    {
        $queries = array();
        $result = array();

        if($request->ajax()) {

            //echo "hello";die;

            $totalRecords=Contact_us::count();
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
            $name = $column[$sortBy]['data'];
            $email = $column[$sortBy]['data'];
            $id = $column[$sortBy]['data'];

            $queries = Contact_us::select('id','name','email','contact_no','message','note_admin','subject');

            if ($search_word != '' ) {
                $queries = Contact_us::where('name', 'LIKE', "%$search_word%")
                    ->orWhere('email', 'LIKE', "%$search_word%");
            }

            $queries = $queries->skip($offset)
                ->take($limit)
                ->orderBy($id, $sortOf)
                ->orderBy($name, $sortOf)
                ->orderBy($email, $sortOf)
                ->get();
            if ($search_word != '' ) {

                $recordsFiltered = $queries->count();
                $recordsTotal = $queries->count();
            }else{
                $recordsFiltered = Contact_us::count();
                $recordsTotal = Contact_us::count();
            }
            $final = array();
            foreach($queries as $key => $val){
                $res_data = array();
                $res_data['id'] = $val['id'];
                $res_data['name'] = $val['name'];
                $res_data['email'] = $val['email'];
                $res_data['contact_no'] = $val['contact_no'];
                $res_data['message'] = $val['message'];
                $res_data['note_admin'] = $val['note_admin'];
                $final[] = $res_data;
            }

            $result['draw'] = $draw;
            $result['recordsFiltered'] = $recordsFiltered;
            $result['recordsTotal'] = $recordsTotal;
            $result['data'] =   $final;

            return $result;
        }

        $authUser = Auth::user();

        Return view('admin.contactus.contact_admin',array('authUser' => $authUser ,'queries'=>$queries,'js'=>'user_queries_listing'));

    }

    /**
     * Display a form for admin reply
     *
     * @return \Illuminate\View\View
     */
    public function adminNote($id){

        $authUser = Auth::user();

        $query_data = Contact_us::where('id','=',$id)->first();

        //Custom::showAll($query_data->id);die;
        return view('admin.contactus.admin_note',array('authUser'=>$authUser,'query_data'=>$query_data));
    }

    public function saveAdminNote(Request $request){

        if($this->validate($request, [
            'note_admin'=> 'required',
        ])) {
            Contact_us::where('id', '=', $request->id)->update(array('note_admin' => $request->note_admin));

            return redirect('admin/contactus')->with('admin_note', 'Successfully replied to the query !!!!');

        }

    }

}