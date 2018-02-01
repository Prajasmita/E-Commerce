<?php

namespace App\Http\Controllers\Admin;

use App\Helper\Custom;
use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Email_template;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use PharIo\Manifest\Email;

/**
 * Class emailTemplateController for CRUD operation of  email Templates.
 *
 * Author : Prajakta Sisale.
 */
class emailTemplateController extends Controller
{
    /**
     * Function to display email template list.
     *
     */

    public function emailTemplate(Request $request)
    {
        $templates = array();
        $result = array();
        if($request->ajax()) {

            $totalRecords=Email_template::count();
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
            $title = $column[$sortBy]['data'];
            $subject = $column[$sortBy]['data'];
            $templates = Email_template::select('id','title','subject','content');
            if ($search_word != '' ) {

                $templates = Email_template::where('title', 'LIKE', "%$search_word%")
                    ->orWhere('subject', 'LIKE', "%$search_word%");
            }
            $templates = $templates
                ->skip($offset)
                ->take($limit)
                ->orderBy($title , $sortOf)
                ->orderBy($subject ,$sortOf)
                ->get();

            if ($search_word != '' ) {
                $recordsFiltered = $templates->count();
                $recordsTotal = $templates->count();

            }else{
                $recordsFiltered = Email_template::count();
                $recordsTotal = Email_template::count();
            }
            $final = array();
            foreach($templates as $key => $val){
                $res_data = array();
                $res_data['id'] = $val['id'];
                $res_data['title'] = $val['title'];
                $res_data['subject'] = $val['subject'];
                $res_data['content'] = $val['content'];
                $final[] = $res_data;
            }
            $result['draw'] = $draw;
            $result['recordsFiltered'] =$recordsFiltered;
            $result['recordsTotal'] = $recordsTotal;
            $result['data'] =   $final;

            return $result;
        }

        $authUser = Auth::user();
        return view('admin.email_template.index', compact('templates','authUser'),array('js'=>'template_listing'));

    }

    /**
     * Function to display create email template view.
     *
     */
    Public function create()
    {

        $authUser = Auth::user();

        return view('admin.email_template.create', array('authUser' => $authUser));

    }

    /**
     * Store a newly created template in storage.
     *
     */
    public function store(Request $request)
    {
        request()->validate([
            'title' => 'required',
            'subject' => 'required',
            'content' => 'required'
        ]);

        $requestData = $request->all();

        Email_template::create($requestData);

        return redirect('admin/email_template')->with('template_message', 'Email Template Added !!!');

    }
    /**
     * Display the specified Template.
     *
     */
    public function show($id)
    {
        $template = Email_template::findOrFail($id);

        //$template['content'] = strip_tags($template->content);

        //Custom::showAll($template);die;
        $authUser = Auth::user();

        return view('admin.email_template.show', compact('template','authUser'));
    }

    /**
     * Show the form for editing the specified template.
     *
     */
    public function edit($id)
    {
        $template = Email_template::findOrFail($id);

        $authUser = Auth::user();

        return view('admin.email_template.edit', compact('template','authUser'));
    }

    /**
     * Update the specified template in storage.
     *
     */
    public function update(Request $request, $id)
    {
        request()->validate([
            'title' => 'required',
            'subject' => 'required',
        ]);
        $requestData = $request->all();

        $template = Email_template::findOrFail($id);
        $template->update($requestData);

        return redirect('admin/email_template')->with('template_message', 'Email Template updated!');
    }






}
















