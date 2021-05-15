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

    public function getMessages(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'party_id' => ['required', 'integer']
        ]);
        if($validator->fails()){
            return response()->json(['error' => [
                'created' => false,
                'message' => $validator->errors()->all()]], 400);
        }

        $partyId = $request->party_id;

        $findMessages = Chat::where('party_id', $partyId)->get();

        return response()->json(['message' => $findMessages], 200);

    }
}
