<?php

namespace App\Http\Controllers;

use App\Models\Game;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class GameController extends Controller
{
    public function createGame(Request $request){
        $validator = Validator::make($request->all(), [
            'name' => 'required|string',
            'genre' => 'required|string',
        ]);
        if ($validator->fails()) {
            response()->json([
                'created' => false,
                'errors' => $validator->errors()->all()
            ], 400);
        }
        $game = Game::create([
            'name' => $request->name,
            'genre' => $request->genre
        ]);
        return response()->json(['message' => 'Successfully created game!'], 201);
    }
    public function getGames(Request $request)
    {
       $game = Game::all();
       return response()->json($game);
    }
    public function deleteGames(Request $request)
    {
        $id = $request->id;
        $game = Game::destroy($id);
        return response()->json(['message' => 'Successfully deleted game!'], 201);
    }
}
