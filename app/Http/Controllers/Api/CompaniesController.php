<?php

namespace App\Http\Controllers\Api;

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

    public function edit($id,Request $request){
        $request->validate([
            'name' => 'required',
            'abbreviation' => 'required',
        ]);
        $company = $this->companies::find($id);
        $input = $request->only(['name', 'abbreviation']);
        $company->name         = $input['name'];
        $company->abbreviation = $input['abbreviation'];
        if($state = $company->save()){
            return response()->json([
                'state' => $state,
                'route' => route('companies')
            ]);
        }
    }

    public function store(Request $request){
        $request->validate([
            'name' => 'required',
            'abbreviation' => 'required',
        ]);
        $input = $request->only(['name', 'abbreviation','userId']);
        $this->companies->name = $input['name'];
        $this->companies->abbreviation = $input['abbreviation'];
        $this->companies->userId = $input['userId'];
        if($state = $this->companies->save()){
            $user = $this->users->find($input['userId']);
            $user->companyId = $this->companies->id;
            $user->save();
            return response()->json([
                'state' => $state,
                'route' => route('companies')

            ]);
        }
    }

    public function delete($id){
        if($state = $this->companies::destroy($id)){
            return response()->json([
                'state' => $state,
                'route' => route('companies')
            ]);
        }
    }
}
