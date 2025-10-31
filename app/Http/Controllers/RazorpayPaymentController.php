<?php

  

namespace App\Http\Controllers;

  
use Auth;
use App\Package;
use App\RazorpayOrder;
use App\User;
use Illuminate\Http\Request;
use Validator;
use Razorpay\Api\Api;
use Mail;
use Session;
use App\Mail\RazorpayPaymentMail;
use Exception;
use App\Traits\CompanyPackageTrait;
use App\Traits\JobSeekerPackageTrait;
  

class RazorpayPaymentController extends Controller
{
    use CompanyPackageTrait;
    use JobSeekerPackageTrait;
    /**
     * Write code on Method
     *
     * @return response()
     */
    public function show(){
        $order_id=Session::get('order_id');
        if(isset($order_id)){
            $data=RazorpayOrder::where('id','=',$order_id)->first();
            $order_amount=$data->amount;
            $razorpay_order_id=$data->razorpay_order_id;
            $buyer_name = Auth::guard('company')->user()->name . '(' . Auth::guard('company')->user()->email . ')';
            $buyer_email = Auth::guard('company')->user()->email;
            return view('razorpayView',compact('order_amount','razorpay_order_id','buyer_name','buyer_email'));
        }
        
    }
    public function index(Request $request)
    {   
       
        $input=$request->all();
        // dd($input);die;
        $package = Package::findOrFail($input['package_id']);
        if($package->package_for!='job_seeker'){
           $msgresponse = Array();
           if(($package->num_industry>0)&&($package->num_functional_area>0)){
            $rules = array(
                'job_position' => 'required|array|max:'.$package->num_job_position,
                'industry' => 'required|array|max:'.$package->num_industry,
                'functional_area' => 'required|array|max:'.$package->num_functional_area,
            );
           }else{
            $rules = array(
                'job_position' => 'required|array|max:'.$package->num_job_position,
                'industry' => 'required',
                'functional_area' => 'required',
            );
           }
            
        
        $errorMsg = "Opps ! Please fill required fields.";
        $validation = Validator::make($request->all(), $rules);
        if ($validation->fails()) 
        {
            return response()->json(['errorArray'=>$validation->errors(),'error_msg'=>$errorMsg,'slideToTop'=>'yes']);
        } 
        }
        
        if($package->package_for=='employer'){
        }
        $order_amount = $package->package_price;
        /*         * ************************ */
        $buyer_id = '';
        $buyer_name = '';
        if (Auth::guard('company')->check()) {
            $buyer_id = Auth::guard('company')->user()->id;
            $buyer_name = Auth::guard('company')->user()->name . '(' . Auth::guard('company')->user()->email . ')';
            $buyer_email = Auth::guard('company')->user()->email;
        }
        if (Auth::check()) {
            $buyer_id = Auth::user()->id;
            $buyer_name = Auth::user()->getName() . '(' . Auth::user()->email . ')';
            $buyer_email = Auth::user()->email;
        }
        $package_for = ($package->package_for == 'employer') ? __('Employer') : __('Job Seeker');
        $description = $package_for . ' ' . $buyer_name . ' - ' . $buyer_id . ' ' . __('Package') . ':' . $package->package_title;
        $metadata_arr=array();
        if(!empty($input['job_position'])){
            $metadata_arr['job_position']=$input['job_position'];
        }
        if(!empty($input['industry'])){
            $metadata_arr['industry']=$input['industry'];
        }
        if(!empty($input['functional_area'])){
            $metadata_arr['functional_area']=$input['functional_area'];
        }
        // dd(env('RAZORPAY_SECRET'));
        $v = new RazorpayOrder;
        $v->amount= $order_amount;
        $v->company_id=$buyer_id;
        $v->package_id=$input['package_id'];
        $v->metadata=json_encode($metadata_arr);
        $v->order_type=$package->package_for;
		$v->save();

        /*         * ************************ */
        $api = new Api(env('RAZORPAY_KEY'), env('RAZORPAY_SECRET'));
        
        $razorpay = $api->order->create(array(
               'receipt' => $v->id,
               'amount' => (int)($v->amount*100),
               'currency' => 'INR'
               )
             );
             
        $vs=RazorpayOrder::updateOrCreate(['id'=>$v->id],['razorpay_order_id'=>$razorpay->id]);
        Session::put('order_id', $v->id);
        $output['status']			= 'success';
		$output['msgHead']			= "Success ! ";
		$output['msgType']			= "success";
		$output['success']			= true;
		$output['slideToTop']		= true;
		$output['url']				= route('razorpayview');
			
		return response()->json($output);
    }

  

    /**

     * Write code on Method

     *

     * @return response()

     */

    public function store(Request $request)
    {
        $input = $request->all();   
        // dd($input);die;
        $api = new Api(env('RAZORPAY_KEY'), env('RAZORPAY_SECRET'));
        $payment = $api->payment->fetch($input['razorpay_payment_id']);
        // $res=json_encode($payment,true);
       // dd($payment);die;
        $res['id']=$payment->id;
        $res['status']=$payment->status;
        $res['method']=$payment->method;
        $res['description']=$payment->description;
        $res['card_id']=$payment->card_id;
        $res['bank']=$payment->bank;
        $res['wallet']=$payment->wallet;
        $res['vpa']=$payment->vpa;
        $res['contact']=$payment->contact;
        $res['email']=$payment->email;
        $pr=json_encode($res);
        // dd($res);
        if(count($input)  && !empty($input['razorpay_payment_id'])) {
            try {
                if(!empty($payment)){
                    // dd($payment);die;
                    if(isset($payment->order_id)){
                        $record=RazorpayOrder::where('razorpay_order_id','=',$payment->order_id)->first();
                        if(!empty($record)){
                            $amount=(int)($record->amount*100);
                            RazorpayOrder::updateOrCreate(['id'=>$record->id],['payment_response'=>$pr]);

                            if($amount==$payment->amount){
                                if(($payment->status=='captured')&&($payment->captured==1)){
                                    RazorpayOrder::updateOrCreate(['id'=>$record->id],['payment_status'=>'success']);
                                   
                                    $package_id=$record->package_id;
                                    $package = Package::findOrFail($package_id);
                                    // dd($record);die;
                                    $company = Auth::guard('company')->user();
                                    // dd($company);die;
                                    // dd()
                                    $data=$package;

                                    if($record->order_type=='job_seeker'){
                                        if(($company->package_id==null)||($company->package_id==0)){
                                            $this->addCompanyPackage($company, $package);
                                            
                                        }else{
                                            $this->updateCompanyPackage($company, $package);
                                        }
                                        Mail::send(new RazorpayPaymentMail($data));
                                        return redirect()->route('company.home');
                                    }elseif($record->order_type=='employer'){
                                        if(($company->cvs_package_id==0)||($company->cvs_package_id==null)){
                                            $this->addCompanySearchPackage($company, $package);
                                            // dd($record->metadata);die;
                                            $company->package_detail = $record->metadata;
                                            $company->update();
                                        }else{
                                            $this->updateCompanySearchPackage($company, $package);
                                            // dd($record->metadata);die;
                                            $company->package_detail = $record->metadata;
                                            $company->update();
                                        }
                                        Mail::send(new RazorpayPaymentMail($data));
                                        return redirect()->route('company.home');
                                    }else{
                                        if(($company->cvs_package_id==0)||($company->cvs_package_id==null)||($company->package_id==null)||($company->package_id==0)){
                                            $this->addBothCompanyPackage($company, $package);
                                            // dd($record->metadata);die;
                                            $company->package_detail = $record->metadata;
                                            $company->update();
                                        }else{
                                            $this->updateBothCompanyPackage($company, $package);
                                            // dd($record->metadata);die;
                                            $company->package_detail = $record->metadata;
                                            $company->update();
                                        }
                                        Mail::send(new RazorpayPaymentMail($data));
                                        return redirect()->route('company.home');
                                    }
                                }
                            }
                        }
                    }
                }
                
            } catch (Exception $e) {
                return  $e->getMessage();
                Session::put('error',$e->getMessage());
                return redirect()->back();
            }
        }
        Session::put('success', 'Payment successful');
        return redirect()->back();
    }

}