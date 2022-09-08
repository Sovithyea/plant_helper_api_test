<?php

namespace App\Http\Controllers\Auth;

use Carbon\Carbon;
use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\LoginRequest;
use App\Http\Controllers\Controller;
use App\Http\Requests\ForgetRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Mail;
use Laravel\Passport\TokenRepository;
use App\Http\Requests\RegisterRequest;
use App\Http\Requests\UpdateAuthRequest;
use App\Http\Requests\RefreshTokenRequest;
use Laravel\Passport\RefreshTokenRepository;

class AuthController extends Controller
{
    public function storeLogin(LoginRequest $request)
    {

        $response = Http::asForm()->post(env('APP_URL') . '/oauth/token', [
            'grant_type' => 'password',
            'client_id' => env('CLIENT_ID'),
            'client_secret' => env('CLIENT_SECRET'),
            'username' => $request->email,
            'password' => $request->password,
            'scope' => '',
        ]);
        $data = $response->json();
        return response()->json($data, $response->getStatusCode());
        
    }

    public function refresh(RefreshTokenRequest $request)
    {
        $response = Http::asForm()->post(env('APP_URL') . '/oauth/token', [
            'grant_type' => 'refresh_token',
            'client_id' => env('CLIENT_ID'),
            'client_secret' => env('CLIENT_SECRET'),
            'refresh_token' => $request->refresh_token,
            'scope' => '',
        ]);
        
        $data = $response->json();

        return response()->json($data, $response->getStatusCode());
    }

    public function storeRegister(RegisterRequest $request)
    {
        if($request->all())
        {
            User::create([
                'first_name' => $request->first_name,
                'last_name' => $request->last_name,
                'username' => $request->name,
                'phone_number' => $request->phone_number,
                'email' => $request->email,
                'password' => Hash::make($request->password),
            ]);
            
           
            
            return response()->json([
                'message' => 'You have successfully registered account, please check your email to verify it.',
            
            ]);
        }
    }
    // $request->user()->token()->revoke();
    public function logout(Request $request) 
    {
        
        $tokenRepository = app(TokenRepository::class);
        $refreshTokenRepository = app(RefreshTokenRepository::class);
        
        // Revoke an access token...
        $tokenRepository->revokeAccessToken($request->access_token);
        
        // Revoke all of the token's refresh tokens...
        $refreshTokenRepository->revokeRefreshTokensByAccessTokenId($request->access_token);
        
        // dd($request->all());

        return response()->json([
            "message" => "Successfully logout user!"
        ]);
    }

    public function storeForget(ForgetRequest $request)
    {
        $token = Str::random(64);
  
        DB::table('password_resets')->insert([
            'email' => $request->email, 
            'token' => $token, 
            'created_at' => Carbon::now()
        ]);
            
        Mail::send('email.forgetPassword', compact('token'), function($message) use($request){
            $message->to($request->email);
            $message->subject('Reset Password');
        });
  
        return response()->json([
            'message' => 'We have e-mailed your password reset link!'
        ]);
    }

    public function storeReset(Request $request)
    {
        $updatePassword = DB::table('password_resets')->where([
                               'email' => $request->email, 
                               'token' => $request->token
                             ])->first();
 
        if(!$updatePassword){
            return response()->json([
                'message', 'Invalid token!'
            ]);
        }
 
        User::where('email', $request->email)->update(['password' => Hash::make($request->password)]);

        DB::table('password_resets')->where(['email'=> $request->email])->delete();
 
        return response()->json([
            'message' => 'successfully change password!'
        ]);
    }
    
    public function getUser()
    {
        return response()->json([
            Auth::user()
        ]);
    }

    public function update(UpdateAuthRequest $request)
    {
        $user = Auth::user();
        
            $user->first_name = $request->first_name;
            $user->last_name = $request->last_name;
            $user->username = $request->username;
            $user->gender = $request->gender;
            $user->phone_number = $request->phone_number;
            $user->avatar = $request->image;
            $user->role = $request->role;
            $user->email = $request->email;

        $user->save();

        return response()->json([
            'message' => 'Update account succesfully'
        ], 200); 
    }
}
