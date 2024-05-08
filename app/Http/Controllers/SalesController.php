<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
//use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Hash;
use Redirect;
use DB;
use Auth;
use Validator;
use App\User;
use App\Country;
use App\State;
use App\City;
use App\Sales;
use App\Sales_values;
use App\Vouchers;
use App\Vouchers_values;
use App\Items;
use App\Customers;
use Helper;
use Image;
use Illuminate\Support\Facades\Cookie;

class SalesController extends Controller
{
    public function __construct()
    {
        //$this->middleware('auth');
    }
    public function salesInvoiceIndex()
    {
		
		$title = 'Sales Invoice';
		$userId = Auth::user()->id;
		if(Auth::user()->u_type ==1){ //ca
			$sales =  DB::table('sales')
							->select(DB::raw('sales.*,company_profiles.comp_name,ca_assigns.ca_id'))
							->leftJoin('company_profiles', 'sales.added_by', '=', 'company_profiles.userId')
							->leftJoin('ca_assigns', 'sales.added_by', '=', 'ca_assigns.comp_id')
							->where('ca_assigns.ca_id','=',$userId)
							->where('ca_assigns.ca_assign_status','=',1)
							->orderBy('id', 'DESC')->paginate(10);
		}else if(Auth::user()->u_type ==4){ //ca employee
			$sales =  DB::table('sales')
							->select(DB::raw('sales.*,company_profiles.comp_name,ca_assigns.ca_id'))
							->leftJoin('company_profiles', 'sales.added_by', '=', 'company_profiles.userId')
							->leftJoin('ca_assigns', 'sales.added_by', '=', 'ca_assigns.comp_id')
							->leftJoin('users', 'ca_assigns.ca_id', '=', 'users.ca_add_by')
							->where('ca_assigns.ca_assign_status','=',1)
							->orderBy('id', 'DESC')->paginate(10);
		}elseif(Auth::user()->u_type ==2){ //user
			$sales =  DB::table('sales')
							->select(DB::raw('sales.*,company_profiles.comp_name'))
							->leftJoin('company_profiles', 'sales.added_by', '=', 'company_profiles.userId')
							->where('sales.added_by', '=', $userId)
							->orderBy('sales.id', 'DESC')->paginate(10);
		}
		elseif(Auth::user()->u_type ==3){ //admin
			$sales =  DB::table('sales')
							->select(DB::raw('sales.*,company_profiles.comp_name'))
							->leftJoin('company_profiles', 'sales.added_by', '=', 'company_profiles.userId')
							->orderBy('id', 'DESC')->paginate(10);
		}
		$sales_pagination = $sales;
		
		$array = array();
		foreach($sales as $k=>$val)
		{
			$array[$val->id]['id'] = $val->id;
			$array[$val->id]['comp_name'] = $val->comp_name;
			$array[$val->id]['inv_num'] = $val->inv_num;			
			$array[$val->id]['bill_name'] = $val->bill_name;
			$array[$val->id]['contact_no'] = $val->contact_no;
			$array[$val->id]['branch_name'] = $val->branch_name;
			$array[$val->id]['inv_date'] = $val->inv_date;
			$array[$val->id]['mode_of_pay'] = $val->mode_of_pay;
			$array[$val->id]['pay_status'] = $val->pay_status;
			$array[$val->id]['total_amount'] = $val->total_amount;
			$array[$val->id]['status'] = $val->status;
			
			$customerName =  DB::table('customers')
							->select(DB::raw('customers.cust_name,customers.cust_phone'))
							->where('id', '=', $val->inv_name)
							->get();
			$array[$val->id]['cust_name'] = isset($customerName[0]->cust_name)?$customerName[0]->cust_name:"";
			$array[$val->id]['cust_phone'] = isset($customerName[0]->cust_phone)?$customerName[0]->cust_phone:"";
			if($val->id >0){
				$salesValue =  DB::table('sales_values')
							->select(DB::raw('SUM(sales_values.amount) as grandTotal'))
							->where('sid', '=', $val->id)
							->get();
				$array[$val->id]['grandTotal'] = isset($salesValue[0]->grandTotal)?$salesValue[0]->grandTotal:0;
			}else{
				$array[$val->id]['grandTotal'] = 0;

			} 
		}
		$sales = json_decode(json_encode($array));
		
		//echo "<pre>"; print_r($sales);exit;
		return view('pages.sales-invoice')->with([
			'title' =>$title,
			'sales'=>$sales,
			'sales_pagination' =>$sales_pagination,
		]); 
    }

	public function addSalesInvoice()
    {
		$userId = Auth::user()->id;
		$invoiceNo = DB::table('sales')
								->select(DB::raw('MAX(id) as id'))
								->get();
		$compData = DB::table('company_profiles')
								->select(DB::raw('comp_name,comp_phone'))
								->where('company_profiles.userId','=',$userId)
								->get();
		$custData = DB::table('customers')
								->select(DB::raw('customers.*'))
								->where('customers.userId','=',$userId)
								->where('customers.status','=',1)
								->get();
		//echo "<pre>"; print_r($custData);exit;
		$comp_name = isset($compData[0]->comp_name)?$compData[0]->comp_name:"";
		$comp_phone = isset($compData[0]->comp_phone)?$compData[0]->comp_phone:"";
		$invoiceNo = isset($invoiceNo[0]->id)?$invoiceNo[0]->id:0;
		$invoiceNo = Helper::invoice_num($invoiceNo+1,7,"SI-");			
		$countries = Country::where('id', '>', '0')->get();
        $states_bill = State::where('country_id', '=', isset($compDetails->comp_bill_country)?$compDetails->comp_bill_country:0)->get();
		$cities_bill = City::where('state_id', '=', isset($compDetails->comp_bill_state)?$compDetails->comp_bill_state:0)->get();
		
		$states_ship = State::where('country_id', '=', isset($compDetails->comp_ship_country)?$compDetails->comp_ship_country:0)->get();
		$cities_ship = City::where('state_id', '=', isset($compDetails->comp_ship_state)?$compDetails->comp_ship_state:0)->get();
		
		return view('pages.add-sales-invoice')->with([
			'invoiceNo'=>$invoiceNo,
			'comp_name'=>$comp_name,
			'comp_phone'=>$comp_phone,
			'countries'=>$countries,
			'states_bill'=>$states_bill,
			'cities_bill'=>$cities_bill,
			'states_ship'=>$states_ship,
			'cities_ship'=>$cities_ship,
			'custData'=>$custData,
		]);
    }

	protected function getinvcust(Request $request){
		
		$id = $request->id; 			
		$result = Customers::query()
					->where('id', '=', $id) 
					->get();
		$stateBill = State::query()
				   ->where('country_id', '=', $result[0]->cust_bill_country) 
				   ->get()->toArray();
		$cityBill = City::query()
				   ->where('state_id', '=', $result[0]->cust_bill_state) 
				   ->get()->toArray();
		$stateShip = State::query()
				   ->where('country_id', '=', $result[0]->cust_ship_country) 
				   ->get()->toArray();
		$cityShip = City::query()
				   ->where('state_id', '=', $result[0]->cust_ship_state) 
				   ->get()->toArray();
		$resStateBill = [];
		$resCityBill = [];
		$resStateShip = [];
		$resCityShip = [];
		foreach($stateBill as $row){
			
		   $resStateBill[] = array("id"=>$row['id'], "name"=>$row['name'], "sid"=>$result[0]->cust_bill_state);
		}
		foreach($cityBill as $row1){
			
		   $resCityBill[] = array("id"=>$row1['id'], "name"=>$row1['name'], "sid"=>$result[0]->cust_bill_city);
		}
		foreach($stateShip as $row){
			
		   $resStateShip[] = array("id"=>$row['id'], "name"=>$row['name'], "selid"=>$result[0]->cust_ship_state);
		}
		foreach($cityShip as $row1){
			
		   $resCityShip[] = array("id"=>$row1['id'], "name"=>$row1['name'], "selid"=>$result[0]->cust_ship_city);
		}
		$array = array();
		foreach($result as $k=>$val)
		{
			$array['id'] = $val->id;
			$array['cust_email'] = $val->cust_email;
			$array['cust_phone'] = $val->cust_phone;
			$array['cust_pan'] = $val->cust_pan;
			$array['gst_reg'] = $val->gst_reg;			
			$array['cust_gst_no'] = $val->cust_gst_no;						
			$array['cust_gst_type'] = $val->cust_gst_type;
			$array['comp_type'] = $val->comp_type;									
			$array['cust_bill_name'] = $val->cust_bill_name;
			$array['cust_bill_addone'] = $val->cust_bill_addone;
			$array['cust_bill_addtwo'] = $val->cust_bill_addtwo;
			$array['cust_bill_country'] = $val->cust_bill_country;
			$array['cust_bill_state'] = $val->cust_bill_state;
			$array['cust_bill_city'] = $val->cust_bill_city;
			$array['stateBill'] = $resStateBill;
			$array['cityBill'] = $resCityBill;
			$array['cust_bill_pin'] = $val->cust_bill_pin;
			
			$array['cust_ship_name'] = $val->cust_ship_name;
			$array['cust_ship_addone'] = $val->cust_ship_addone;
			$array['cust_bill_addtwo'] = $val->cust_ship_addtwo;
			$array['cust_ship_country'] = $val->cust_ship_country;
			$array['cust_ship_state'] = $val->cust_ship_state;
			$array['cust_ship_city'] = $val->cust_ship_city;
			$array['stateShip'] = $resStateShip;
			$array['cityShip'] = $resCityShip;
			$array['cust_ship_pin'] = $val->cust_ship_pin;
		}
		//$result = json_decode(json_encode($array));
		$result = $array;
		//echo "<pre>";print_r($result);exit;
		echo json_encode($result); 

	}
	
	protected function validator(array $data)
    {
		//echo "<pre>"; print_r($data);exit;
		/*if($data['transport_type'] == 'Other'){
			$transport_type_other = "required";
		}else{
			$transport_type_other = "";
		}*/
		return Validator::make($data, [
			'inv_num' => 'required',
			'inv_date' => 'required',
			'seller_name' => 'required',
			'seller_contact' => 'required',
			'seller_email' => 'required',
			'seller_pan' => 'required',
			'seller_addone' => 'required',                    
			'seller_country' => 'required',
			'seller_state' => 'required',
			'seller_city' => 'required',
			'seller_pin' => 'required',
			//'transport_type_other' => $transport_type_other,              
		]);
			
    }
	
	protected function validatorOther(array $data)
    {
		//echo "<pre>"; print_r($data);exit;
		if($data['disp_through'] == 'Other'){
			$other_dispa_det = "required";
		}else{
			$other_dispa_det = "";
		}
		return Validator::make($data, [
			'mode_of_pay' => 'required',
			'pay_status' => 'required',
			'total_amount' => 'numeric',
			'advance_amount' => 'numeric',
			'due_amount' => 'numeric',
			'order_date' => 'required',
			'disp_through' => 'required',             
			'other_dispa_det' => $other_dispa_det,             
		]);
			
    }

    protected function create(array $data)
    {
		//echo "<pre>";print_r($data);exit;
		$invoiceNo = DB::table('sales')
								->select(DB::raw('MAX(id) as id'))
								->get();
		$invoiceNo = isset($invoiceNo[0]->id)?$invoiceNo[0]->id:0;
		$invoiceNo = Helper::invoice_num($invoiceNo+1,7,"SI-");
		
		/* if($data['transport_type'] == 'Other'){
			$transport_type_other = $data['transport_type_other'];
		}else{
			$transport_type_other = "";
		} */
		
        return Sales::create([
            'added_by' => Auth::user()->id,
            'inv_num' => $invoiceNo,
			'inv_date' => $data['inv_date'],

			'seller_name' => $data['seller_name'],
			'seller_contact' => $data['seller_contact'],
			'seller_email' => $data['seller_email'],
			'seller_pan' => $data['seller_pan'],
			'seller_gst' => isset($data['seller_gst'])?$data['seller_gst']:"",
			'seller_addone' => $data['seller_addone'],
			'seller_addtwo' => isset($data['seller_addtwo'])?$data['seller_addtwo']:"",
			'seller_country' => $data['seller_country'],
			'seller_state' => $data['seller_state'],
			'seller_city' => $data['seller_city'],
			'seller_pin' => $data['seller_pin'],                      
			'created_at' => date('Y-m-d H:i:s'),
        ]);
    }

     
	
	public function save_sales_invoice(Request $request)  {  
            
		//echo "<pre>";print_r($request->file('prod_image'));exit;
		//$input = Input::all();
		//dd($input);
		$validation = $this->validator($request->all());
        if ($validation->fails())  {  
            return response()->json($validation->errors()->toArray());
        }
        else{
			$insertSales = $this->create($request->all());
			$sId = DB::getPdo()->lastInsertId();
			
			if ($insertSales){
				$msg = array(
					'status' => 'success',
					'class' => 'succ',
					'redirect' => url('/edit-sales-invoice/'.base64_encode($sId)),
					'message' => 'Sales added successfully'
				);
				return response()->json($msg);	
			}else{
				$msg = array(
					'status' => 'error',
					'class' => 'err',
					'redirect' => url('/'),
					'message' => 'Sales add failed'
				);
				return response()->json($msg);	
			}
				
		}	
    }
	
	public function items_sales_list($sid)
	{
		
		$sales_values = DB::table('sales_values')
								->select(DB::raw('sales_values.*'))
								->where('sid', '=', $sid)
								->get();
								
		$array = array();
		foreach($sales_values as $k=>$val)
		{
			$array[$val->id]['id'] = $val->id;
			$array[$val->id]['sid'] = $val->sid;
			$array[$val->id]['prod_id'] = $val->prod_id;
			$array[$val->id]['quantity'] = $val->quantity;
			$array[$val->id]['rate'] = $val->rate;
			$array[$val->id]['disc'] = $val->disc;
			$array[$val->id]['disc_type'] = $val->disc_type;
			$array[$val->id]['disc_amt'] = $val->disc_amt;
			$array[$val->id]['tax_amt'] = $val->tax_amt;
			$array[$val->id]['amount'] = $val->amount;
			$array[$val->id]['tax_type'] = $val->tax_type;

			if($val->prod_id >0){
				$item = Items::where('id', '=', $val->prod_id)->get();
				$array[$val->id]['item_name'] = isset($item[0]->item_name)?$item[0]->item_name:"";
				$array[$val->id]['sac_code'] = isset($item[0]->sac_code)?$item[0]->sac_code:"";
				$array[$val->id]['hsn_code'] = isset($item[0]->hsn_code)?$item[0]->hsn_code:"";
				$array[$val->id]['base_unit'] = isset($item[0]->base_unit)?$item[0]->base_unit:"";
				$array[$val->id]['sec_unit'] = isset($item[0]->sec_unit)?$item[0]->sec_unit:"";
			}else{
				$array[$val->id]['item_name'] = "";
				$array[$val->id]['sac_code'] = "";
				$array[$val->id]['hsn_code'] = "";
				$array[$val->id]['base_unit'] = "";
				$array[$val->id]['sec_unit'] = "";
			} 
		}
		$sales_values = json_decode(json_encode($array));
		return $sales_values;
	}
	
	public function edit_sales_invoice($sId)  {  
        
		if(Auth::user()->u_type ==1){
			return redirect('/sales-invoice');
		}
		$sId = base64_decode($sId);
		$sales = DB::table('sales')
								->where('id', '=', $sId)
								->get();
		$sales = $sales[0];
		$products = DB::table('items')
								->select(DB::raw('items.id,items.item_name'))
								->where('added_by', '=', Auth::user()->id)
								->get();
		$custData = DB::table('customers')
								->select(DB::raw('customers.*'))
								->where('customers.userId','=',Auth::user()->id)
								->where('customers.status','=',1)
								->get();
		$countries = Country::where('id', '>', '0')->get();
        $states_bill = State::where('country_id', '=', isset($sales->bill_country)?$sales->bill_country:0)->get();
		$cities_bill = City::where('state_id', '=', isset($sales->bill_state)?$sales->bill_state:0)->get();
		
		$states_ship = State::where('country_id', '=', isset($sales->ship_country)?$sales->ship_country:0)->get();
		$cities_ship = City::where('state_id', '=', isset($sales->ship_state)?$sales->ship_state:0)->get();
		
		$states_seller = State::where('country_id', '=', isset($sales->seller_country)?$sales->seller_country:0)->get();
		$cities_seller = City::where('state_id', '=', isset($sales->seller_state)?$sales->seller_state:0)->get();
		//echo "<pre>";print_r($sales);exit;

		$sales_values = $this->items_sales_list($sId);
		return view('pages.edit-sales-invoice')->with([	
			'products' => $products,
			'sales' => $sales,
			'sales_values' => $sales_values,
			'countries'=>$countries,
			'states_bill'=>$states_bill,
			'cities_bill'=>$cities_bill,
			'states_ship'=>$states_ship,
			'cities_ship'=>$cities_ship,
			'states_seller'=>$states_seller,
			'cities_seller'=>$cities_seller,
			'custData'=>$custData,
			'sId' => $sId
		]); 
    }
	
	public function view_sales_invoice($sId)  {  
		$sId = base64_decode($sId);
		$sales = DB::table('sales')
								->where('id', '=', $sId)
								->get();
		$sales = $sales[0];
		$products = DB::table('items')
								->select(DB::raw('items.id,items.item_name'))
								->where('added_by', '=', Auth::user()->id)
								->get();
		$custData = DB::table('customers')
								->select(DB::raw('customers.id,customers.cust_name'))
								->where('customers.userId','=',Auth::user()->id)
								->where('customers.status','=',1)
								->get();
		$countries = Country::where('id', '>', '0')->get();
        $states_bill = State::where('country_id', '=', isset($sales->bill_country)?$sales->bill_country:0)->get();
		$cities_bill = City::where('state_id', '=', isset($sales->bill_state)?$sales->bill_state:0)->get();
		
		$states_ship = State::where('country_id', '=', isset($sales->ship_country)?$sales->ship_country:0)->get();
		$cities_ship = City::where('state_id', '=', isset($sales->ship_state)?$sales->ship_state:0)->get();
		
		$states_seller = State::where('country_id', '=', isset($sales->seller_country)?$sales->seller_country:0)->get();
		$cities_seller = City::where('state_id', '=', isset($sales->seller_state)?$sales->seller_state:0)->get();
		//echo "<pre>";print_r($sales);exit;

		$sales_values = $this->items_sales_list($sId);
		return view('pages.view-sales-invoice')->with([	
			'products' => $products,
			'sales' => $sales,
			'sales_values' => $sales_values,
			'countries'=>$countries,
			'states_bill'=>$states_bill,
			'cities_bill'=>$cities_bill,
			'states_ship'=>$states_ship,
			'cities_ship'=>$cities_ship,
			'states_seller'=>$states_seller,
			'cities_seller'=>$cities_seller,
			'custData'=>$custData,
			'sId' => $sId
		]); 
    }
	
	public function update_sales_customer(Request $request)  {  
		$sId = $request->id;
		$update = DB::table('sales')
					->where('id', $sId)
					->update(
						 array(
								'inv_name' => $request->inv_name,
								'add_type' => $request->add_type,
						 )
					);
		$msg = array(
			'status' => 'success',
			'class' => 'succ',
			'redirect' => url('/'),
			'message' => 'Record updated successfully'
		);
		return response()->json($msg);
		
    }
	
	public function update_sales_invoice(Request $request)  {  
            
		//echo "<pre>";print_r($request->all());exit;
		$sId = $request->id;
		
		$validation = $this->validator($request->all());
        if ($validation->fails())  {  
            return response()->json($validation->errors()->toArray());
        }
        else{
			/* if($request->transport_type == 'Other'){
				$transport_type_other = $request->transport_type_other;
			}else{
				$transport_type_other = "";
			} */
			$update = DB::table('sales')
					->where('id', $sId)
					->update(
						 array(
								'inv_date' => $request->inv_date,
								'seller_name' => $request->seller_name,
								'seller_contact' => $request->seller_contact,
								'seller_email' => $request->seller_email,
								'seller_pan' => $request->seller_pan,
								'seller_gst' => isset($request->seller_gst)?$request->seller_gst:"",
								'seller_addone' => $request->seller_addone,
								'seller_addtwo' => isset($request->seller_addtwo)?$request->seller_addtwo:"",
								'seller_country' => $request->seller_country,
								'seller_state' => $request->seller_state,
								'seller_city' => $request->seller_city,
								'seller_pin' => $request->seller_pin, 
						 )
					);
			$msg = array(
				'status' => 'success',
				'class' => 'succ',
				'redirect' => url('/'),
				'message' => 'Record updated successfully'
			);
			return response()->json($msg);
		}	
    }
	
	public function getProductType(Request $request)
    {
		$item_type = $request->id; 		   
		$result = DB::table('items')
						->select(DB::raw('items.id,items.item_name'))
						->where('item_type', '=', $item_type)
						->get();
			
		$response = [];
		//echo "<pre>";print_r($result);//exit;
		 foreach($result as $row){
		   $response[] = array("id"=>$row->id, "name"=>$row->item_name);
		}
		echo json_encode($response); 
    }
	
	public function getProduct(Request $request)
    {
		$itemId = $request->prod_id; 		   
		$result = DB::table('items')
								->select(DB::raw('items.id,items.sac_code,items.hsn_code,items.disc_sell,items.disc_sell_type'))
								->where('id', '=', $itemId)
								->get();
			
		$response = [];
		//echo "<pre>";print_r($result);exit;
		 foreach($result as $row){
			 if($row->hsn_code !=""){
				 $hsn_sac_code = $row->hsn_code;
			 }else{
				 $hsn_sac_code = $row->sac_code;
			 }
		   $response[] = array("id"=>$row->id, "hsn_sac_code"=>$hsn_sac_code,"disc_sell"=>$row->disc_sell,"disc_sell_type"=>$row->disc_sell_type);
		}
		echo json_encode($response); 
    }
	
	public function sales_items_display(Request $request)
    {
		//$this->middleware('auth'); 
		
		$sid = $request->sId;
		$uid = Auth::user()->id;
		$prod_id = $request->prod_id;
		
		$product = DB::table('items')
								->select(DB::raw('items.id,items.item_name,items.selling_price,items.disc_sell,items.disc_sell_type'))
								->where('id', '=', $prod_id)
								->get();
		$billing_type = isset($request->billing_type)?$request->billing_type:"";
		$prod_gov_fee = isset($request->prod_gov_fee)?$request->prod_gov_fee:0;
		$gst_trans = isset($request->gst_trans)?$request->gst_trans:"";
		$quantity = 1;
		$rate = $product[0]->selling_price;
		$disc = $request->disc_sell;
		$disc_type = $request->disc_sell_type;
		
		if($disc_type == "percentage")
		{
			$disc_amt = (($product[0]->selling_price*$disc)/100);
		}else{
			$disc_amt = $disc;
		}		
		$amount = ($product[0]->selling_price - $disc_amt) * $quantity;
		$gst_rate = 18;
		$tax_amt = ($amount*$gst_rate)/100;
		$tax_type = "N/A";
		
		$values = array('sid' => $sid,'uid' => $uid,'prod_id' => $prod_id,'quantity' => $quantity,'rate' => $rate,'disc' => $disc,'disc_type'=>$disc_type,'disc_amt' => $disc_amt,'tax_amt'=>$tax_amt,'amount'=>$amount,'tax_type'=>$tax_type,'gst_rate'=>$gst_rate,'billing_type'=>$billing_type,'prod_gov_fee'=>$prod_gov_fee,'gst_trans'=>$gst_trans);
		$insertInvoice = DB::table('sales_values')->insert($values);
		
		
		$sales_values = $this->items_sales_list($sid);
		//echo "<pre>"; print_r($sales_values);exit;
		return view('pages.ajax-sales-invoice-display')->with([
			'sales_values'=>$sales_values,
		]);  
    }
	
	public function delSalesItem(Request $request)
    {
        $delSalesItem = DB::table('sales_values')->where('id', $request->id)->delete();
		$sales_values = $this->items_sales_list($request->sid);
		
		//echo "<pre>"; print_r($sales_values);exit;
		return view('pages.ajax-sales-invoice-display')->with([
			'sales_values'=>$sales_values,
		]);  
		
    }
	
	public function update_sales_item(Request $request)  {  
            
		//echo "<pre>";print_r($request->all());exit;
		$id = $request->id;
		
		$salesData = DB::table('sales_values')
								->select(DB::raw('sales_values.sid,sales_values.quantity'))
								->where('id', '=', $request->id)
								->get();
								
		$amount = ($request->rate - $request->disc_amt) * $salesData[0]->quantity;
		$update = DB::table('sales_values')
				->where('id', $id)
				->update(
					 array(
							'rate' => $request->rate,
							'disc_amt' => $request->disc_amt,
							'amount' => $amount,
							'tax_type' => $request->tax_type
					 )
				);
		
		$sales_data = DB::table('sales_values')
								->select(DB::raw('sales_values.sid'))
								->where('id', '=', $request->id)
								->get();
		$sales_values = $this->items_sales_list($sales_data[0]->sid);
		//echo "<pre>"; print_r($sales_values);exit;
		return view('pages.ajax-sales-invoice-display')->with([
			'sales_values'=>$sales_values,
		]);
    }
	
	public function update_sales_item_quantity(Request $request)  {  
            
		//echo "<pre>";print_r($request->all());exit;
		$id = $request->id;
		
		$sales_data = DB::table('sales_values')
								->select(DB::raw('sales_values.sid,sales_values.rate,sales_values.disc,sales_values.disc_type,sales_values.gst_rate'))
								->where('id', '=', $request->id)
								->get();
		$productRate = $sales_data[0]->rate;
		$gst_rate = $sales_data[0]->gst_rate;
		$disc = $sales_data[0]->disc;
		$disc_type = $sales_data[0]->disc_type;
		$amount = $productRate * $request->quantity;
		if($disc_type == "percentage")
		{
			$disc_amt = (($amount*$disc)/100);
		}else{
			$disc_amt = $disc;
		}		
		$amount = ($amount - $disc_amt);
		$tax_amt = ($amount*$gst_rate)/100; 
		
		$update = DB::table('sales_values')
				->where('id', $id)
				->update(
					 array(
							'quantity' => $request->quantity,
							//'rate' => $rate,
							'disc_amt' => $disc_amt,
							'tax_amt' => $tax_amt,
							'amount' => $amount 
					 )
				);
				
		$sales_values = $this->items_sales_list($sales_data[0]->sid);
		//echo "<pre>"; print_r($sales_values);exit;
		return view('pages.ajax-sales-invoice-display')->with([
			'sales_values'=>$sales_values,
		]);
    }
	
	public function update_sales_item_rate(Request $request)  {  
            
		//echo "<pre>";print_r($request->all());exit;
		$id = $request->id;
		$prod_id = $request->prod_id;
		
		$sales_data = DB::table('sales_values')
								->select(DB::raw('sales_values.sid,sales_values.quantity,sales_values.disc,sales_values.disc_type,sales_values.gst_rate'))
								->where('id', '=', $request->id)
								->get();

		//$rate = $request->rate;
		
		$productRate = $request->rate;
		$gst_rate = $sales_data[0]->gst_rate;
		$disc = $sales_data[0]->disc;
		$disc_type = $sales_data[0]->disc_type;
		$amount = $productRate * $sales_data[0]->quantity;
		if($disc_type == "percentage")
		{
			$disc_amt = (($amount*$disc)/100);
		}else{
			$disc_amt = $disc;
		}		
		$amount = ($amount - $disc_amt);
		$tax_amt = ($amount*$gst_rate)/100; 
		
		$update = DB::table('sales_values')
				->where('id', $id)
				->update(
					 array(
							'rate' => $productRate,
							'disc_amt' => $disc_amt,
							'tax_amt' => $tax_amt,
							'amount' => $amount
					 )
				);
		
		$sales_values = $this->items_sales_list($sales_data[0]->sid);
		//echo "<pre>"; print_r($sales_values);exit;
		return view('pages.ajax-sales-invoice-display')->with([
			'sales_values'=>$sales_values,
		]);
    }
	
	public function update_sales_invoice_final(Request $request)  {  
	
		//print_r($_FILES);		
		$signature_name = $request->signature_name;

		if($file = $request->hasFile('signature')) {
			$file = $request->file('signature') ;
			
			$fileName1 = date("YmdHis") . '-' . $file->getClientOriginalName() ;
			$destinationPath1 = public_path().'/uploads/invoice-signature' ;
			
			$file->move($destinationPath1,$fileName1);
			$signature = $fileName1 ;
			
			//Update file
			$update = DB::table('sales')
			->where('id', $request->id)
			->update(
				 array(
						'signature' => $signature,
						'signature_name' => $signature_name,
						'status' => 1,
						
				 )
			);
		}else{
			$update = DB::table('sales')
				->where('id', $request->id)
				->update(
					 array(
							'signature_name' => $signature_name,
							'status' => 1,
							
					 )
				);
		}

		$msg = array(
			'status' => 'success',
			'class' => 'succ',
			'redirect' => url('/sales-invoice'),
			'message' => 'Record successfully updated',
		);
		return response()->json($msg);			
	}
	
	public function update_sales_other(Request $request)  {  
            
		//echo "<pre>";print_r($request->all());exit;
		$sId = $request->id;
		
		$validation = $this->validatorOther($request->all());
        if ($validation->fails())  {  
            return response()->json($validation->errors()->toArray());
        }
        else{
			$update = DB::table('sales')
					->where('id', $sId)
					->update(
						 array(
								'mode_of_pay' => $request->mode_of_pay,
								'pay_status' => $request->pay_status,
								'total_amount' => isset($request->total_amount)?$request->total_amount:0,
								'advance_amount' => isset($request->advance_amount)?$request->advance_amount:0,
								'due_amount' => isset($request->due_amount)?$request->due_amount:0,
								'buyer_orderno' => isset($request->buyer_orderno)?$request->buyer_orderno:"",
								'order_date' => isset($request->order_date)?$request->order_date:"",
								'supplier_refno' => isset($request->supplier_refno)?$request->supplier_refno:"",
								'other_refno' => isset($request->other_refno)?$request->other_refno:"",
								'dispa_docno_one' => isset($request->dispa_docno_one)?$request->dispa_docno_one:"",
								'dispa_docno_two' => isset($request->dispa_docno_two)?$request->dispa_docno_two:"",
								'disp_through' => $request->disp_through,
								'other_dispa_det' => isset($request->other_dispa_det)?$request->other_dispa_det:"",
								'terms_delivery' => isset($request->terms_delivery)?$request->terms_delivery:""
						 )
					);
			$msg = array(
				'status' => 'success',
				'class' => 'succ',
				'redirect' => url('/sales-invoice'),
				'message' => 'Record updated successfully'
			);
			return response()->json($msg);
		}	
    }
	
	public function delInvoice(Request $request)
    {
        $delInvoice = DB::table('sales')->where('id', $request->id)->delete();
        $delInvoiceItemValue = DB::table('sales_values')->where('sid', $request->id)->delete();
		if($delInvoice){
			$msg = array(
				'status' => 'success',
				'class' => 'succ',
				'redirect' => url('/sales-invoice'),
				'message' => 'Asset voucher deleted successfully.'
			);
			return response()->json($msg);
		}else{
			$msg = array(
				'status' => 'error',
				'class' => 'err',
				'redirect' => url('/sales-invoice'),
				'message' => 'Delete action failed!'
			);
			return response()->json($msg);
		}
    }
	
	//Activate Invoice
	public function activateStatus(Request $request)
    {
        $user = Sales::find($request->id);
        $user->status = $request->status;
        $user->save();
        //return response()->json(['success'=>'Status change successfully.']);
		$msg = array(
			'status' => 'success',
			'class' => 'succ',
			'redirect' => url('/sales-invoice'),
			'message' => 'Status change successfully.'
		);
		return response()->json($msg);

    }
	
	
	//Start voucher
	
	public function CreditDebitIndex()
    {
        //$this->middleware('auth');
		$title = 'Sales Credit Dabit Notes';
		$userId = Auth::user()->id;
		if(Auth::user()->u_type ==1){ //ca
			$sales =  DB::table('vouchers')
							->select(DB::raw('vouchers.*,company_profiles.comp_name,ca_assigns.ca_id'))
							->leftJoin('company_profiles', 'vouchers.added_by', '=', 'company_profiles.userId')
							->leftJoin('ca_assigns', 'vouchers.added_by', '=', 'ca_assigns.comp_id')
							->where('ca_assigns.ca_id','=',$userId)
							->where('ca_assigns.ca_assign_status','=',1)
							->orderBy('id', 'DESC')->paginate(10);
		}else if(Auth::user()->u_type ==4){ //ca employee
			$sales =  DB::table('vouchers')
							->select(DB::raw('vouchers.*,company_profiles.comp_name,ca_assigns.ca_id'))
							->leftJoin('company_profiles', 'vouchers.added_by', '=', 'company_profiles.userId')
							->leftJoin('ca_assigns', 'vouchers.added_by', '=', 'ca_assigns.comp_id')
							->leftJoin('users', 'ca_assigns.ca_id', '=', 'users.ca_add_by')
							->where('ca_assigns.ca_assign_status','=',1)
							->orderBy('id', 'DESC')->paginate(10);
		}elseif(Auth::user()->u_type ==2){ //user
			$sales =  DB::table('vouchers')
							->select(DB::raw('vouchers.*,company_profiles.comp_name'))
							->leftJoin('company_profiles', 'vouchers.added_by', '=', 'company_profiles.userId')
							->where('vouchers.added_by', '=', $userId)
							->orderBy('vouchers.id', 'DESC')->paginate(10);
		}
		elseif(Auth::user()->u_type ==3){ //admin
			$sales =  DB::table('vouchers')
							->select(DB::raw('vouchers.*,company_profiles.comp_name'))
							->leftJoin('company_profiles', 'vouchers.added_by', '=', 'company_profiles.userId')
							->orderBy('id', 'DESC')->paginate(10);
		}
		$sales_pagination = $sales;
		
		$array = array();
		foreach($sales as $k=>$val)
		{
			$array[$val->id]['id'] = $val->id;
			$array[$val->id]['comp_name'] = $val->comp_name;
			$array[$val->id]['inv_num'] = isset($val->inv_num)?$val->inv_num:"";
			$array[$val->id]['inv_date'] = $val->inv_date;
			$customerName =  DB::table('customers')
							->select(DB::raw('customers.cust_name,customers.cust_phone'))
							->where('id', '=', $val->v_name)
							->get();
			$array[$val->id]['cust_name'] = isset($customerName[0]->cust_name)?$customerName[0]->cust_name:"";
			$array[$val->id]['cust_phone'] = isset($customerName[0]->cust_phone)?$customerName[0]->cust_phone:"";
			$array[$val->id]['v_num'] = $val->v_num;
			$array[$val->id]['note_type'] = $val->note_type;
			$array[$val->id]['status'] = $val->status;
			$array[$val->id]['is_paid'] = $val->is_paid;
			$array[$val->id]['credit_debit_amount'] = $val->credit_debit_amount;
		}
		$sales = json_decode(json_encode($array));
		
		//echo "<pre>"; print_r($sales);exit;
		return view('pages.sales-credit-debit')->with([
			'title' =>$title,
			'sales'=>$sales,
			'sales_pagination' =>$sales_pagination,
		]); 
        
    }
    public function addCreditDebit()
    {
        $vNo = DB::table('vouchers')
								->select(DB::raw('MAX(id) as id'))
								->get();
		$vNo = isset($vNo[0]->id)?$vNo[0]->id:0;
		$vNo = Helper::invoice_num($vNo+1,7,"VN-");
		$userId = Auth::user()->id;
		$compData = DB::table('company_profiles')
								->select(DB::raw('comp_name,comp_phone'))
								->where('company_profiles.userId','=',$userId)
								->get();
		$custData = DB::table('customers')
								->select(DB::raw('customers.*'))
								->where('customers.userId','=',$userId)
								->where('customers.status','=',1)
								->get();
		$comp_name = isset($compData[0]->comp_name)?$compData[0]->comp_name:"";
		$comp_phone = isset($compData[0]->comp_phone)?$compData[0]->comp_phone:"";
		$countries = Country::where('id', '>', '0')->get();
		
		$states_bill = State::where('country_id', '=', isset($compDetails->comp_bill_country)?$compDetails->comp_bill_country:0)->get();
		$cities_bill = City::where('state_id', '=', isset($compDetails->comp_bill_state)?$compDetails->comp_bill_state:0)->get();
		
		$states_ship = State::where('country_id', '=', isset($compDetails->comp_ship_country)?$compDetails->comp_ship_country:0)->get();
		$cities_ship = City::where('state_id', '=', isset($compDetails->comp_ship_state)?$compDetails->comp_ship_state:0)->get();
		
        return view('pages.add-sales-credit-dabit')->with([
			'vNo' => $vNo,
			'comp_name' => $comp_name,
			'custData'=>$custData,
			'comp_phone' => $comp_phone,
			'countries' =>$countries,
			'states_bill'=>$states_bill,
			'cities_bill'=>$cities_bill,
			'states_ship'=>$states_ship,
			'cities_ship'=>$cities_ship,
			'custData'=>$custData,
        ]);
    }
	
	protected function validatorSalesCredit(array $data)
    {
		//echo "<pre>"; print_r($data);exit;
			if($data['reason_issuance'] == 'other'){
				$reason_issuance_other = "required";
			}else{
				$reason_issuance_other = "";
			}
			
			return Validator::make($data, [
				'inv_num' => 'required',
				'inv_date' => 'required',
				'seller_name' => 'required',
				'seller_addone' => 'required',
				'seller_country' => 'required',
				'seller_state' => 'required',
				'seller_city' => 'required',
				'seller_pin' => 'required',
				'v_name' => 'required',
				'note_type' => 'required',
				'note_date' => 'required',
				'reason_issuance' => 'required',
				'otherIssuance' => $reason_issuance_other,
				'v_num' => 'required',
				'credit_debit_amount' => 'required',
				'adjusted_amount' => 'required',              
				'challan_no' => 'required', 
				'challan_date' => 'required',				
				'doc_no' => 'required',
				'doc_date' => 'required',
			]);
			
    }

    protected function createSalesCredit(array $data)
    {
		//echo "<pre>";print_r($data);exit;
		if($data['reason_issuance'] == 'other'){
			$otherIssuance = $data['otherIssuance'];
		}else{
			$otherIssuance = "";
		}
		$invoiceNo = DB::table('vouchers')
								->select(DB::raw('MAX(id) as id'))
								->get();
		//$vNo = isset($vNo[0]->id)?$vNo[0]->id:0;
		//$vNo = Helper::invoice_num($vNo+1,7,"VN-");
		
		$invoiceNo = isset($invoiceNo[0]->id)?$invoiceNo[0]->id:0;
		$invoiceNo = Helper::invoice_num($invoiceNo+1,7,"VN-");
		
        return Vouchers::create([
            'added_by' => Auth::user()->id,			
			'inv_num' => $invoiceNo,
			'inv_date' => $data['inv_date'],
			'seller_name' => $data['seller_name'],
			'seller_addone' => $data['seller_addone'],
			'seller_addtwo' => isset($data['seller_addtwo'])?$data['seller_addtwo']:"",
			'seller_country' => $data['seller_country'],
			'seller_state' => $data['seller_state'],
			'seller_city' => $data['seller_city'],
			'seller_pin' => $data['seller_pin'], 
			'v_name' => $data['v_name'],
			'note_type' => $data['note_type'],
			'note_date' => $data['note_date'],
			'reason_issuance' => $data['reason_issuance'],
			'otherIssuance' => $otherIssuance,
			
			'v_num' => $data['v_num'],
			'credit_debit_amount' => isset($data['credit_debit_amount'])?$data['credit_debit_amount']:0,
			'adjusted_amount' => isset($data['adjusted_amount'])?$data['adjusted_amount']:0,            
			'terms_delivery' => isset($data['terms_delivery'])?$data['terms_delivery']:"", 
			'challan_no' => $data['challan_no'],
			'challan_date' => $data['challan_date'],			
			'doc_no' => $data['doc_no'],
			'doc_date' => $data['doc_date'],
			'term_condition' => isset($data['term_condition'])?$data['term_condition']:"",			
			'created_at' => date('Y-m-d H:i:s'),
        ]);
    }

     
	
	public function save_sales_invoice_creditdebit(Request $request)  {  
            
		//echo "<pre>";print_r($request->file('prod_image'));exit;
		//$input = Input::all();
		//dd($input);
		$validation = $this->validatorSalesCredit($request->all());
        if ($validation->fails())  {  
            return response()->json($validation->errors()->toArray());
        }
        else{
			$insertSales = $this->createSalesCredit($request->all());
			$sId = DB::getPdo()->lastInsertId();
			
			if($file = $request->hasFile('voucher_doc')) {
				$file = $request->file('voucher_doc') ;
				$fileName1 = date("YmdHis") . '-' . $file->getClientOriginalName() ;
				$destinationPath1 = public_path().'/uploads/sales-credit-debit' ;
				$file->move($destinationPath1,$fileName1);
				$voucher_doc = $fileName1 ;

				$update = DB::table('vouchers')
				->where('id', $sId)
				->update(
					 array(
						'voucher_doc' => $voucher_doc,
					 )
				);
			}
			
			if ($insertSales){
				$msg = array(
					'status' => 'success',
					'class' => 'succ',
					//'redirect' => url('/edit-sales-credit-debit/'.base64_encode($sId)),
					'redirect' => url('/sales-credit-debit'),
					'message' => 'Record added successfully'
				);
				return response()->json($msg);	
			}else{
				$msg = array(
					'status' => 'error',
					'class' => 'err',
					'redirect' => url('/'),
					'message' => 'Record add failed'
				);
				return response()->json($msg);	
			}
				
		}	
    }
	
	public function items_sales_list_credit_debit($sid)
	{
		
		$vouchers_values = DB::table('vouchers_values')
								->select(DB::raw('vouchers_values.*'))
								->where('sid', '=', $sid)
								->get();
								
		$array = array();
		foreach($vouchers_values as $k=>$val)
		{
			$array[$val->id]['id'] = $val->id;
			$array[$val->id]['sid'] = $val->sid;
			$array[$val->id]['prod_id'] = $val->prod_id;
			$array[$val->id]['quantity'] = $val->quantity;
			$array[$val->id]['rate'] = $val->rate;
			$array[$val->id]['disc'] = $val->disc;
			$array[$val->id]['disc_amt'] = $val->disc_amt;
			$array[$val->id]['tax_amt'] = $val->tax_amt;
			$array[$val->id]['amount'] = $val->amount;
			$array[$val->id]['tax_type'] = $val->tax_type;

			if($val->prod_id >0){
				$item = Items::where('id', '=', $val->prod_id)->get();
				$array[$val->id]['item_name'] = isset($item[0]->item_name)?$item[0]->item_name:"";
				$array[$val->id]['base_unit'] = isset($item[0]->base_unit)?$item[0]->base_unit:"";
				$array[$val->id]['sec_unit'] = isset($item[0]->sec_unit)?$item[0]->sec_unit:"";
			}else{
				$array[$val->id]['item_name'] = "";
				$array[$val->id]['base_unit'] = "";
				$array[$val->id]['sec_unit'] = "";
			} 
		}
		$vouchers_values = json_decode(json_encode($array));
		return $vouchers_values;
	}
	
	public function edit_sales_invoice_credit_debit($sId)  {  
        
		if(Auth::user()->u_type ==1){
			return redirect('/sales-credit-debit');
		}
		$sId = base64_decode($sId);
		$sales = DB::table('vouchers')
								->where('id', '=', $sId)
								->get();
		$sales = $sales[0];
		$products = DB::table('items')
								->select(DB::raw('items.id,items.item_name'))
								->where('added_by', '=', Auth::user()->id)
								->get();
		$custData = DB::table('customers')
								->select(DB::raw('customers.*'))
								->where('customers.userId','=',Auth::user()->id)
								->where('customers.status','=',1)
								->get();
		
		//echo "<pre>";print_r($sales);exit;
		$countries = Country::where('id', '>', '0')->get();		
		$states_seller = State::where('country_id', '=', isset($sales->seller_country)?$sales->seller_country:0)->get();
		$cities_seller = City::where('state_id', '=', isset($sales->seller_state)?$sales->seller_state:0)->get();

		//$vouchers_values = $this->items_sales_list_credit_debit($sId);
		return view('pages.edit-sales-credit-debit')->with([	
			'products' => $products,
			'sales' => $sales,
			'custData'=>$custData,
			'countries' => $countries,
			'states_seller' => $states_seller,
			'cities_seller' => $cities_seller,
			//'vouchers_values' => $vouchers_values,
			'sId' => $sId
		]); 
    }
	
	public function view_sales_invoice_credit_debit($sId)  {  
		$sId = base64_decode($sId);
		$sales = DB::table('vouchers')
								->where('id', '=', $sId)
								->get();
		$sales = $sales[0];
		$products = DB::table('items')
								->select(DB::raw('items.id,items.item_name'))
								->where('added_by', '=', Auth::user()->id)
								->get();
		$custData = DB::table('customers')
								->select(DB::raw('customers.*'))
								->where('customers.userId','=',Auth::user()->id)
								->where('customers.status','=',1)
								->get();
		//echo "<pre>";print_r($sales);exit;
		$countries = Country::where('id', '>', '0')->get();		
		$states_seller = State::where('country_id', '=', isset($sales->seller_country)?$sales->seller_country:0)->get();
		$cities_seller = City::where('state_id', '=', isset($sales->seller_state)?$sales->seller_state:0)->get();
		//$vouchers_values = $this->items_sales_list_credit_debit($sId);
		return view('pages.view-sales-credit-debit')->with([	
			'products' => $products,
			'sales' => $sales,
			'custData'=>$custData,
			'countries' => $countries,
			'states_seller' => $states_seller,
			'cities_seller' => $cities_seller,
			//'vouchers_values' => $vouchers_values,
			'sId' => $sId
		]); 
    }
	
	public function update_sales_invoice_creditdebit(Request $request)  {  
            
		//echo "<pre>";print_r($request->all());exit;
		$sId = $request->id;
		
		$validation = $this->validatorSalesCredit($request->all());
        if ($validation->fails())  {  
            return response()->json($validation->errors()->toArray());
        }
        else{
			//start update 
			if($file = $request->hasFile('voucher_doc')) {
				$file = $request->file('voucher_doc') ;
				$fileName1 = date("YmdHis") . '-' . $file->getClientOriginalName() ;
				$destinationPath1 = public_path().'/uploads/sales-credit-debit' ;
				$file->move($destinationPath1,$fileName1);
				$voucher_doc = $fileName1 ;

				$update = DB::table('vouchers')
				->where('id', $sId)
				->update(
					 array(
						'voucher_doc' => $voucher_doc,
					 )
				);
			}
			if($request->reason_issuance == 'other'){
				$otherIssuance = $request->otherIssuance;
			}else{
				$otherIssuance = "";
			}
			$update = DB::table('vouchers')
					->where('id', $sId)
					->update(
						 array(								
								'inv_num' => $request->inv_num,
								'inv_date' => $request->inv_date,
								'seller_name' => $request->seller_name,
								'seller_addone' => $request->seller_addone,
								'seller_addtwo' => isset($request->seller_addtwo)?$request->seller_addtwo:"",
								'seller_country' => $request->seller_country,
								'seller_state' => $request->seller_state,
								'seller_city' => $request->seller_city,
								'seller_pin' => $request->seller_pin, 
								'v_name' => $request->v_name,
								'note_type' => $request->note_type,
								'note_date' => $request->note_date,
								'reason_issuance' => $request->reason_issuance,
								'otherIssuance' => $otherIssuance,
								
								'v_num' => $request->v_num,
								'credit_debit_amount' => isset($request->credit_debit_amount)?$request->credit_debit_amount:0,
								'adjusted_amount' => isset($request->adjusted_amount)?$request->adjusted_amount:0,            
								'terms_delivery' => isset($request->terms_delivery)?$request->terms_delivery:"", 
								'challan_no' => $request->challan_no,
								'challan_date' => $request->challan_date,			
								'doc_no' => $request->doc_no,
								'doc_date' => $request->doc_date,
								'term_condition' => isset($request->term_condition)?$request->term_condition:"",	
						 )
					);
			$msg = array(
				'status' => 'success',
				'class' => 'succ',
				'redirect' => url('/'),
				'message' => 'Record updated successfully'
			);
			return response()->json($msg);
			//end update item
			
		}	
    }
	
	
	
	public function sales_items_display_creditdebit(Request $request)
    {
		//$this->middleware('auth'); 
		
		$sid = $request->sId;
		$uid = Auth::user()->id;
		$prod_id = $request->prod_id;
		
		$product = DB::table('items')
								->select(DB::raw('items.id,items.item_name,items.selling_price,items.disc_sell,items.disc_sell_type'))
								->where('id', '=', $prod_id)
								->get();
		$quantity = 1;
		$rate = $product[0]->selling_price;
		$disc = 0;
		if($product[0]->disc_sell_type == "percentage")
		{
			$disc_amt = (($product[0]->selling_price*$product[0]->disc_sell)/100);
		}else{
			$disc_amt = $product[0]->disc_sell;
		}
		$tax_amt = 0;
		$amount = ($product[0]->selling_price - $disc_amt) * $quantity;
		$tax_type = "N/A";
		
		$values = array('sid' => $sid,'uid' => $uid,'prod_id' => $prod_id,'quantity' => $quantity,'rate' => $rate,'disc' => $disc,'disc_amt' => $disc_amt,'tax_amt'=>$tax_amt,'amount'=>$amount,'tax_type'=>$tax_type);
		$insertInvoice = DB::table('vouchers_values')->insert($values);
		
		
		$vouchers_values = $this->items_sales_list_credit_debit($sid);
		//echo "<pre>"; print_r($vouchers_values);exit;
		return view('pages.ajax-sales-credit-debit-display')->with([
			'vouchers_values'=>$vouchers_values,
		]);  
    }
	
	public function delSalesItemCreditDebit(Request $request)
    {
        $delSalesItem = DB::table('vouchers_values')->where('id', $request->id)->delete();
		$vouchers_values = $this->items_sales_list_credit_debit($request->sid);
		
		//echo "<pre>"; print_r($vouchers_values);exit;
		return view('pages.ajax-sales-credit-debit-display')->with([
			'vouchers_values'=>$vouchers_values,
		]);  
		
    }
	
	public function update_sales_item_creditdebit(Request $request)  {  
            
		//echo "<pre>";print_r($request->all());exit;
		$id = $request->id;
		
		$salesData = DB::table('vouchers_values')
								->select(DB::raw('vouchers_values.sid,vouchers_values.quantity'))
								->where('id', '=', $request->id)
								->get();
								
		$amount = ($request->rate - $request->disc_amt) * $salesData[0]->quantity;
		$update = DB::table('vouchers_values')
				->where('id', $id)
				->update(
					 array(
							'rate' => $request->rate,
							'disc_amt' => $request->disc_amt,
							'amount' => $amount,
							'tax_type' => $request->tax_type
					 )
				);
		
		$sales_data = DB::table('vouchers_values')
								->select(DB::raw('vouchers_values.sid'))
								->where('id', '=', $request->id)
								->get();
		$vouchers_values = $this->items_sales_list_credit_debit($sales_data[0]->sid);
		//echo "<pre>"; print_r($vouchers_values);exit;
		return view('pages.ajax-sales-credit-debit-display')->with([
			'vouchers_values'=>$vouchers_values,
		]);
    }
	
	public function update_sales_item_quantity_creditdebit(Request $request)  {  
            
		//echo "<pre>";print_r($request->all());exit;
		$id = $request->id;
		
		$sales_data = DB::table('vouchers_values')
								->select(DB::raw('vouchers_values.sid,vouchers_values.rate,vouchers_values.disc_amt'))
								->where('id', '=', $request->id)
								->get();
		$productRate = ($sales_data[0]->rate - $sales_data[0]->disc_amt);
		
		$rate = $productRate * $request->quantity;
		$update = DB::table('vouchers_values')
				->where('id', $id)
				->update(
					 array(
							'quantity' => $request->quantity,
							//'rate' => $rate,
							'amount' => $rate 
					 )
				);
				
		$vouchers_values = $this->items_sales_list_credit_debit($sales_data[0]->sid);
		//echo "<pre>"; print_r($vouchers_values);exit;
		return view('pages.ajax-sales-credit-debit-display')->with([
			'vouchers_values'=>$vouchers_values,
		]);
    }
	
	public function update_sales_item_rate_creditdebit(Request $request)  {  
            
		//echo "<pre>";print_r($request->all());exit;
		$id = $request->id;
		$prod_id = $request->prod_id;
		
		$sales_data = DB::table('vouchers_values')
								->select(DB::raw('vouchers_values.sid,vouchers_values.quantity,vouchers_values.disc_amt'))
								->where('id', '=', $request->id)
								->get();

		$rate = $request->rate;
		$update = DB::table('vouchers_values')
				->where('id', $id)
				->update(
					 array(
							'rate' => $rate,
							'amount' => ($rate - $sales_data[0]->disc_amt) * $sales_data[0]->quantity
					 )
				);
		
		$vouchers_values = $this->items_sales_list_credit_debit($sales_data[0]->sid);
		//echo "<pre>"; print_r($vouchers_values);exit;
		return view('pages.ajax-sales-credit-debit-display')->with([
			'vouchers_values'=>$vouchers_values,
		]);
    }
	
	public function update_sales_invoice_final_creditdebit(Request $request)  {  
	
		//print_r($_FILES);		
		$signature_name = $request->signature_name;

		if($file = $request->hasFile('signature')) {
			$file = $request->file('signature') ;
			
			$fileName1 = date("YmdHis") . '-' . $file->getClientOriginalName() ;
			$destinationPath1 = public_path().'/uploads/invoice-signature' ;
			
			$file->move($destinationPath1,$fileName1);
			$signature = $fileName1 ;
			
			//Update file
			$update = DB::table('vouchers')
			->where('id', $request->id)
			->update(
				 array(
						'signature' => $signature,
						'signature_name' => $signature_name,
						'status' => 1,
						
				 )
			);
		}else{
			$update = DB::table('vouchers')
				->where('id', $request->id)
				->update(
					 array(
							'signature_name' => $signature_name,
							'status' => 1,
							
					 )
				);
		}

		$msg = array(
			'status' => 'success',
			'class' => 'succ',
			'redirect' => url('/sales-credit-debit'),
			'message' => 'Record successfully updated',
		);
		return response()->json($msg);			
	}
	
	public function delInvoiceCreditDebit(Request $request)
    {
        $delInvoice = DB::table('vouchers')->where('id', $request->id)->delete();
        $delInvoiceItemValue = DB::table('vouchers_values')->where('sid', $request->id)->delete();
		if($delInvoice){
			$msg = array(
				'status' => 'success',
				'class' => 'succ',
				'redirect' => url('/sales-credit-debit'),
				'message' => 'Asset voucher deleted successfully.'
			);
			return response()->json($msg);
		}else{
			$msg = array(
				'status' => 'error',
				'class' => 'err',
				'redirect' => url('/sales-credit-debit'),
				'message' => 'Delete action failed!'
			);
			return response()->json($msg);
		}
    }
	
	//Activate sales credit
	public function activateSalesCreditDebitStatus(Request $request)
    {
        $user = Vouchers::find($request->id);
        $user->status = $request->status;
        $user->save();
        //return response()->json(['success'=>'Status change successfully.']);
		$msg = array(
			'status' => 'success',
			'class' => 'succ',
			'redirect' => url('/sales-credit-debit'),
			'message' => 'Status change successfully.'
		);
		return response()->json($msg);

    }
	
	//Paid invoic credit
	public function paidInvCreditDebit(Request $request)
    {
        $user = Vouchers::find($request->id);
        $user->is_paid = $request->status;
        $user->save();
        //return response()->json(['success'=>'Status change successfully.']);
		$msg = array(
			'status' => 'success',
			'class' => 'succ',
			'redirect' => url('/sales-credit-debit'),
			'message' => 'Status change successfully.'
		);
		return response()->json($msg);
    }
	
	public function getPdfSales($sid)
	{
		$sid = base64_decode($sid);
		$sales = DB::table('sales')
								->select(DB::raw('sales.*'))
								->where('id', '=', $sid)
								->get();
		$sales = $sales[0];	
		$inv_num = $sales->inv_num;
		$sales_values = DB::table('sales_values')
								->select(DB::raw('sales_values.*'))
								->where('sid', '=', $sid)
								->get();
								
		$array = array();
		foreach($sales_values as $k=>$val)
		{
			$array[$k]['id'] = $val->id;
			$array[$k]['sid'] = $val->sid;
			$array[$k]['prod_id'] = $val->prod_id;
			$array[$k]['quantity'] = $val->quantity;
			$array[$k]['rate'] = $val->rate;
			$array[$k]['disc'] = $val->disc;
			$array[$k]['disc_type'] = $val->disc_type;
			$array[$k]['disc_amt'] = $val->disc_amt;
			$array[$k]['tax_amt'] = $val->tax_amt;
			$array[$k]['amount'] = $val->amount;
			$array[$k]['tax_type'] = $val->tax_type;
			$array[$k]['gst_rate'] = $val->gst_rate;
			$array[$k]['billing_type'] = $val->billing_type;
			$array[$k]['prod_gov_fee'] = $val->prod_gov_fee;
			$array[$k]['gst_trans'] = $val->gst_trans;

			if($val->prod_id >0){
				$item = Items::where('id', '=', $val->prod_id)->get();
				$array[$k]['item_name'] = isset($item[0]->item_name)?$item[0]->item_name:"";
				$array[$k]['base_unit'] = isset($item[0]->base_unit)?$item[0]->base_unit:"";
				$array[$k]['sec_unit'] = isset($item[0]->sec_unit)?$item[0]->sec_unit:"";
			}else{
				$array[$k]['item_name'] = "";
				$array[$k]['base_unit'] = "";
				$array[$k]['sec_unit'] = "";
			} 
			$array[$k]['inv_num'] = $inv_num;
			$array[$k]['added_by'] = $sales->added_by;
			$array[$k]['signature'] = $sales->signature;
			$array[$k]['signature_name'] = $sales->signature_name;
		}
		$sales_values = json_decode(json_encode($array));
		
		$pdf = \PDF::loadView('pages.sales-invoice-pdf', compact('sales_values'))->setOptions(['dpi' => 150, 'defaultFont' => 'sans-serif','isHtml5ParserEnabled' => true, 'isRemoteEnabled' => true]);
		$pdfName = 'Sales-Inv-'.$inv_num.'.pdf';
		return $pdf->stream($pdfName);
	}
	
	public function getPdfSalesCreditDebit($sid)
	{
		$sid = base64_decode($sid);
		$vouchers = DB::table('vouchers')
								->select(DB::raw('vouchers.*'))
								->where('id', '=', $sid)
								->get();
		$vouchers = $vouchers[0];	
		$v_num = $vouchers->v_num;
		$sales_values = DB::table('vouchers_values')
								->select(DB::raw('vouchers_values.*'))
								->where('sid', '=', $sid)
								->get();
								
		$array = array();
		foreach($sales_values as $k=>$val)
		{
			$array[$k]['id'] = $val->id;
			$array[$k]['sid'] = $val->sid;
			$array[$k]['prod_id'] = $val->prod_id;
			$array[$k]['quantity'] = $val->quantity;
			$array[$k]['rate'] = $val->rate;
			$array[$k]['disc'] = $val->disc;
			$array[$k]['disc_amt'] = $val->disc_amt;
			$array[$k]['tax_amt'] = $val->tax_amt;
			$array[$k]['amount'] = $val->amount;
			$array[$k]['tax_type'] = $val->tax_type;

			if($val->prod_id >0){
				$item = Items::where('id', '=', $val->prod_id)->get();
				$array[$k]['item_name'] = isset($item[0]->item_name)?$item[0]->item_name:"";
				$array[$k]['base_unit'] = isset($item[0]->base_unit)?$item[0]->base_unit:"";
				$array[$k]['sec_unit'] = isset($item[0]->sec_unit)?$item[0]->sec_unit:"";
			}else{
				$array[$k]['item_name'] = "";
				$array[$k]['base_unit'] = "";
				$array[$k]['sec_unit'] = "";
			} 
			$array[$k]['inv_num'] = $v_num;
			$array[$k]['added_by'] = $vouchers->added_by;
			$array[$k]['signature'] = $vouchers->signature;
			$array[$k]['signature_name'] = $vouchers->signature_name;
		}
		$sales_values = json_decode(json_encode($array));
		
		$pdf = \PDF::loadView('pages.sales-invoice-credit-debit-pdf', compact('sales_values'))->setOptions(['dpi' => 150, 'defaultFont' => 'sans-serif','isHtml5ParserEnabled' => true, 'isRemoteEnabled' => true]);
		$pdfName = 'Sales-Inv-CreditDebit-'.$v_num.'.pdf';
		return $pdf->stream($pdfName);
	}
	
	//End voucher
	
    public function OnlineOrderIndex()
    {
        //$this->middleware('auth');
        return view('pages.online-order')->with([

        ]);
    }
    public function addOnlineOrder()
    {
        //$this->middleware('auth');
        return view('pages.add-online-order')->with([

        ]);
    }
    
    public function RecurringInvoiceIndex()
    {
        //$this->middleware('auth');
        return view('pages.sales-recurring-invoice')->with([

        ]);
    }
    public function addRecurringInvoice()
    {
        //$this->middleware('auth');
        return view('pages.add-sales-recurring-invoice')->with([

        ]);
    }
}
