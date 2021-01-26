<?php

namespace App\Http\Controllers;

use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\Collection;
use App\Models\Card;
use App\Models\User;

class CollectionController extends Controller
{
    public function newCollection(Request $request) {
        $response = "";

        $data = $request->data;

        $data = json_decode($data);

        if($data){

            $collection = new Collection();

            $collection->name = $data->name;
            
            if($request->hasFile('symbol')){
                $path = $request->file('symbol')->getRealPath();
                $symbol = file_get_contents($path);
                $base64 = base64_encode($symbol);
                $collection->symbol = $base64;
            }
            
            if($data->edition_date && strtotime($data->edition_date) != NULL){
                $collection->edition_date = $data->edition_date;
            }else{
                $response .= " Incorrect Date Format | ";
            }

            try{

                $collection->save();

                $response .= "New Collection: ".$collection->name." saved succesfully";

                if(Str::contains($request->symbol, 'png')){
                    $response .= "<img src='data:image/png;base64,".$base64."'>";
                }else{
                    $response .= "<img src='data:image/jpeg;base64,".$base64."'>";
                }
                $card = Card::where('id',1)->first();
                if($card){
                    $tempCollectionID = [];
                    $tempCollectionID = $card->collection_id;
                    $tempCollectionID[] = Collection::where('name',$collection->name)->first()->id;
                    $card->collection_id = $tempCollectionID;
                    
                }else{

                    $card = new Card();
                    $card->name = "Placeholder";
                    $card->description = "Placeholder";

                    $tempCollectionID = [];
                    $tempCollectionID[] = Collection::where('name',$collection->name)->first()->id;
                    $card->collection_id = $tempCollectionID;

                }

                try{

                    $card->save();

                    $response .= " Created Placeholder Card";

                }catch(\Exception $e){
                    $response .= $response = $e->getMessage();
                }

            }catch(\Exception $e){
                $response = $e->getMessage();
            }

        }else{
            $response = "Incorrect Data";
        }

        return response($response);
    }

    public function editCollection(Request $request){
        $response = "";

        $data = $request->data;

        $data = json_decode($data);

        if($data){

            $collection = Collection::find($data->id);

            if($collection){
                if($data->name){
                    $collection->name = $data->name;
                }            
                if($request->hasFile('symbol') && $request->symbol){
                    $path = $request->file('symbol')->getRealPath();
                    $symbol = file_get_contents($path);
                    $base64 = base64_encode($symbol);
                    $collection->symbol = $base64;
                }
    
                if($data->edition_date && strtotime($data->edition_date) != NULL){
                    $collection->edition_date = $data->edition_date;
                }else{
                    $response .= " Incorrect Date Format | ";
                }
    
                try{
    
                    $collection->save();
    
                    $response .= "Collection: ".$collection->name." edited succesfully";
    
                    if(Str::contains($request->symbol, 'png')){
                        $response .= "<img src='data:image/png;base64,".$collection->symbol."'>";
                    }else{
                        $response .= "<img src='data:image/jpeg;base64,".$collection->symbol."'>";
                    }
    
                }catch(\Exception $e){
                    $response = $e->getMessage();
                }
            }



        }else{
            $response = "Incorrect Data";
        }

        return response($response);
    }
}
