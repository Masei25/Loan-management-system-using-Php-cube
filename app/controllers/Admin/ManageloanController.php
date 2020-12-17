<?php

namespace App\Controllers\Admin;

use App\Models\LoanModel;
use App\Core\Http\Request;
use App\Models\UsersModel;
use App\Core\Http\Response;
use App\Core\Http\Controller;
use App\Models\LoanstatusModel;

class ManageloanController extends Controller
{
    public function displayloan(Request $request, Response $response)
    {   
        $loanid = $request->id; 
      
        $loanDetail = LoanModel::select()
                    ->where('id', $loanid)
                    ->fetchOne();
                
        $userid = $loanDetail->userid;
        
        $userDetail = UsersModel::select()
                    ->where('id', $userid)
                    ->fetchOne();
      
        return $response->view('/admin/manageloan', [
            'user' => $userDetail,
            'loan' => $loanDetail,
        ]);
    }

    public function manageloan(Request $request, Response $response)
    {
        $id = $request->id;
        $status = $request->input('status');
        $loanDetail = LoanModel::select()
                    ->where('userid', $id)
                    ->fetchOne();

        $userid = $loanDetail;
        $amount = $loanDetail->amount;
        $loanNumber = $loanDetail->loannumber;
      
        $duedate = date('d-m-Y', strtotime(' +30 day'));
       
        LoanModel::findByPrimaryKeyAndUpdate($id, [
            'status' => $status,
            'duedate' => $duedate
        ]);

        $msg = 'status updated';
        return $response->withSession('msg', $msg)->redirect('/');
    }
}