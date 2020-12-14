<?php

namespace App\Controllers\Dashboard;

use App\Core\Tools\Auth;
use App\Models\LoanModel;
use App\Core\Http\Request;
use App\Core\Http\Response;
use App\Core\Http\Controller;

class ApplyController extends Controller
{
    public function apply(Request $request, Response $response)
    {   

        return $response->view('dashboard.apply');
    }

    public function applyAction(Request $request, Response $response)
    {  
        $user = $request->user();
        $amount = $request->input('amount');
        $loannumber = rand();
        $transpin = $request->input('transpin');
        $transpin2 = $request->input('transpin2');
        $duedate = date('d-m-Y', strtotime(' +30 day'));
        
        if(strval($amount) > 200000){
            return $response->withSession('msg', 'Amount is above limit')->redirect($request->url()->getPath());
        }

        $amount->validate('required');
        $transpin->validate('required')->equals($transpin2, 'Incorrect transaction pin');

        LoanModel::createEntry([
            'userid' => $user->id(),
            'amount' => $amount,
            'loannumber' => $loannumber,
            'duedate' => $duedate,
        ]);

        $msg = 'Loan application successful';
        return $response->withSession('msg', $msg)->redirect('/dashboard');

    }
}