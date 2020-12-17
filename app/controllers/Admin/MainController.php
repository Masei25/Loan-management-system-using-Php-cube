<?php

namespace App\Controllers\Admin;

use App\Core\Tools\Auth;
use App\Models\LoanModel;
use App\Core\Http\Request;
use App\Core\Http\Response;
use App\Core\Http\Controller;

class MainController extends Controller
{
    public function index(Request $request, Response $response)
    {   

        $user = Auth::user();
        $loans = LoanModel::select()
                    ->where('status', 0)
                    ->fetchAll();
        
        $approved = LoanModel::select()
                    ->where('status', 1)
                    ->fetchAll();
                    
        $rejected = LoanModel::select()
                    ->where('status', 2)
                    ->fetchAll();

        return $response->view('/admin/index', [
            'loans' => $loans,
            'approved' => $approved,
            'rejected' => $rejected
        ]);
    }

    public function members(Request $request, Response $response)
    {
        return $response->view('admin/members');
    }

    public function logout(Request $request, Response $response)
    {
        Auth::logout();
        return $response->redirect('/');
    }
}