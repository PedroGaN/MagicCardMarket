<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class UserController extends Controller
{
    public function newUser(Request $request) {

        $response = "";

        $data = $request->getContent();

        $data = json_decode($data);

        if($data){

            $user = new User();

            $user->name = $data->name;
            $user->email = $data->email;
            $user->password = Hash::make($data->password);
            $checkStatus = $data->status;
            if($checkStatus != "Casual" && $checkStatus != "Professional" && $checkStatus != "Admin" ){
                $response = "Invalid Status Info";
            }else{
                $user->status = $data->status;
                
                try{

                    $user->save();

                    $response = "New User: ".$user->name." saved succesfully";

                }catch(\Exception $e){
                    $response = $e->getMessage();
                }
            }
            
        }else{
            $response = "Incorrect Data";
        }

        return response($response);

    }

    public function loginUser(Request $request) {
        $response = "";

        $data = $request->getContent();

        $data = json_decode($data);

        if($data){

            $user = User::where('name', $data->name)->first();
            if($user){
                if(Hash::check($data->password,$user->password)){
                    
                    $user->api_token = self::randomToken(8,"auth");

                    try{

                        $user->save();
    
                        $response = "Welcome ".$user->name."Login Token: ".$user->api_token;
                    }catch(\Exception $e){
                        $response = $e->getMessage();
                    }

                }else{
                    
                    $response = "Incorrect Password";
                }
            }else{
                $response = "Unknown User";
            }

        }else{
            $response = "Incorrect Data";
        }

        return response($response);

    }

    public function logoutUser(Request $request) {
        $response = "";

        $data = $request->getContent();

        $data = json_decode($data);

        if($data){

            $user = User::where('name', $data->name)->first();
            if($user){
                    
                $user->api_token = NULL;

                try{

                    $user->save();

                    $response = "Successful Logout";
                }catch(\Exception $e){
                    $response = $e->getMessage();
                }
            }else{
                $response = "Unknown User";
            }

        }else{
            $response = "Incorrect Data";
        }

        return response($response);

    }

    public function recoverPassword(Request $request) {
        $response = "";

        $data = $request->getContent();

        $data = json_decode($data);

        if($data){

            $user = User::where('email', $data->email)->first();
            if($user){
                $password = self::randomToken(5,"pass");
                $user->password = Hash::make($password);
                
                try{

                    $user->save();

                    $response = "Password renewed: ".$password;
                }catch(\Exception $e){
                    $response = $e->getMessage();
                }
                
            }else{
                $response = "Unknown User";
            }

        }else{
            $response = "Incorrect Data";
        }

        return response($response);

    }

    public function randomToken($length, $type){
        $randomToken = '';
        if($type == "pass"){
            $characters = array_merge(range('a','z'), range(0,9));
        }else{
            $characters = array_merge(range('A','Z'), range(10,30));
        }
    
        for($i = 1; $i <= $length; $i++){
            $randomToken .= $characters[rand(0,(sizeof($characters)-1))];
        }

        return $randomToken;
    }
}
