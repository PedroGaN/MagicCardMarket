<?php

namespace App\Http\Controllers;

use App\Models\ForSaleCard;
use Illuminate\Http\Request;
use App\Models\Card;
use App\Models\User;
use App\Models\Collection;
use Illuminate\Support\Facades\Log;

class ForSaleCardController extends Controller
{
    public function newForSaleCard(Request $request){
        $response = "";

        $data = $request->getContent();

        $data = json_decode($data);

        if($data){

            $forSaleCard = new ForSaleCard();
            $user = User::where('name', $data->userName)->first();
            $card = Card::find($data->cardID);
            if($user->status != "Casual" && $user->status != "Professional"){
                $response = "Access Denied";
            }else{

                $forSaleCard->card_id = $card->id;
                $forSaleCard->user_id = $user->id;
                $forSaleCard->prize = $data->prize;
                $forSaleCard->stock = $data->stock;
            
                try{

                    $forSaleCard->save();
                    
                    $response = "New Card For Sale: ".$card->name." saved succesfully. Price: ".$data->prize.". Stock: ".$data->stock;
                    
    
                }catch(\Exception $e){
                    $response = $e->getMessage();
                }
            }
        }else{
            $response = "Incorrect Data";
        }

        return response($response);

    }

    public function searchForSaleCard($name){

        Log::info("Búsqueda de cartas a la venta por nombre");

        if($name){
            Log::debug("Nombre buscado: ".$name);
            $trimmedName = trim($name);
            $cards = Card::where('name',$trimmedName)->get()->toArray();
            //$encodedCards = json_encode($cards);
        }else{
            Log::debug("Nombre no introducido");
        }
        
        $cardsForSale = ForSaleCard::orderBy('prize','ASC')->get();
        Log::debug("Cantidad de cartas a la venta: ".count($cardsForSale));
        //$encodedCardsForSale = json_encode($cardsForSale);
        $users = User::all();
        Log::debug("Cantidad de usuarios: ".count($users));
        //$encodedUsers = json_encode($users);

        $result = [];

        if($cards){
            Log::debug("Cantidad de cartas devueltas: ".count($cards));

            foreach($cards as $card){
                foreach($cardsForSale as $cardForSale){
                    if($card['id'] == $cardForSale['card_id']){
                        foreach($users as $user){
                            if($user['id'] == $cardForSale['user_id']){
                                $result[] = [
                                    "card_name" => $card['name'],
                                    "price" => $cardForSale['prize'],
                                    "stock" => $cardForSale['stock'],
                                    "user_name" => $user['name']                  
                                ];
                            }
                        }
                    }
                }
            }
            if(!empty($result)){
                $encodedResult = json_encode($result);
                Log::debug("Información del resultado de búsqueda: ".$encodedResult);
                $response = $result;
            }else{
                Log::debug("No se han encontrado resultados");
                $response = "Cards Not Found";
            }
        }else{
            $response = "Cards Not Found";
        }

        $encodedResponse = json_encode($response);
        Log::info("Información final de búsqueda: ".$encodedResponse);

        return response($response);
    }
    
}
