<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Card;
use App\Models\User;
use App\Models\Collection;
use Illuminate\Support\Facades\Log;

class CardController extends Controller
{
    public function newCard(Request $request) {

        $response = "";

        $data = $request->only('username','cardname','description','collection_id');

        //$data = json_decode($data);

        if($data){

            $card = new Card();
            $user = User::where('name', $data["username"])->first();
            if($user->status != "Admin"){
                $response = "Access Denied";
            }else{

                $card->name = $data["cardname"];
                $card->description = $data["description"];
                $card->collection_id = $data["collection_id"];
    
                $collection_id_check = json_decode($data["collection_id"], true);
                $checked_collection_ids = [];
                $collection_OK = true;
                
                foreach ($collection_id_check as $collection_id) {
                    $checked_collection_id = json_decode(Collection::where('id', $collection_id)->first());

                    if ($checked_collection_id){
                        $checked_collection_ids[] = $checked_collection_id->id;
                    }else{
                        $collection_OK = false;
                    }
                }

                if(count($checked_collection_ids) > 0){
                    $card->collection_id = $checked_collection_ids;

                    try{

                        $card->save();
        
                        /*if($collection_OK){
                            $response = "New Card: ".$card->name." saved succesfully";
                        }else{ $response = "New Card: ".$card->name." saved succesfully || Not All Collection IDs Where Correct"; }
                        */
                        return view('index')->with('user',$user);
        
                    }catch(\Exception $e){
                        $response = $e->getMessage();
                    }

                }else{
                    $response = "Collections Not Found";
                }
            }
        }else{
            $response = "Incorrect Data";
        }

        return response($response);

    }

    public function searchCard(Request $request){

        Log::info("Búsqueda de cartas por nombre");

        $data = $request->only('name','user');

        if(isset($data["user"])){
            $user = User::where('name',$data["user"])->first();
        }
       

        //$data = json_decode($data);

        if($data["name"]){
            Log::debug("Nombre buscado: ".$data["name"]);
            $trimmedName = trim($data["name"]);
            $cards = Card::where('name',$trimmedName)->get();
            
            if($cards && isset($user)){
                return view('index')->with('cards', $cards)->with('user',$user);
            }else if($cards){
                return view('index')->with('cards', $cards);
            }else{
                return view('index')->with('NaN', 'NaN');
            }
            
        }elseif(empty($data["name"])){
            $cards = Card::all();
            if(isset($user)){
                return view('index')->with('cards', $cards)->with('user',$user);
            }else{
                return view('index')->with('cards', $cards);
            }
            

        }

        return response($response);
    }
}
