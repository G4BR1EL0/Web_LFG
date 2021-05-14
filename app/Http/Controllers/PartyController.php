<?php

namespace App\Http\Controllers;

use App\Models\Game;
use App\Models\Party;
use App\Models\PartyUser;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class PartyController extends Controller
{
    public function getParties(){
        $parties = DB::table('parties')
            ->join('games', 'parties.game_id', '=', 'games.id')
            ->select('parties.id', 'parties.name', 'games.name AS game', 'parties.created_at')
            ->get();
        return response()->json($parties);
    }

    public function getGameParties(Request $request){
        $parties = DB::table('parties')
            ->join('games', 'parties.game_id', '=', 'games.id')
            ->select('parties.id', 'parties.name', 'games.name AS game', 'parties.created_at')
            ->where('game_id', '=', $request->game_id)
            ->get();
        return response()->json($parties);
    }

    public function create(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'game_id' => ['required', 'integer'],
            'name' => ['required', 'unique:parties']
        ]);

        if($validator->fails()){
            return response()->json(['error' => [
                'created' => false,
                'message' => $validator->errors()->all()]], 400);
        }
        $game_id = $request->get('game_id');
        $game=Game::find($game_id);
        if($game){
            Party::create(['game_id' => $game_id, 'name' => $request->name]);
            return response()->json(['message' => 'Party creada'], 200);
        }
        return response()->json(['message' => 'No existe ningun juego de id '.$game_id], 404);       
    }

    public function delete(Request $request)
    {
        $data = $request->user();
        if($data->role == 'admin')
        {
            $validator = Validator::make($request->all(), [
                'party_id' => ['required', 'integer']
            ]);
            if($validator->fails()){
                return response()->json(['error' => [
                    'created' => false,
                    'message' => $validator->errors()->all()]], 400);
            }
            $party_id = $request->get('party_id');
            $status = PartyUser::where('party_id', $party_id)->delete();
            if(!$status) return response()->json(['message' => 'No existe esa party']);
            Party::destroy(['id' => $party_id]);
            return response()->json(['message' => 'Party eliminada'], 200);
        }
        else
        {
            return response()->json(['message' => 'No eres administrador'], 401);
        }
    }
}
