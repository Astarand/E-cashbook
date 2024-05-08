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
use App\Liabilities;
use Helper;
use Image;
use Illuminate\Support\Facades\Cookie;


class LiabilitiesController extends Controller
{
    public function Index()
    {
		$title = 'Liabilities';
		$userId = Auth::user()->id;
		if(Auth::user()->u_type ==2){ //Customer
			$liabilities =  DB::table('liabilities')
							->select(DB::raw('liabilities.*,company_profiles.comp_name'))
							->leftJoin('company_profiles', 'liabilities.added_by', '=', 'company_profiles.userId')
							->where('liabilities.added_by', '=', $userId)
							->orderBy('liabilities.id', 'DESC')->paginate(10);
							
			$c_liabilities = DB::table('liabilities')
							->select(DB::raw('liabilities.id,
								SUM(IF((liabilities.ac_payable >=0), ac_payable, 0)) as ac_payable,
								SUM(IF((liabilities.short_term_loans >=0), short_term_loans, 0)) as short_term_loans,
								SUM(IF((liabilities.accrued_liabilities >=0), accrued_liabilities, 0)) as accrued_liabilities,
								SUM(IF((liabilities.long_term_debt >=0), long_term_debt, 0)) as long_term_debt,
								SUM(IF((liabilities.unearned_revenue >=0), unearned_revenue, 0)) as unearned_revenue,
								SUM(IF((liabilities.current_liabilities >=0), current_liabilities, 0)) as current_liabilities'))	
							->where('liabilities.added_by','=',Auth::user()->id)
							->where('liabilities.liab_type','=',"c_liabilities")
							->get();
			$long_liabilities = DB::table('liabilities')
							->select(DB::raw('liabilities.id,
								SUM(IF((liabilities.ac_payable >=0), ac_payable, 0)) as ac_payable,
								SUM(IF((liabilities.long_term_debt >=0), long_term_debt, 0)) as long_term_debt,
								SUM(IF((liabilities.deferred_tax_liabilities >=0), deferred_tax_liabilities, 0)) as deferred_tax_liabilities,
								SUM(IF((liabilities.pension_liabilities >=0), pension_liabilities, 0)) as pension_liabilities,
								SUM(IF((liabilities.lease_liabilities >=0), lease_liabilities, 0)) as lease_liabilities,
								SUM(IF((liabilities.long_term_liabilities >=0), long_term_liabilities, 0)) as long_term_liabilities'))	
							->where('liabilities.added_by','=',Auth::user()->id)
							->where('liabilities.liab_type','=',"long_liabilities")
							->get();
		}
		$liabilities_pagination = $liabilities;
		
		$c_liabilities = $c_liabilities[0];
		$c_liabilities = ($c_liabilities->ac_payable + $c_liabilities->short_term_loans + $c_liabilities->accrued_liabilities + 
						  $c_liabilities->long_term_debt + $c_liabilities->unearned_revenue + $c_liabilities->current_liabilities);
		
		$long_liabilities = $long_liabilities[0];
		$long_liabilities = ($long_liabilities->ac_payable + $long_liabilities->long_term_debt + $long_liabilities->deferred_tax_liabilities + 
							$long_liabilities->pension_liabilities + $long_liabilities->lease_liabilities + $long_liabilities->long_term_liabilities);
		
		$total_liabilities = ($c_liabilities + $long_liabilities);
		$array = array();
		foreach($liabilities as $k=>$val)
		{
			$array[$val->id]['id'] = $val->id;
			$array[$val->id]['comp_name'] = $val->comp_name;
			$array[$val->id]['liab_type'] = $val->liab_type;
			$array[$val->id]['ac_payable'] = $val->ac_payable;
			if($val->liab_type =='c_liabilities'){
			$array[$val->id]['total_payable'] = ($val->ac_payable + $val->short_term_loans + $val->accrued_liabilities + 
						  $val->long_term_debt + $val->unearned_revenue + $val->current_liabilities);
			}else{
			$array[$val->id]['total_payable'] = ($val->ac_payable + $val->long_term_debt + $val->deferred_tax_liabilities + 
							$val->pension_liabilities + $val->lease_liabilities + $val->long_term_liabilities);
			}			
			$array[$val->id]['created_at'] = $val->created_at;
			$array[$val->id]['status'] = $val->status;
		}
		$liabilities = json_decode(json_encode($array));
		
		//echo "<pre>"; print_r($c_liabilities);exit;
		return view('pages.liabilities')->with([
			'title' =>$title,
			'c_liabilities' =>$c_liabilities,
			'long_liabilities' =>$long_liabilities,
			'total_liabilities' =>$total_liabilities,
			'liabilities'=>$liabilities,
			'liabilities_pagination' =>$liabilities_pagination,
		]); 

    }
    public function AddLiabilities()
    {
        return view('pages.addliabilities');
    }
	
	protected function validator(array $data)
    {
		//echo "<pre>"; print_r($data);exit;
		if($data['liab_type'] == 'c_liabilities'){
			return Validator::make($data, [
				'liab_type' => 'required',
				//'ac_payable' => 'required|numeric',
				//'short_term_loans' => 'required|numeric',
				//'accrued_liabilities' => 'required|numeric',
				//'long_term_debt' => 'required|numeric',
				//'unearned_revenue' => 'required|numeric',
				//'current_liabilities' => 'required|numeric',
			]);
		}else{
			return Validator::make($data, [
				'liab_type' => 'required',
				//'ac_payable_two' => 'required|numeric',
				//'long_term_debt_two' => 'required|numeric',
				//'deferred_tax_liabilities' => 'required|numeric',
				//'pension_liabilities' => 'required|numeric',
				//'lease_liabilities' => 'required|numeric',
				//'long_term_liabilities' => 'required|numeric',
			]);
		}
		
			
    }

    protected function create(array $data)
    {
		//echo "<pre>";print_r($data);exit;		
		if($data['liab_type'] == 'c_liabilities'){
			return Liabilities::create([
				'added_by' => Auth::user()->id,
				'liab_type' => $data['liab_type'],
				'ac_payable' => $data['ac_payable'],
				'short_term_loans' => $data['short_term_loans'],
				'accrued_liabilities' => $data['accrued_liabilities'],
				'long_term_debt' => $data['long_term_debt'],
				'unearned_revenue' => $data['unearned_revenue'],
				'current_liabilities' => $data['current_liabilities'],                   
				'created_at' => date('Y-m-d H:i:s'),
			]);
		}else{
			return Liabilities::create([
				'added_by' => Auth::user()->id,
				'liab_type' => $data['liab_type'],
				'ac_payable' => $data['ac_payable_two'],
				'long_term_debt' => $data['long_term_debt_two'],
				'deferred_tax_liabilities' => $data['deferred_tax_liabilities'],
				'pension_liabilities' => $data['pension_liabilities'],
				'lease_liabilities' => $data['lease_liabilities'],
				'long_term_liabilities' => $data['long_term_liabilities'],                   
				'created_at' => date('Y-m-d H:i:s'),
			]);
		}
    }
	
	public function saveLiabilities(Request $request)  {  
            
		$validation = $this->validator($request->all());
        if ($validation->fails())  {  
            return response()->json($validation->errors()->toArray());
        }
        else{
			$insertLiabilities = $this->create($request->all());
			$liabId = DB::getPdo()->lastInsertId();
			
			if ($insertLiabilities){
				$msg = array(
					'status' => 'success',
					'class' => 'succ',
					'redirect' => url('/liabilities'),
					'message' => 'Liabilities added successfully'
				);
				return response()->json($msg);	
			}else{
				$msg = array(
					'status' => 'error',
					'class' => 'err',
					'redirect' => url('/'),
					'message' => 'Liabilities add failed'
				);
				return response()->json($msg);	
			}
				
		}	
    }
	
	public function edit_liabilities($liabId)  {  
        
		if(Auth::user()->u_type !=2){
			return redirect('/');
		}
		$liabId = base64_decode($liabId);		
		$liabilities = DB::table('liabilities')
								->select(DB::raw('liabilities.*'))
								->where('id', '=', $liabId)
								->where('added_by', '=', Auth::user()->id)
								->get();
		$liabilities = $liabilities[0];
		//echo "<pre>";print_r($sales);exit;
		return view('pages.edit-liabilities')->with([	
			'liabilities' => $liabilities,
			'liabId' => $liabId
		]); 
    }
	
	public function updateLiabilities(Request $request)  {  
            
		//echo "<pre>";print_r($request->all());exit;
		$liabId = $request->liabId;
		
		$validation = $this->validator($request->all());
        if ($validation->fails())  {  
            return response()->json($validation->errors()->toArray());
        }
        else{
			//start update 
			if($request->liab_type == 'c_liabilities'){
				$update = DB::table('liabilities')
					->where('id', $liabId)
					->update(
						 array(								
							'liab_type' => $request->liab_type,
							'ac_payable' => $request->ac_payable,
							'short_term_loans' => $request->short_term_loans,
							'accrued_liabilities' => $request->accrued_liabilities,
							'long_term_debt' => $request->long_term_debt,
							'unearned_revenue' => $request->unearned_revenue,
							'current_liabilities' => $request->current_liabilities,	
						 )
					);
			}else{
				$update = DB::table('liabilities')
					->where('id', $liabId)
					->update(
						 array(								
							'liab_type' => $request->liab_type,
							'ac_payable' => $request->ac_payable_two,
							'long_term_debt' => $request->long_term_debt_two,
							'deferred_tax_liabilities' => $request->deferred_tax_liabilities,
							'pension_liabilities' => $request->pension_liabilities,
							'lease_liabilities' => $request->lease_liabilities,
							'long_term_liabilities' => $request->long_term_liabilities,	
						 )
					);
			}
			
			$msg = array(
				'status' => 'success',
				'class' => 'succ',
				'redirect' => url('/liabilities'),
				'message' => 'Record updated successfully'
			);
			return response()->json($msg);
			//end update item
			
		}	
    }
	
	public function delLiabilities(Request $request)
    {
        $delLiabilities = DB::table('liabilities')->where('id', $request->id)->delete();
		if($delLiabilities){
			$msg = array(
				'status' => 'success',
				'class' => 'succ',
				'redirect' => url('/liabilities'),
				'message' => 'Liabilities deleted successfully.'
			);
			return response()->json($msg);
		}else{
			$msg = array(
				'status' => 'error',
				'class' => 'err',
				'redirect' => url('/liabilities'),
				'message' => 'Delete action failed!'
			);
			return response()->json($msg);
		}
    }

}
