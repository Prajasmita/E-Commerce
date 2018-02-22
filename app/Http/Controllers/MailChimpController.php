<?php
/*
 * Class MailChimpController for newsletters using mailchimp.
 *
 * Created by Prajakta Sisale.
 *
 */

namespace App\Http\Controllers;

use Illuminate\Http\Request;
Use Validator;
Use App\Helper\Custom;

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
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function addSubscriber(Request $request)
    {

        $this->validate($request, [
            'email' => 'required|email'
        ]);

        try {

            if ($this->mailchimp
                ->lists
                ->subscribe(
                    $this->listId,
                    ['email' => $request->input('email')]
                )) {

                return redirect('/')->with('subscriber', 'Email Subscribed successfully');

            }
        } catch (\Mailchimp_List_AlreadySubscribed $e) {
            return redirect('/')->with('subscribers', 'Email is Already Subscribed');
        } catch (\Mailchimp_Error $e) {

            return redirect('/')->with('subscribers', 'Error from MailChimp');
        }

    }
}


