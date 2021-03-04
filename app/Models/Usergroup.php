<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Usergroup extends Model
{

	protected $fillable = ['id', 'name', 'email', 'mobile', 'address', 'zipcode', 'access', 'password', 'status'];

    protected $table = 'usergroups';

    protected function checkLogin($name = '', $password = ''){

        $chkUsr = $this->where('email', $name)->where('password', $password)->first();

        if($chkUsr){

           return $chkUsr;
    
        }   
        
        return false;
    }

    protected function InsertUser($name = '', $email = '', $mobileno = '', $address = '', $zipcode = '', $access = '', $password = ''){

    	$InAry = [
            'name' => $name,
            'email' => $email,
            'mobile' => $mobileno,
            'address' => $address,
            'zipcode' => $zipcode,
            'access' => $access,
            'password' => $password,
            'status' => '1'
        ];

        $User = $this->create($InAry);
        return $User->id;

    }

    protected function UpdateUser($id = '', $name = '', $email = '', $mobileno = '', $address = '', $zipcode = '') {

        $User = $this->where('id', $id)->first();

        if ($User) {

            $UpAry = [
                'name' => $name,
	            'email' => $email,
	            'mobile' => $mobileno,
	            'address' => $address,
	            'zipcode' => $zipcode
            ];
        }

        $this->where('id', $id)->update($UpAry);

        return $User->id;
    }

    protected function changeUserStatus($UserId = '') {

        $User = $this->where('id', $UserId)->first();

        if ($User) {

            $Status = 0;

            if ($User->status == 0) {

                $Status = 1;
            }

            $this->where('id', $UserId)->update(['status' => $Status]);

            return $Status;
        }
    }
}
