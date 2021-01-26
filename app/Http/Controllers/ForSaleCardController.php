<?php

namespace App\Http\Controllers;

use App\Models\ForSaleCard;
use Illuminate\Http\Request;
use App\Models\Card;
use App\Models\User;
use App\Models\Collection;

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

        $cards = Card::where('name',$name)->get()->toArray();
        $cardsForSale = ForSaleCard::all();
        $users = User::all();

        $result = [];

        if($cards){

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

            $response = $result;

        }else{
            $response = "Cards Not Found";
        }

        return response($response);
    }
    
}
