<?php

namespace App\Http\Controllers\Api;

use App\Models\User;
use App\Models\Image;
use App\Mail\SicoMail;
use App\Models\Annonce;
use App\Models\Message;
use SicoHelpers\Helpers;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Mail;

class AnnonceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        visits(Annonce::class)->increment();
        $annonces=Annonce::orderBy('id','DESC')->get();
        foreach ($annonces as $key => $value) {
           $value->annonceur=$value->User;
           $value->images=$value->Images;
           $value->prix=number_format($value->loyer, 0, ',', ' ');
        }
        
        
        return response($annonces);
    }

    public function details(Request $req){
        $annonce=Annonce::find($req->id);
        visits($annonce)->increment();
        if($annonce!=null){
            $annonce->annonceur=$annonce->user;
            $annonce->images=$annonce->images;
            $annonce->prix=number_format($annonce->loyer, 0, ',', ' ');
            $annonceSimilaire=Annonce::where('typeConstruction',$annonce->typeConstruction)->get();
            $annonceSimilaire2=Annonce::where('typeConstruction',$annonce->ville)->get();
            foreach ($annonceSimilaire as $key => $value) {
                $value->user=$value->user;
                $value->images=$value->images;
                $value->prix=number_format($value->loyer, 0, ',', ' ');
            }
            foreach ($annonceSimilaire2 as $key => $value) {
                $value->user=$value->user;
                $value->images=$value->images;
                $value->prix=number_format($value->loyer, 0, ',', ' ');
            }
            foreach ($annonceSimilaire2 as $key => $value) {
                $value->user=$value->user;
                $value->images=$value->images;
                $value->prix=number_format($value->loyer, 0, ',', ' ');
            }
            
            return response(['status'=>200,"annonce"=>$annonce,"similaires"=>$annonceSimilaire,"similaire2"=>$annonceSimilaire2]);
        }else{
            return response(['status'=>400]);
        }
    }

    public function message(Request $req){
        $message=new Message();
        $message->sender=$req->email;
        $message->content=$req->message;
        $message->token=Str::random(12);
        $annonce=Annonce::find($req->annonce);
        $user=$annonce->User;
        $annonce->image=$annonce->Images[0];
        $annonce->Messages()->save($message);
        $data["message"]=$message;
        $data["annonce"]=$annonce;
        $data["user"]=$user;
        Mail::to($user->email)->send(new SicoMail($data));
       Helpers::Whatsap("Message d'un client %0A
       Adresse du client: ".$message->sender."%0A
       Message: ".$message->content."%0A
       annonceur".$user->telephone."%0A
       *******************************%0A
       Annonce concernée%0A".$annonce->typeAnnonce."%0A

       ".$annonce->description."%0ACette annonnce est accessible au %0Aimmo229.com/Details/".$annonce->id);
        
        return response(["status"=>200,"message"=>"Votre message a été envoyé avec succès"]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $req)
    {
       $converter=[
        "Je mets en location"=>"Location",
        "Je mets en vente"=>"Vente",
        "Je recherche"=>"Rechercher"
       ];
       switch ($req->typeAnnonce) {
        case 'Je mets en location':
           $req->typeAnnonce="Location";
            break;
        case "Je mets en vente":
            $req->typeAnnonce="Vente";
            break;
        case "Je recherche":
            $req->typeAnnonce="Recherche";
            break;
        default:
           
            break;
       }
      
        $user=User::where("token",$req->user)->first();
        if(!$user){
            return response(["status"=>100,"message"=>"Veuillez vous reconnecter"]);
        }

        $annonce=new Annonce();
        $annonce->numeroAnnonce=Str::substr($req->typeAnnonce,0,2)."-".Helpers::tokener("numbers",4);
        $annonce->typeAnnonce=$req->typeAnnonce;
        $annonce->typeConstruction=$req->typeConstruction;
        $annonce->quartier=$req->quartier;
        $annonce->ville=$req->ville;
        $annonce->loyer=$req->loyer;
        $annonce->prix=$req->prix;
        $annonce->description=$req->description;
        $annonce->nbPieces=$req->description;
        $annonce->description=$req->description;
        $annonce->status=1;
        $annonce->datePublication=date('d-m H:i');
        $annonce->likes=0;
        $annonce->token=Helpers::tokener();
        $user->Annonces()->save($annonce);
        
        if($req->files){
            $files=$req->file("Image");
            foreach ($files as $key => $value) {
                $image=new Image();
                $ext=$value->getClientOriginalExtension();               
                $image->url=$value->move(public_path("storage/Images/".$user->email),Str::substr($annonce->token,0,5)."._".$key.".".$ext);
                $annonce->Images()->save($image);
                
            }
        }
        Helpers::Whatsap('Une nouvelle annonce publiée %0A'.$annonce->description." %0Ahttps://immo229.com/Activator/".$annonce->token);
        Helpers::Mailer($user->email,$req->nom,"Votre Annonce a été enregistrée",["annonce"=>$annonce,"user"=>$user],"AnnonceEnregistre");
        return response([
            "status"=>200,
            "message"=>"Votre annonce a été enregistrée avec succès"
        ]);
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
     * @param  \App\Models\Annonce  $annonce
     * @return \Illuminate\Http\Response
     */
    public function show(Annonce $annonce)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Annonce  $annonce
     * @return \Illuminate\Http\Response
     */
    public function edit(Annonce $annonce)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Annonce  $annonce
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Annonce $annonce)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Annonce  $annonce
     * @return \Illuminate\Http\Response
     */
    public function destroy(Annonce $annonce)
    {
        //
    }
}
