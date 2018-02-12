<?php
/**
 * Created by Prajakta Sisale.
 * User: webwerks
 * Date: 12/2/18
 * Time: 12:57 PM
 */

namespace App\Http\Controllers;
use Illuminate\Http\Request;
Use Validator;
Use App\Helper\Custom;

/* Class MailChimpController for mailchimp */

class MailChimpController extends Controller
{

    public $mailchimp;
    public $listId = '25ef8b5ed0';


    public function __construct(\Mailchimp $mailchimp)
    {
        $this->mailchimp = $mailchimp;
    }


    /*
     * Function for newsletters subscription
     *
     */
    public function addSubscriber(Request $request){

        $this->validate($request, [
            'email' => 'required|email'
        ]);

       //Custom::showAll(['email' => $request->input('email')]);die;

        try {

            if($this->mailchimp
                ->lists
                ->subscribe(
                    $this->listId,
                    ['email' => $request->input('email')]
                )){

                return redirect('/')->with('subscriber','Email Subscribed successfully');

            }
        }
        catch (\Mailchimp_List_AlreadySubscribed $e) {
            return redirect('/')->with('subscribers','Email is Already Subscribed');
        }
        catch (\Mailchimp_Error $e) {

            //Custom::showAll($e);die;
            return redirect('/')->with('subscribers','Error from MailChimp');
        }

    }

}