<?php

namespace App\Controllers\Dashboard;

use App\Core\Tools\Auth;
use App\Models\LoanModel;
use App\Core\Http\Request;
use App\Models\UsersModel;
use App\Core\Http\Response;
use App\Core\Http\Controller;

class MainController extends Controller
{
    public function index(Request $request, Response $response)
    {   
        $user = $request->user();
        $userid = $user->id();

        $loans = LoanModel::select()
                    ->where('userid', $user->id())
                    ->fetchAll();

        $approved = LoanModel::select()
                    ->where('userid', $user->id())
                    ->and('status', 1)
                    ->fetchAll();
                   
        $rejected = LoanModel::select()
                    ->where('userid', $user->id())
                    ->and('status', 2)
                    ->fetchAll();

        $currentUser = UsersModel::findByPrimaryKey($userid);
        $total_loan = $currentUser->total_loan;

        return $response->view('dashboard.index', [
            'loans' => $loans,
            'approved' => $approved,
            'rejected' => $rejected,
            'total_loan' => $total_loan
        ]);
    }

    public function logout(Request $request, Response $response){
        Auth::logout();
        return $response->redirect('/');
    }
}