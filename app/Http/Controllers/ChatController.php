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
        $userId = $request->user()->id;
        $msg = $request->get('message');
        $chat = chat::find($id);

        if(empty($chat))
            return response()->json(['message' => 'no existe mensaje con id !'.$id], 400);
        
        $chat = Chat::where('id','=',$id)->where('user_id', '=', $userId)->first();        
        
        if(!$chat)
            return response()->json(['message' => 'no puedes editar los mensajes de otro usuario!'], 400);

        Chat::where('id','=',$id)->where('user_id', '=', $userId)
        ->update([
            'msg' => $msg
        ]);

        return response()->json(['message' => 'mensaje editado!'], 200);
    }    

    public function destroyMessage(Request $request, $id){
        $userId = $request->user()->id;
        $chat = chat::find($id);

        if(!$chat)
            return response()->json(['message' => 'no existe mensaje con id !'.$id], 400);
        
        $chat = Chat::where('id','=',$id)->where('user_id', '=', $userId)->first();        
        
        if(!$chat)
            return response()->json(['message' => 'no puedes borrar los mensajes de otro usuario!'], 400);

        Chat::destroy($id);

        return response()->json(['message' => 'mensaje borrado!'], 200);
    }    
}
