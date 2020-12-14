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
        $user = $request->user();
        $loans = LoanModel::select()
                    ->where('userid', $user->id())
                    ->fetchAll();
        return $response->view('dashboard.index', [
            'loans' => $loans 
        ]);
    }

    public function logout(Request $request, Response $response){
        Auth::logout();
        return $response->redirect('/');
    }
}