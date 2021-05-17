<?php

namespace App\Http\Controllers;

use App\Models\Chat;
use App\Models\Party;
use App\Models\PartyUser;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ChatController extends Controller
{
    public function createMessage(Request $request,$partyId)
    {
        $userId = $request->user()->id;
        $msg = $request->get('message');

        $findParty = Party::find($partyId);

        if(!$findParty)
        {
            return response()->json(['message' => 'No se ha encontrado esa party'], 404);
        }

        $findPartyUser = PartyUser::where('party_id', $partyId)->where('user_id', $userId)->first();

        if(!$findPartyUser)
        {
            return response()->json(['message' => 'No estas en esta party'], 404);
        }

        Chat::create([
            'user_id' => $userId,
            'party_id' => $partyId,
            'msg' => $msg
        ]);

        return response()->json(['message' => 'mensaje creado!'], 200);
    }

    public function getMessages($partyId)
    {
        $findMessages = Chat::where('party_id', $partyId)->get();
        if (empty($findMessages->toArray()))
            return response()->json(['message' => "no hay mensajes"], 400);
        return response()->json(['message' => $findMessages], 200);

    }

    public function editMessage(Request $request, $id){
        $msg = $request->get('message');
        $chat = Chat::where('id','=',$id)
        ->update([
            'msg' => $msg
        ]);
        return response()->json(['message' => 'mensaje editado!'], 200);
    }    
}
