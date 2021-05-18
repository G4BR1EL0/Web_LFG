<?php

namespace App\Http\Controllers;

use App\Models\Ban;
use App\Models\Party;
use App\Models\PartyUser;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class BanController extends Controller
{
    public function ban(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'user_id' => ['required', 'integer'],
            'party_id' => ['required', 'integer']
        ]);
        if($validator->fails()){
            return response()->json(['error' => [
                'created' => false,
                'message' => $validator->errors()->all()]], 400);
        }

        $user = $request->user_id;
        $partyId = $request->party_id;

        $findUser = User::find($user);
        $findParty = Party::find($partyId);

        if(!$findUser)
        {
            response()->json(['message' => 'Usuario no encontrado'], 404);
        }
        if(!$findParty)
        {
            response()->json(['message' => 'Party no encontrada'], 404);
        }

        $isBanned = Ban::where('party_id', $partyId)->where('user_id', $user)->first();

        if($isBanned) return response()->json(['message' => 'Este usuario ya se encuentra baneado'], 400);

        Ban::create([
            'party_id' => $partyId,
            'user_id' => $user
        ]);

        PartyUser::where('party_id', $partyId)->where('user_id', $user)->delete();


        return response()->json(['message' => 'Usuario baneado'], 200);

    }

    public function unban(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'user_id' => ['required', 'integer'],
            'party_id' => ['required', 'integer']
        ]);
        if($validator->fails()){
            return response()->json(['error' => [
                'created' => false,
                'message' => $validator->errors()->all()]], 400);
        }

        $user = $request->user_id;
        $partyId = $request->party_id;

        $findUser = User::find($user);
        $findParty = Party::find($partyId);

        if(!$findUser)
        {
            response()->json(['message' => 'Usuario no encontrado'], 404);
        }
        if(!$findParty)
        {
            response()->json(['message' => 'Party no encontrada'], 404);
        }

        $isBanned = Ban::where('party_id', $partyId)->where('user_id', $user)->first();

        if(!$isBanned) return response()->json(['message' => 'Usuario no baneado en dicha party'], 400);

        Ban::where('party_id', $partyId)->where('user_id', $user)->delete();

        return response()->json(['message' => 'El usuario ha sido desbaneado de esa party'], 200);


    }
}
