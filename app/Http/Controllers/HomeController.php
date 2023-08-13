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
use App\Models\OrderProduct;
use App\Models\OrderConfirmationHistory;
use App\Models\Order_card_holder;
use App\Models\Card_holder_wallet;


class HomeController extends Controller
{
    public function New_order(){
        return Affiliation_product::all();
    }

    public function category(){
        return Category::all();
    }

    public function district(){
        return District::all(); 
    }

    public function affiliation_product_insert(Request $req){

        $address = $req->input('address');
        $category_id = $req->input('category_id');
        $company_id = $req->input('company_id');
        $details = $req->input('details');
        $district_id = $req->input('district_id');
        $phone = $req->input('phone');
        $title = $req->input('title');
        $privilege = $req->input('privilege');
        $regular_price = $req->input('regular_price');

        $create_at= date("Y/m/d");

        
      $result =  Affiliation_product::insert([
           "address"=>$address,
           "category_id"=>$category_id,
           "company_id"=>$company_id,
           "details"=>$details,
           "district_id"=>$district_id,
           "phone"=>$phone,
           "title"=>$title,
           "privilege"=>$privilege,
           'regular_price'=>$regular_price,
           "create_at"=>$create_at,
           'product_uploader'=>2
        ]);

        if($result){
           $id = Affiliation_product::latest('id')->first();
           return json_encode(array('condition'=>true,'id'=>$id['id']));
        }else{
           return json_encode(array('condition'=>false ));
        }


}




public function affiliation_product_img_path_insert(Request $req){

    $img_path = $req->input('img_path');
    $product_id = $req->input('product_id');

 $all_img_path =  Affiliation_product::where(['id' => $product_id])->get(["img_path"]);


 if(is_null($all_img_path[0]['img_path'])){
    
     $result = Affiliation_product::where(['id'=>$product_id])->update([
       'img_path'=> $img_path
      ]);
 }else{
  
       $result = Affiliation_product::where(['id'=>$product_id])->update([
          'img_path'=>$all_img_path[0]['img_path'].",".$img_path
       ]);
 }

 $data =   Affiliation_product::where(['id' => $product_id])->get(["img_path"]);
 $data[0]['img_path'];
 if(count(explode(",",$data[0]['img_path'])) > 21){

    return json_encode(array('condition'=>false,''=>'You can\'t upload more than 20 Image' ));

 }
    if($result){
       
       return json_encode(array('condition'=>true));
    }else{
       return json_encode(array('condition'=>false ));
    }

 }

 public function getAllOrder(){

 //return  OrderProduct::all();

 $result = \DB::select("SELECT 
 
 order_product.id AS order_product_id, order_product.paying_merchant,order_product.paying_pkaard,order_product.discount_tk,order_product.date AS order_date, order_product.status AS order_status, order_product.validity,
 
 affiliation_product.id AS affiliation_product_id, affiliation_product.address AS aff_address , affiliation_product.details AS affiliation_product_details ,affiliation_product.discount AS affiliation_product_discount ,affiliation_product.category_id AS affiliation_product_category_id , affiliation_product.company_id AS affiliation_product_company_id , affiliation_product.phone AS affiliation_product_phone , affiliation_product.title AS affiliation_product_title , affiliation_product.img_path AS affiliation_product_img_path , affiliation_product.create_at AS affiliation_product_create_at , affiliation_product.regular_price AS affiliation_product_regular_price , affiliation_product.product_uploader AS affiliation_product_product_uploader , affiliation_product.status AS affiliation_product_status   ,card_registation.id AS card_registation_id , card_registation.card_id AS card_registation_card_id , card_registation.cda_address_details , card_registation.cda_apartment_no , card_registation.cda_district , card_registation.cda_division , card_registation.cda_house_no , card_registation.cda_road_no , card_registation.cda_upzilla , card_registation.cda_thana , card_registation.cda_village, card_registation.date_of_birth , card_registation.district , card_registation.division , card_registation.email,card_registation.full_name , card_registation.gender , card_registation.nationality, card_registation.phone_number AS card_registation_phone_number ,card_registation.reference_code , card_registation.profession , card_registation.register_date , card_registation.invoice_number , card_registation.status AS card_registation_status , card_registation.role AS card_registation_role ,affiliation_partner.id AS affiliation_partner_id , affiliation_partner.back_nid , affiliation_partner.company_address, affiliation_partner.company_name, affiliation_partner.company_owner_name , affiliation_partner.company_tin , affiliation_partner.contact_full_name , affiliation_partner.contact_number AS affiliation_partner_contact_number , affiliation_partner.contact_role , affiliation_partner.email_address AS affiliation_partner_email_address , affiliation_partner.front_nid , affiliation_partner.create_at AS affiliation_partner_create_at , affiliation_partner.status AS affiliation_partner_status   FROM order_product LEFT JOIN affiliation_product ON affiliation_product.id = order_product.product_id   LEFT JOIN card_registation ON card_registation.card_id =  order_product.customer_id LEFT JOIN affiliation_partner ON affiliation_partner.id =  order_product.affiliation_partner_id");

return $result;
 }
   

 public function getOneOrder($id){

   //return  OrderProduct::all();
  
   $result = \DB::select("SELECT 
   
   order_product.id AS order_product_id, order_product.paying_merchant,order_product.paying_pkaard,order_product.discount_tk,order_product.date AS order_date, order_product.status AS order_status, order_product.validity,
   
   affiliation_product.id AS affiliation_product_id, affiliation_product.address AS aff_address , affiliation_product.details AS affiliation_product_details ,affiliation_product.discount AS affiliation_product_discount ,affiliation_product.category_id AS affiliation_product_category_id , affiliation_product.company_id AS affiliation_product_company_id , affiliation_product.phone AS affiliation_product_phone , affiliation_product.title AS affiliation_product_title , affiliation_product.img_path AS affiliation_product_img_path , affiliation_product.create_at AS affiliation_product_create_at , affiliation_product.regular_price AS affiliation_product_regular_price , affiliation_product.product_uploader AS affiliation_product_product_uploader , affiliation_product.status AS affiliation_product_status   ,card_registation.id AS card_registation_id , card_registation.card_id AS card_registation_card_id , card_registation.cda_address_details , card_registation.cda_apartment_no , card_registation.cda_district , card_registation.cda_division , card_registation.cda_house_no , card_registation.cda_road_no , card_registation.cda_upzilla , card_registation.cda_thana , card_registation.cda_village, card_registation.date_of_birth , card_registation.district , card_registation.division , card_registation.email,card_registation.full_name , card_registation.gender , card_registation.nationality, card_registation.phone_number AS card_registation_phone_number ,card_registation.reference_code , card_registation.profession , card_registation.register_date , card_registation.invoice_number , card_registation.status AS card_registation_status , card_registation.role AS card_registation_role ,affiliation_partner.id AS affiliation_partner_id , affiliation_partner.back_nid , affiliation_partner.company_address, affiliation_partner.company_name, affiliation_partner.company_owner_name , affiliation_partner.company_tin , affiliation_partner.contact_full_name , affiliation_partner.contact_number AS affiliation_partner_contact_number , affiliation_partner.contact_role , affiliation_partner.email_address AS affiliation_partner_email_address , affiliation_partner.front_nid , affiliation_partner.create_at AS affiliation_partner_create_at , affiliation_partner.status AS affiliation_partner_status   FROM order_product LEFT JOIN affiliation_product ON affiliation_product.id = order_product.product_id   LEFT JOIN card_registation ON card_registation.card_id =  order_product.customer_id LEFT JOIN affiliation_partner ON affiliation_partner.id =  order_product.affiliation_partner_id  WHERE order_product.affiliation_partner_id =$id");
  
  return $result;
   }


   public function order_card_holder($id){

      $result = \DB::select("SELECT order_card_holder.*, physical_card_no.card_no, card_registation.full_name FROM order_card_holder LEFT JOIN physical_card_no ON physical_card_no.registation_no = order_card_holder.card_holder LEFT JOIN card_registation ON card_registation.card_Id = order_card_holder.card_holder WHERE order_card_holder.affiliation_id = $id ");

      return $result ;

   }
     
   public function order_card_holder_by_tid($id){

      $result = \DB::select("SELECT order_card_holder.*, affiliation_product.privilege AS affiliation_product_privilege , aff_sub_discount_product.privilege AS aff_sub_discount_product_privilege  ,physical_card_no.card_no, card_registation.full_name FROM order_card_holder LEFT JOIN physical_card_no ON physical_card_no.registation_no = order_card_holder.card_holder LEFT JOIN card_registation ON card_registation.card_Id = order_card_holder.card_holder LEFT JOIN affiliation_product ON  CONCAT('p_id-',affiliation_product.id)  = order_card_holder.product_table_id LEFT JOIN aff_sub_discount_product ON  CONCAT('sub_p_id-',aff_sub_discount_product.id) = order_card_holder.product_table_id WHERE order_card_holder.id = $id ");
      return $result ;

   }
     
   public function order_confirmation_history(Request $req){


      if($req->input("charge") == null){



       $insert =   OrderConfirmationHistory::insert([
         'product_id'=>$req->input("product_id"), 
         'customer_registation_no'=>$req->input("customer_registation_no"), 
         'affiliation_partner_id'=>$req->input("affiliation_partner_id"), 
         'payment'=>$req->input("payment"), 
         'date'=> date("Y/m/d"), 

       ]);

       if(!$insert){
         return json_encode(['condition'=>false,'message'=>'Order Confirmation History failed']);
       }else{
         $delete =   Order_card_holder::where(['id'=>$req->input("table_id")])->delete();
         if($delete){
            return  json_encode(['condition'=>true,'message'=>'Successfully  Submission']);
         }else{
            return  json_encode(['condition'=>false,'message'=>'Submission Failed']);

         }

       }


       
      }else{
         $wallet =   Card_holder_wallet::where(['registation_no'=>$req->input("customer_registation_no")])->get(['wallet']);
         if($wallet[0]['wallet'] >= $req->input("charge")){
           $charge_fee=  Card_holder_wallet::where(['registation_no'=>$req->input("customer_registation_no")])->update([

               'wallet'=>$wallet[0]['wallet'] - floatval($req->input("charge"))
           ]);
         }else{
            return json_encode(['condition'=>false,"message"=>"Your Customer Pkaard's blance is insufficient. "]);

         }

         $insert =   OrderConfirmationHistory::insert([
            'product_id'=>$req->input("product_id"), 
            'customer_registation_no'=>$req->input("customer_registation_no"), 
            'affiliation_partner_id'=>$req->input("affiliation_partner_id"), 
            'payment'=>$req->input("payment"), 
            'date'=>date("Y/m/d"), 
   
          ]);

          if(!$insert){
            return  json_encode(['condition'=>false,'message'=>'Order Confirmation History failed']);
          }else{
            $delete =   Order_card_holder::where(['id'=>$req->input("table_id")])->delete();
            if($delete){
               return json_encode(['condition'=>true,'message'=>'Successfully  Submission']);
            }else{
               return  json_encode(['condition'=>false,'message'=>'Submission Failed']);
   
            }
   
          }


      }

      // table_id:id,
      // product_id:product_table_id,
      // customer_registation_no:card_holder,
      // affiliation_partner_id:affiliation_id,
      // payment:payable_price == null ? myPayablePrice:payable_price ,
      // charge:payable_price == null ? grandTotal:null ,

   }


}
