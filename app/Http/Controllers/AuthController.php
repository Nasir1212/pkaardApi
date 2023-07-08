<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Withdraw_payment;
use App\Models\franchise_profile;
use App\Models\Campain_chart;
use App\Models\card_registation;
use App\Models\branch_user;
use App\Models\OTP;
use App\Models\IP;
use App\Models\All_Reference;
use App\Models\Reference_rogram;
use Illuminate\Http\Response;
use App\Models\Category;
use App\Mail\AdminOtpMail;
use App\Models\District;
use App\Models\Affiliation_product;
use App\Models\Affiliation_partner;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Validator;

class AuthController extends Controller
{
    public function signup(Request $req){
        $back_nid = $req->input("back_nid");
        $company_address = $req->input("company_address");
        $company_name = $req->input("company_name");
        $company_owner_name = $req->input("company_owner_name");
        $company_tin = $req->input("company_tin");
        $contact_full_name = $req->input("contact_full_name");
        $contact_number = $req->input("contact_number");
        $contact_role = $req->input("contact_role");
        $email_address = $req->input("email_address");
        $front_nid = $req->input("front_nid");
        $password = \Hash::make($req->input("password"));
        $create_at = date("Y:m:d");
     
        $result = Affiliation_partner::insert([
           'back_nid'=>$back_nid,
           'company_address'=>$company_address,
           'company_name'=>$company_name,
           'company_owner_name'=>$company_owner_name,
           'company_tin'=>$company_tin,
           'contact_full_name'=>$contact_full_name,
           'contact_number'=>$contact_number,
           'contact_role'=>$contact_role,
           'email_address'=>$email_address,
           'front_nid'=>$front_nid,
           'password'=>$password,
           'create_at'=>$create_at,
     
        ]);
     
        if($result){
           
           return json_encode(array('condition'=>true,'message'=>"successfully... Registerd"));
        }else{
            return json_encode(array('condition'=>false ));
        }
    }

    public function check_Auth_phone_number($contact_number){
        if( Affiliation_partner::where(['contact_number'=>$contact_number])->count() >0){
         return json_encode(['status'=>true,'message'=>'contact number is already used']);
        }else{
         return json_encode(['status'=>false]);
 
        }
     }


     public function login(Request $req){

     
        $phone_number = $req->input("phone_number");
        $password = $req->input("password");
      $old_password =  Affiliation_partner::where(['contact_number'=>$phone_number])->get('password');
      
 if(Affiliation_partner::where(['contact_number'=>$phone_number])->count() > 0 && \Hash::check($password, $old_password[0]['password'])){

return ['status'=>true,'data'=> Affiliation_partner::where(['contact_number'=>$phone_number])->get(['id','contact_number','company_name'])];

 }else{
    return ['status'=>false,'data'=>'Phone number or Password not matched'];
 }
 
        

        

       }
        
     
}
