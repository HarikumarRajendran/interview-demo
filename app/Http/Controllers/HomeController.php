<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Usergroup;
use Validator;

class HomeController extends Controller
{

	public function getIndex(){
		
		if (request()->session() ->has('AdminId'))
        {

            return redirect()->route('get-admin');

        }else if (request()->session()->has('UsrId'))
        {

            return redirect()->route('get-user');

        }
        else
        {

            return view('welcome');
        }
	}

    public function postLogin(){

    	$name = request()->input('username');
    	$pwd = request()->input('password');

    	$password = md5($pwd);
  	
    	$chkusr = Usergroup::checkLogin($name, $password);  	

    	if($chkusr){

    		if($chkusr->status == '1'){


	    		if($chkusr->access == '1'){

	    			request()->session()->put('AdminId', $chkusr->id);

	                return redirect()->route('get-admin');


	    		}

	    		if($chkusr->access == '2'){
	    			
	    			request()->session()->put('UsrId', $chkusr->id);

	                return redirect() ->route('get-user');
	    		}
    		} else {

    			return redirect() ->route('get-login')->with('Errmsg', 'Please contact admin');
    	
    		}
    	
    	} else {

    		return redirect() ->route('get-login')->with('Errmsg', 'Please check username/password');
    	}
        
    }

    public function getAdmin(){
   
        if (!request()->session()->has('AdminId'))
        {

            return redirect()->route('get-login');

        }
        else
        {

        	$Data['AdminDt'] = Usergroup::all();

            return view('Admin')->with($Data);
        }
        
    }

    public function postAddUser(){

	    $Success = false;


	    if(!request()->session()->has('AdminId') && !request()->session()->has('UsrId')){

	        return redirect()->route('get-login');
	   
	    }else{

	    	$validator = Validator::make(request()->all(), [
                'userName'         => 'required',
                'email'     	   => 'required',
                'mobileno'         => 'required|max:10',
                'address'          => 'required',
                'zipcode'          => 'required|max:6',
                'access'           => 'required'
            ]);

            if($validator->fails()){
                $Data['Msg'] = 'Fill The Details';
            }else{

            	$name       = request()->input('userName');
                $email      = request()->input('email');
                $mobileno   = request()->input('mobileno');
                $address    = request()->input('address');
                $zipcode    = request()->input('zipcode');
                $access     = request()->input('access');
                $password   = md5('123456');



                $Usergroup = Usergroup::InsertUser($name,$email,$mobileno,$address,$zipcode,$access,$password);
                
                if($Usergroup){

                	if (request()->session()->has('AdminId')){

                		$Data['UserDt'] = Usergroup::find($Usergroup);
                	}
                	
                	$Success = true;
                	$Data['Success'] = $Success;
				} else {

					$Data['Msg'] = 'Something went wrong!!';
				}   	
	    
	    	}

	    	return response()->json($Data);
        
    	}
	}

    public function postUpdateUser(){

	    $Success = false;

	    if(!request()->session()->has('AdminId') && !request()->session()->has('UsrId')){

	        return redirect()->route('get-login');
	   
	    }else{


            	$id       = request()->input('UserId');
            	$name       = request()->input('name');
                $email      = request()->input('email');
                $mobileno   = request()->input('mobile');
                $address    = request()->input('address');
                $zipcode    = request()->input('zipcode');

                $Usergroup = Usergroup::UpdateUser($id,$name,$email,$mobileno,$address,$zipcode);
                
                if($Usergroup){

                	if (request()->session()->has('AdminId')){

                		$Data['UserDt'] = Usergroup::find($Usergroup);
                	}
                	
                	$Success = true;
                	$Data['Success'] = $Success;
				} else {

					$Data['Msg'] = 'Something went wrong!!';
				}   	


            return response()->json($Data);    	
	    
	    }
        
    }

    public function postAdminUserStatus(){

        $Success = false;

        if (!request()->session()->has('AdminId'))
        {

            $Data['Msg'] = 'Please Login';
        }
        else
        {

            $BookId = request()->input('ActId');

            $Data['Status'] = Usergroup::changeUserStatus($BookId);
            $Data['Msg'] = 'Updated Successfully';
            $Success = true;
        }

        $Data['Success'] = $Success;
        return response()->json($Data);
    }

    public function getAdminLogout(){

	    if(!request()->session()->has('AdminId')){

	        return redirect()->route('get-login');
	    }else{

	        request()->session()->forget('AdminId');
	        return redirect()->route('get-login');
	    }
	}

	public function getUser(){
     
        if (!request()->session()->has('UsrId'))
        {

            return redirect()->route('get-login');

        }
        else
        {

        	$UsrId = request()->session()->has('UsrId');

        	$Data['UserDt'] = Usergroup::find($UsrId);

            return view('User')->with($Data);
        }   
    }

    public function getUserLogout(){

	    if(!request()->session()->has('UsrId')){

	        return redirect()->route('get-login');
	    }else{

	        request()->session()->forget('UsrId');
	        return redirect()->route('get-login');
	    }
	}
}