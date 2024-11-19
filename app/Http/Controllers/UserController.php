<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Exception;

class UserController extends Controller
{
   public static function createUser(Request $req)
   {
    try{
        $req->merge(['password' => Hash::make($req->password)]);
        $user = User::create($req->all());
        return response()->json([
            'message' => 'User created successfully',
            'user' => $user->only(['id', 'name', 'email', 'payment_status', 'pdf_text']),
        ], 201);
    }
    catch(Exception $e){
        return response()->json([
            'message' => $e->getMessage()
        ], 500);
    }

   }

   public static function loginUser(Request $req)
   {
     try {
        $user = User::where('email', $req->email)->first();
         // Check if the user exists and if the password matches
         if ($user && Hash::check($req->password, $user->password)) {
            // Authentication passed; return success response
            return response()->json([
                'message' => 'Login successful',
                'user' => $user->only(['id', 'name', 'email', 'payment_status', 'pdf_text']),
            ]);
        } else {
            // Authentication failed; return error
            return response()->json([
                'message' => 'Invalid credentials',
            ], 401);
        }
    }
    catch(Exception $e){
    // Catch any unexpected errors
    return response()->json([
        'message' =>  $e->getMessage()
        ], 500);
    }
   }

   public static function updatePaymentStatus(Request $req, $user_id)
   {
    try {
        $user = User::find($user_id);
        $user->payment_status = $req->payment_status;
        $user->save();
        return response()->json([
            'message' =>  "Payment Status Upadated"
            ], 200);
    }
    catch(Exception $e){
    // Catch any unexpected errors
    return response()->json([
        'message' =>  $e->getMessage()
        ], 500);
    }
   }

   public static function updatePDFText(Request $req, $user_id)
   {
    try {
        $user = User::find($user_id);
        $user->pdf_text = $req->pdf_text;
        $user->save();
        return response()->json([
            'message' =>  "PDF Upadated"
            ], 200);
    }
    catch(Exception $e){
    // Catch any unexpected errors
    return response()->json([
        'message' =>  $e->getMessage()
        ], 500);
    }
   }

   public static function getAllUsers()
   {
    try {
        $user = User::all();
        return response()->json(['users' => $user]);
    }
    catch(Exception $e){
        return response()->json([
            'message' =>  $e->getMessage()
            ], 500);
    }
   }
}
