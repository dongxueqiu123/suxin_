<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Eloquent\CompaniesModel;
use App\Eloquent\UsersModel;
use Illuminate\Http\Request;

class CompaniesController extends Controller
{

    public function __construct()
    {
        $this->companies = new CompaniesModel();
        $this->users = new UsersModel();
        $this->middleware('auth.user');
    }

    public function index()
    {
        $companies = $this->companies->all();
        return view('companies.list',
            [
                'companies' => $companies,
                'active' => 'companies',
                'boxTitle'=>'修改公司',
            ]
        );
    }

    public function edit($id,Request $request){
        $company = $this->companies::find($id);
        return view('companies.edit',
            [
                'company' => $company,
                'route' => route('api.companies.edit',['id'=>$id]),
                'active' => 'companies',
                'boxTitle'=>'修改公司信息',
            ]
        );
    }

    public function store(Request $request){
        $users = $this->users->where('id','!=','1')->where('companyId','=','0')->get();
        return view('companies.edit',
            [
                'route' => route('api.companies.store'),
                'active' => 'companies',
                'users'  =>  $users,
                'boxTitle'=>'添加公司',
            ]
        );
    }
    
}
