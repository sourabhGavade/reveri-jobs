<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Helpers\DataArrayHelper;
use Illuminate\Http\Request;
use App\HeadHunting;
use App\Cms;
use App\Http\Requests\Front\HeadHuntingFormRequest;
use App\Mail\HeadHuntingMail;
use App\Mail\HeadHuntingMailAdmin;
use DataTables;
use Illuminate\Support\Facades\Mail;
use Artisan;
class HeadHuntingController extends Controller
{

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
    
        $careerLevels = DataArrayHelper::langCareerLevelsArray();
        $industries = DataArrayHelper::langIndustriesArray();
        $functionalAreas = DataArrayHelper::langFunctionalAreasArray();
        // dd($careerLevels);die;
        return view('headhunting',compact('careerLevels','industries','functionalAreas'));
    }
    public function store(HeadHuntingFormRequest $req){
        // die('hello');
        $headhunting = new HeadHunting();
        $headhunting['register']=$req['register'];
        $headhunting['company_name']=$req['company_name'];
        $headhunting['contact_person']=$req['person'];
        $headhunting['email_id']=$req['email'];
        $headhunting['contact_number']=$req['contact'];
        $headhunting['designation']=$req['designation'];
        $headhunting['qualification']=$req['qualification'];
        $headhunting['experience']=$req['experience'];
        $headhunting['job_profile']=(int)($req['job_experience_id']);
        $headhunting['industry']=(int)($req['industry']);
        $headhunting['functional_area']=(int)($req['functional_area']);
        $headhunting['target_industry']=$req['target_indusrty'];
        $headhunting['target_designation']=$req['target_designation'];
        $headhunting['target_salary']=$req['target_salary'];
        // $headhunting->save();
        Mail::send(new HeadHuntingMail($headhunting));
        Mail::send(new HeadHuntingMailAdmin($headhunting));
        return \Redirect::route('head.hunting');
    }
    public function view()
    {
        $data=HeadHunting::all();
        // dd($data);
        // die('hello');
        return view('admin.head_hunting.index',compact('data'));
    }
    
}
