<?php

namespace App\Http\Controllers;

use App\Models\PartyUser;
use Illuminate\Http\Request;

class PartyUsersController extends Controller
{
    public function create(Request $request)
    {
        $user = $request->user()->id;
        $partyId = $request->party_id;

        $find = PartyUser::where('user_id', $user)->get();

        foreach ($find as $key){
            if ($key->party_id == $partyId) {
                return response()->json(['message' => 'Ya estas en esta party'], 400);
            }
        }

        PartyUser::create(
            [
                'party_id' => $partyId,
                'user_id' => $user
            ]
        );

        return response()->json(['message' => 'Te has unido a la party'], 200);
    }

    public function deleteUser(Request $request)
    {
        $user = $request->user()->id;
        $partyId = $request->party_id;

        $find = PartyUser::where('user_id', '=' ,$user, 'and')->where('party_id', '=' ,$partyId)->first();

        if(!$find)
        {
            return response()->json(['message' => 'No puedes irte de una party en la que no estas'], 404);
        }

        PartyUser::destroy(
            [
                'id' => $find->id
            ]
        );

        return response()->json(['message' => 'Ya no perteneces a esta party'], 200);
    }
}
