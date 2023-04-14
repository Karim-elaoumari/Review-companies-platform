<?php

namespace App\Http\Controllers;

use App\Models\Company;
use Tymon\JWTAuth\Facades\JWTAuth;
use App\Http\Resources\CompanyResource;
use App\Http\Resources\CompanyCollection;
use App\Http\Requests\StoreCompanyRequest;
use App\Http\Requests\UpdateCompanyRequest;

class CompanyController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api')->except(['index','show']);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $companies =  Company::with('manager')->latest()->get();
        return  new CompanyCollection($companies);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreCompanyRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreCompanyRequest $request)
    {
        $company = Company::create([
            'name'=>$request->name,
            'website'=>$request->website,
            'logo'=>$request->logo,
            'founded'=>$request->foundation_year,
            'industry_id'=>$request->industry, 
            'manager_id'=>JWTAuth::user()->id,
            'employees'=>$request->employees, 
            'revenue'=>$request->revenue, 
            'description'=>$request->description,
            'city'=>$request->city,
            'country_code'=>$request->country_code,
            'address'=>$request->address,
            'mission'=>$request->mission,
        ]);

        $companies =  Company::with('reviews','manager')->latest()->get();
        return  new CompanyCollection($companies);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Company  $company
     * @return \Illuminate\Http\Response
     */
    public function show(Company $company)
    {
        $company =  Company::with('reviews','comments','followers','jobs')->where('id',$company->id)->get();
        return  new CompanyCollection($company);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Company  $company
     * @return \Illuminate\Http\Response
     */
    public function edit(Company $company)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateCompanyRequest  $request
     * @param  \App\Models\Company  $company
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateCompanyRequest $request, Company $company)
    {
        
        $company->name        = $request->name;
        $company->website     = $request->website;
        $company->logo        = $request->logo;
        $company->founded     = $request->founded;
        $company->industry_id = $request->industry_id;
        $company->employees   = $request->employees;
        $company->revenue     = $request->revenue;
        $company->description = $request->description;
        $company->city_id     = $request->city_id;
        $company->address     = $request->address;
        $company->mission     = $request->mission;
        $company->update();
        return new CompanyResource($company);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Company  $company
     * @return \Illuminate\Http\Response
     */
    public function destroy(Company $company)
    {
        $company = Company::find($company->id)->where('user_id',1);
        $company->delete();
        return  response()->json(['success'=>'company deleted successufuly']);
    }
}
