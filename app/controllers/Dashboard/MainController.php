<?php

namespace App\Controllers\Dashboard;

use App\Core\Tools\Auth;
use App\Models\LoanModel;
use App\Core\Http\Request;
use App\Core\Http\Response;
use App\Core\Http\Controller;

class MainController extends Controller
{
    public function index(Request $request, Response $response)
    {   
        $user = $request->user()->id();
     
        $loans = LoanModel::select()
                    ->where('userid', $user)
                    ->fetchAll();
        
        $approved = LoanModel::select()
                    ->where('userid', $user)
                    ->and('status', 1)
                    ->fetchAll();
                   
        $rejected = LoanModel::select()
                    ->where('userid', $user)
                    ->and('status', 2)
                    ->fetchAll();

        return $response->view('dashboard.index', [
            'loans' => $loans,
            'approved' => $approved,
            'rejected' => $rejected
        ]);
    }

    public function logout(Request $request, Response $response){
        Auth::logout();
        return $response->redirect('/');
    }
}