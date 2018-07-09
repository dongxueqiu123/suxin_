<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Eloquent\CompaniesModel;
use App\Eloquent\UsersModel;
use Illuminate\Http\Request;
use App\Services\CompaniesServices;
use App\Services\UsersServices;

class CompaniesController extends Controller
{

    public function __construct()
    {
        $this->companies = new CompaniesModel();
        $this->companiesServices = new CompaniesServices();
        $this->usersServices =  new UsersServices();
        $this->users = new UsersModel();
        $this->middleware('auth.user');
    }

    public function index(Request $request)
    {
        $page = $request->input('page')??1;
        $companyResponses = $this->companiesServices->getApiList($this->companiesServices->getUrl(),self::PAGE_SIZE_DEFAULT,$page,[]);
        return view('companies.list',
            [
                'companies' => $companyResponses['data'],
                'active' => 'companies',
                'boxTitle'=>'修改公司',
            ]
        );
    }

    public function edit($id){
        $companyResponses = $this->companiesServices->getInfoClient($this->companiesServices->getRetrieveByIdUrl(),['id'=>$id]);
        return view('companies.edit',
            [
                'company' => $companyResponses['data'],
                'route' => route('api.companies.edit',['id'=>$id]),
                'active' => 'companies',
                'boxTitle'=>'修改公司信息',
            ]
        );
    }

    public function store(Request $request){
        $userResponses = $this->usersServices->getInfoClient($this->usersServices->getRetrieveAllAdministratorsUrl(),[]);
        return view('companies.edit',
            [
                'route' => route('api.companies.store'),
                'active' => 'companies',
                'users'  =>  $userResponses['data'],
                'boxTitle'=>'添加公司',
            ]
        );
    }
    
}
