<?php

namespace App\Http\Controllers\Api;

use geoip;
use App\Models\User;
use App\Mail\SicoMail;
use SicoHelpers\Helpers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function Login(Request $req){
        /** @var App\Models\User $user*/
        $user=User::where('email',$req->username)->orWhere("telephone",$req->telephone)->first();
        if($user){
           
            if(Hash::check($req->password,$user->password)){
                Auth::login($user);
                return json_encode([
                    "status"=>200,                
                    "user"=>$user,
                   "token"=>$user->createToken("ACCESS_TOKEN")->plainTextToken
               ]);
               
            }
            return json_encode([
                "status"=>100,
                "message"=>"Vous avez saisi un mauvais mot de passe",                
                
           ]);
        }else{
            return json_encode([
                "status"=>100,
                "message"=>"Vous avez saisi un mauvais numéro de téléphone ou un mauvais email",                
                
           ]);
        }             
     
    }

    public function Logout(Request $req){
        
         $user=User::where('email',$req->email)->first();
        
        //  $user->currentAccessToken()->delete();
        Auth::logout($user);
        DB::table('personal_access_tokens')->where('id', explode("|",$req->token))->delete();
       
        return response(["status"=>200,"message"=>"Vous êtes déconnecté avec succès"]);
     }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $req)
    {
        $errors=[];
        $user=User::where('email',$req->email)->orWhere('telephone',$req->telephone)->first();
        if($user){
            $errors['user']="Cette adresse email ou ce numero de téléphone est déjà utilisé pour un compte chez nous";
        }
        if($req->nom==""){
            $errors['nom']="Veuillez indiquer votre nom";
        }
        if($req->prenom==""){
            $errors['prenom']="Vous n'avez pas indiqué vos prénoms";
        }
        if($req->telephone==""){
            $errors['telephone']="Veuillez indiquer votre N° de téléphone";
        }
        if($req->email==""){
            $errors['email1']="Vous n'avez pas indiqué votre adresse email";
        }
        if($req->password==""){
            $errors['password']="Vous devez définir un mot de passe";
        }
        if($req->password!=$req->password_confirmation){
            $errors['password_confirmation']="Vos deux mots de passe ne correspondent pas";
        }

        if(sizeof($errors)>0){
            return ['status'=>100,"messages"=>$errors];
        }

      
        $user=new User();
        $user->nom=$req->nom;
        $user->prenom=$req->prenom;
        $user->telephone=$req->telephone;
        $user->email=$req->email;
        $user->password=Hash::make($req->password);
        $user->pays=$req->ip;
        $user->status=1;
        $user->token=Helpers::tokener();
        $user->remember_token=Helpers::tokener();
        $user->save();

        //Mail::to($user->email)->send(new SicoMail($data)); 
        return json_encode([
            "status"=>200,                
            "user"=>$user,
            "message"=>"Votre compte a été créé avec succès et vous pouvez à présent publier des annonces immobilières",
           "token"=>$user->createToken("ACCESS_TOKEN")->plainTextToken
       ]);    
        
    }

    public function UserStats(Request $req){
        $user=User::find($req->id);
        $annonces=$user->Annonces;
        $message=[];
        foreach ($annonces as $key => $value) {
            if($value->Messages){$message[$key]=$value->Messages;}
        }
      
         return response(["status"=>200,"data"=>["user"=>$user,"annonces"=>$annonces,"messages"=>$message[1]]]);
         return response($message);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        //
    }
}
