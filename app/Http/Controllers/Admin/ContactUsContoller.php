<?php
namespace App\Http\Controllers\Admin;

use App\Contact_us;
use App\Helper\Custom;
use App\Http\Controllers\Controller;
use App\Http\Requests;
use Illuminate\Http\Request;
use PhpParser\Node\Stmt\Return_;
Use Auth;
Use App\Email_template;
Use Mail;

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

    /**
     * Function for storing admin reply as admin note.
     *
     */
    public function saveAdminNote(Request $request){

        if($this->validate($request, [
            'note_admin'=> 'required',
        ])) {

            Contact_us::where('id', '=', $request->id)->update(array('note_admin' => $request->note_admin));

            $Contact_us_details = Contact_us::where('id','=',$request->id)->first()->toArray();

            //Custom::showAll($Contact_us_details);die;
            $this->sendMail($Contact_us_details);

            return redirect('admin/contactus')->with('admin_note', 'Successfully replied to the query !!!!');

        }

    }

    /**
     * Function for sending mail to admin
     * about query through contact us form.
     *
     */
    public function sendMail($data){

        //Custom::showAll($data['email']);die;
        $template_content = Email_template::where('title','=','admin_note')->select('content')->first();

        $email = $data['email'];
        $string = array();
        $string[0] = '{{name}}';
        $string[1] = '{{email}}';
        $string[2] = '{{contact_no}}';
        $string[3] = '{{subject}}';
        $string[4] = '{{message}}';
        $string[5] = '{{admin_note}}';


        $replace=array();
        $replace[0] = $data['name'];
        $replace[1] = $data['email'];
        $replace[2] = $data['contact_no'];
        $replace[3] = $data['subject'];
        $replace[4] = $data['message'];
        $replace[5] = $data['note_admin'];

        $new_template_content = str_replace($string,$replace, $template_content->content);

        Mail::send([], [], function ($message) use ($new_template_content,$email)
        {
            $message->to($email)
                ->subject('Customer Message')
                ->setBody(html_entity_decode(strip_tags($new_template_content)));

        });
    }

}