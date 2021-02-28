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

        $data = $request->getContent();

        $data = json_decode($data);

        if($data){

            $card = new Card();
            $user = User::where('name', $data->userName)->first();
            if($user->status != "Admin"){
                $response = "Access Denied";
            }else{

                $card->name = $data->name;
                $card->description = $data->description;
                $card->collection_id = $data->collection_id;
    
                $collection_id_check = json_decode($data->collection_id, true);
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
        
                        if($collection_OK){
                            $response = "New Card: ".$card->name." saved succesfully";
                        }else{ $response = "New Card: ".$card->name." saved succesfully || Not All Collection IDs Where Correct"; }
                        
        
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

    public function searchCard($name){

        Log::info("Búsqueda de cartas por nombre");

        if($name){
            Log::debug("Nombre buscado: ".$name);
            $trimmedName = trim($name);
            $cards = Card::where('name',$trimmedName)->get()->toArray();
            $encodedCards = json_encode($cards);
        }else{
            Log::debug("Nombre no introducido");
        }
        $result = [];

        if($cards){
            Log::debug("Cantidad de cartas devueltas: ".count($cards));
            foreach($cards as $card){
                $result[] = [
                    "id" => $card['id'],
                    "name" => $card['name']                  
                ];
            }

            $encodedResult = json_encode($result);

            Log::debug("Resultado de búsqueda: ".$encodedResult);

            $response = $result;

        }else{
            Log::debug("No se han encontrado resultados");
            $response = "Cards Not Found";
        }

        $encodedresponse = json_encode($result);
        Log::info("Información final de búsqueda: ".$encodedresponse);

        return response($response);
    }
}
