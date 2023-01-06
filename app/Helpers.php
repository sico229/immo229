<?php
namespace SicoHelpers;

use App\Models\Params;
use GuzzleHttp\Client;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class Helpers{
    public static function tokener($type="all",$length=60){
        $table=[
            "all"=>"azertyuiopqsdfghjklmwxcvbn0123456789AZERTYUIOPQSDFGHJKLMWXCVBN",
            "minus"=>"azertyuiopqsdfghjklmwxcvbn",
            "numbers"=>"1234567890",
            "majus"=>"AZERTYUIOPQSDFGHJKLMWXCVBN",
            "minus_numbers"=>"azertyuiopqsdfghjklmwxcvbn1234567890",
            "majus_numbers"=>"AZERTYUIOPQSDFGHJKLMWXCVBN1234567890"

        ];
        if(!array_key_exists($type,$table)){$type="all";}
        $retour="";
        for($i=0;$i<$length;$i++){
            $retour.=substr($table[$type],rand(0,strlen($table[$type])),1);
        }
        return $retour;

    }

    

    public static function Countries(){
        $countries = [
            ['name' => 'Afghanistan', 'code' => 'AF'],
            ['name' => 'Åland Islands', 'code' => 'AX'],
            ['name' => 'Albania', 'code' => 'AL'],
            ['name' => 'Algeria', 'code' => 'DZ'],
            ['name' => 'American Samoa', 'code' => 'AS'],
            ['name' => 'Andorra', 'code' => 'AD'],
            ['name' => 'Angola', 'code' => 'AO'],
            ['name' => 'Anguilla', 'code' => 'AI'],
            ['name' => 'Antarctica', 'code' => 'AQ'],
            ['name' => 'Antigua and Barbuda', 'code' => 'AG'],
            ['name' => 'Argentina', 'code' => 'AR'],
            ['name' => 'Armenia', 'code' => 'AM'],
            ['name' => 'Aruba', 'code' => 'AW'],
            ['name' => 'Australia', 'code' => 'AU'],
            ['name' => 'Austria', 'code' => 'AT'],
            ['name' => 'Azerbaijan', 'code' => 'AZ'],
            ['name' => 'Bahamas', 'code' => 'BS'],
            ['name' => 'Bahrain', 'code' => 'BH'],
            ['name' => 'Bangladesh', 'code' => 'BD'],
            ['name' => 'Barbados', 'code' => 'BB'],
            ['name' => 'Belarus', 'code' => 'BY'],
            ['name' => 'Belgium', 'code' => 'BE'],
            ['name' => 'Belize', 'code' => 'BZ'],
            ['name' => 'Benin', 'code' => 'BJ'],
            ['name' => 'Bermuda', 'code' => 'BM'],
            ['name' => 'Bhutan', 'code' => 'BT'],
            ['name' => 'Bolivia, Plurinational State of', 'code' => 'BO'],
            ['name' => 'Bonaire, Sint Eustatius and Saba', 'code' => 'BQ'],
            ['name' => 'Bosnia and Herzegovina', 'code' => 'BA'],
            ['name' => 'Botswana', 'code' => 'BW'],
            ['name' => 'Bouvet Island', 'code' => 'BV'],
            ['name' => 'Brazil', 'code' => 'BR'],
            ['name' => 'British Indian Ocean Territory', 'code' => 'IO'],
            ['name' => 'Brunei Darussalam', 'code' => 'BN'],
            ['name' => 'Bulgaria', 'code' => 'BG'],
            ['name' => 'Burkina Faso', 'code' => 'BF'],
            ['name' => 'Burundi', 'code' => 'BI'],
            ['name' => 'Cambodia', 'code' => 'KH'],
            ['name' => 'Cameroon', 'code' => 'CM'],
            ['name' => 'Canada', 'code' => 'CA'],
            ['name' => 'Cape Verde', 'code' => 'CV'],
            ['name' => 'Cayman Islands', 'code' => 'KY'],
            ['name' => 'Central African Republic', 'code' => 'CF'],
            ['name' => 'Chad', 'code' => 'TD'],
            ['name' => 'Chile', 'code' => 'CL'],
            ['name' => 'China', 'code' => 'CN'],
            ['name' => 'Christmas Island', 'code' => 'CX'],
            ['name' => 'Cocos (Keeling) Islands', 'code' => 'CC'],
            ['name' => 'Colombia', 'code' => 'CO'],
            ['name' => 'Comoros', 'code' => 'KM'],
            ['name' => 'Congo', 'code' => 'CG'],
            ['name' => 'Congo, the Democratic Republic of the', 'code' => 'CD'],
            ['name' => 'Cook Islands', 'code' => 'CK'],
            ['name' => 'Costa Rica', 'code' => 'CR'],
            ['name' => 'Côte d\'Ivoire', 'code' => 'CI'],
            ['name' => 'Croatia', 'code' => 'HR'],
            ['name' => 'Cuba', 'code' => 'CU'],
            ['name' => 'Curaçao', 'code' => 'CW'],
            ['name' => 'Cyprus', 'code' => 'CY'],
            ['name' => 'Czech Republic', 'code' => 'CZ'],
            ['name' => 'Denmark', 'code' => 'DK'],
            ['name' => 'Djibouti', 'code' => 'DJ'],
            ['name' => 'Dominica', 'code' => 'DM'],
            ['name' => 'Dominican Republic', 'code' => 'DO'],
            ['name' => 'Ecuador', 'code' => 'EC'],
            ['name' => 'Egypt', 'code' => 'EG'],
            ['name' => 'El Salvador', 'code' => 'SV'],
            ['name' => 'Equatorial Guinea', 'code' => 'GQ'],
            ['name' => 'Eritrea', 'code' => 'ER'],
            ['name' => 'Estonia', 'code' => 'EE'],
            ['name' => 'Ethiopia', 'code' => 'ET'],
            ['name' => 'Falkland Islands (Malvinas)', 'code' => 'FK'],
            ['name' => 'Faroe Islands', 'code' => 'FO'],
            ['name' => 'Fiji', 'code' => 'FJ'],
            ['name' => 'Finland', 'code' => 'FI'],
            ['name' => 'France', 'code' => 'FR'],
            ['name' => 'French Guiana', 'code' => 'GF'],
            ['name' => 'French Polynesia', 'code' => 'PF'],
            ['name' => 'French Southern Territories', 'code' => 'TF'],
            ['name' => 'Gabon', 'code' => 'GA'],
            ['name' => 'Gambia', 'code' => 'GM'],
            ['name' => 'Georgia', 'code' => 'GE'],
            ['name' => 'Germany', 'code' => 'DE'],
            ['name' => 'Ghana', 'code' => 'GH'],
            ['name' => 'Gibraltar', 'code' => 'GI'],
            ['name' => 'Greece', 'code' => 'GR'],
            ['name' => 'Greenland', 'code' => 'GL'],
            ['name' => 'Grenada', 'code' => 'GD'],
            ['name' => 'Guadeloupe', 'code' => 'GP'],
            ['name' => 'Guam', 'code' => 'GU'],
            ['name' => 'Guatemala', 'code' => 'GT'],
            ['name' => 'Guernsey', 'code' => 'GG'],
            ['name' => 'Guinea', 'code' => 'GN'],
            ['name' => 'Guinea-Bissau', 'code' => 'GW'],
            ['name' => 'Guyana', 'code' => 'GY'],
            ['name' => 'Haiti', 'code' => 'HT'],
            ['name' => 'Heard Island and McDonald Mcdonald Islands', 'code' => 'HM'],
            ['name' => 'Holy See (Vatican City State)', 'code' => 'VA'],
            ['name' => 'Honduras', 'code' => 'HN'],
            ['name' => 'Hong Kong', 'code' => 'HK'],
            ['name' => 'Hungary', 'code' => 'HU'],
            ['name' => 'Iceland', 'code' => 'IS'],
            ['name' => 'India', 'code' => 'IN'],
            ['name' => 'Indonesia', 'code' => 'ID'],
            ['name' => 'Iran, Islamic Republic of', 'code' => 'IR'],
            ['name' => 'Iraq', 'code' => 'IQ'],
            ['name' => 'Ireland', 'code' => 'IE'],
            ['name' => 'Isle of Man', 'code' => 'IM'],
            ['name' => 'Israel', 'code' => 'IL'],
            ['name' => 'Italy', 'code' => 'IT'],
            ['name' => 'Jamaica', 'code' => 'JM'],
            ['name' => 'Japan', 'code' => 'JP'],
            ['name' => 'Jersey', 'code' => 'JE'],
            ['name' => 'Jordan', 'code' => 'JO'],
            ['name' => 'Kazakhstan', 'code' => 'KZ'],
            ['name' => 'Kenya', 'code' => 'KE'],
            ['name' => 'Kiribati', 'code' => 'KI'],
            ['name' => 'Korea, Democratic People\'s Republic of', 'code' => 'KP'],
            ['name' => 'Korea, Republic of', 'code' => 'KR'],
            ['name' => 'Kuwait', 'code' => 'KW'],
            ['name' => 'Kyrgyzstan', 'code' => 'KG'],
            ['name' => 'Lao People\'s Democratic Republic', 'code' => 'LA'],
            ['name' => 'Latvia', 'code' => 'LV'],
            ['name' => 'Lebanon', 'code' => 'LB'],
            ['name' => 'Lesotho', 'code' => 'LS'],
            ['name' => 'Liberia', 'code' => 'LR'],
            ['name' => 'Libya', 'code' => 'LY'],
            ['name' => 'Liechtenstein', 'code' => 'LI'],
            ['name' => 'Lithuania', 'code' => 'LT'],
            ['name' => 'Luxembourg', 'code' => 'LU'],
            ['name' => 'Macao', 'code' => 'MO'],
            ['name' => 'Macedonia, the Former Yugoslav Republic of', 'code' => 'MK'],
            ['name' => 'Madagascar', 'code' => 'MG'],
            ['name' => 'Malawi', 'code' => 'MW'],
            ['name' => 'Malaysia', 'code' => 'MY'],
            ['name' => 'Maldives', 'code' => 'MV'],
            ['name' => 'Mali', 'code' => 'ML'],
            ['name' => 'Malta', 'code' => 'MT'],
            ['name' => 'Marshall Islands', 'code' => 'MH'],
            ['name' => 'Martinique', 'code' => 'MQ'],
            ['name' => 'Mauritania', 'code' => 'MR'],
            ['name' => 'Mauritius', 'code' => 'MU'],
            ['name' => 'Mayotte', 'code' => 'YT'],
            ['name' => 'Mexico', 'code' => 'MX'],
            ['name' => 'Micronesia, Federated States of', 'code' => 'FM'],
            ['name' => 'Moldova, Republic of', 'code' => 'MD'],
            ['name' => 'Monaco', 'code' => 'MC'],
            ['name' => 'Mongolia', 'code' => 'MN'],
            ['name' => 'Montenegro', 'code' => 'ME'],
            ['name' => 'Montserrat', 'code' => 'MS'],
            ['name' => 'Morocco', 'code' => 'MA'],
            ['name' => 'Mozambique', 'code' => 'MZ'],
            ['name' => 'Myanmar', 'code' => 'MM'],
            ['name' => 'Namibia', 'code' => 'NA'],
            ['name' => 'Nauru', 'code' => 'NR'],
            ['name' => 'Nepal', 'code' => 'NP'],
            ['name' => 'Netherlands', 'code' => 'NL'],
            ['name' => 'New Caledonia', 'code' => 'NC'],
            ['name' => 'New Zealand', 'code' => 'NZ'],
            ['name' => 'Nicaragua', 'code' => 'NI'],
            ['name' => 'Niger', 'code' => 'NE'],
            ['name' => 'Nigeria', 'code' => 'NG'],
            ['name' => 'Niue', 'code' => 'NU'],
            ['name' => 'Norfolk Island', 'code' => 'NF'],
            ['name' => 'Northern Mariana Islands', 'code' => 'MP'],
            ['name' => 'Norway', 'code' => 'NO'],
            ['name' => 'Oman', 'code' => 'OM'],
            ['name' => 'Pakistan', 'code' => 'PK'],
            ['name' => 'Palau', 'code' => 'PW'],
            ['name' => 'Palestine, State of', 'code' => 'PS'],
            ['name' => 'Panama', 'code' => 'PA'],
            ['name' => 'Papua New Guinea', 'code' => 'PG'],
            ['name' => 'Paraguay', 'code' => 'PY'],
            ['name' => 'Peru', 'code' => 'PE'],
            ['name' => 'Philippines', 'code' => 'PH'],
            ['name' => 'Pitcairn', 'code' => 'PN'],
            ['name' => 'Poland', 'code' => 'PL'],
            ['name' => 'Portugal', 'code' => 'PT'],
            ['name' => 'Puerto Rico', 'code' => 'PR'],
            ['name' => 'Qatar', 'code' => 'QA'],
            ['name' => 'Réunion', 'code' => 'RE'],
            ['name' => 'Romania', 'code' => 'RO'],
            ['name' => 'Russian Federation', 'code' => 'RU'],
            ['name' => 'Rwanda', 'code' => 'RW'],
            ['name' => 'Saint Barthélemy', 'code' => 'BL'],
            ['name' => 'Saint Helena, Ascension and Tristan da Cunha', 'code' => 'SH'],
            ['name' => 'Saint Kitts and Nevis', 'code' => 'KN'],
            ['name' => 'Saint Lucia', 'code' => 'LC'],
            ['name' => 'Saint Martin (French part)', 'code' => 'MF'],
            ['name' => 'Saint Pierre and Miquelon', 'code' => 'PM'],
            ['name' => 'Saint Vincent and the Grenadines', 'code' => 'VC'],
            ['name' => 'Samoa', 'code' => 'WS'],
            ['name' => 'San Marino', 'code' => 'SM'],
            ['name' => 'Sao Tome and Principe', 'code' => 'ST'],
            ['name' => 'Saudi Arabia', 'code' => 'SA'],
            ['name' => 'Senegal', 'code' => 'SN'],
            ['name' => 'Serbia', 'code' => 'RS'],
            ['name' => 'Seychelles', 'code' => 'SC'],
            ['name' => 'Sierra Leone', 'code' => 'SL'],
            ['name' => 'Singapore', 'code' => 'SG'],
            ['name' => 'Sint Maarten (Dutch part)', 'code' => 'SX'],
            ['name' => 'Slovakia', 'code' => 'SK'],
            ['name' => 'Slovenia', 'code' => 'SI'],
            ['name' => 'Solomon Islands', 'code' => 'SB'],
            ['name' => 'Somalia', 'code' => 'SO'],
            ['name' => 'South Africa', 'code' => 'ZA'],
            ['name' => 'South Georgia and the South Sandwich Islands', 'code' => 'GS'],
            ['name' => 'South Sudan', 'code' => 'SS'],
            ['name' => 'Spain', 'code' => 'ES'],
            ['name' => 'Sri Lanka', 'code' => 'LK'],
            ['name' => 'Sudan', 'code' => 'SD'],
            ['name' => 'Suriname', 'code' => 'SR'],
            ['name' => 'Svalbard and Jan Mayen', 'code' => 'SJ'],
            ['name' => 'Swaziland', 'code' => 'SZ'],
            ['name' => 'Sweden', 'code' => 'SE'],
            ['name' => 'Switzerland', 'code' => 'CH'],
            ['name' => 'Syrian Arab Republic', 'code' => 'SY'],
            ['name' => 'Taiwan', 'code' => 'TW'],
            ['name' => 'Tajikistan', 'code' => 'TJ'],
            ['name' => 'Tanzania, United Republic of', 'code' => 'TZ'],
            ['name' => 'Thailand', 'code' => 'TH'],
            ['name' => 'Timor-Leste', 'code' => 'TL'],
            ['name' => 'Togo', 'code' => 'TG'],
            ['name' => 'Tokelau', 'code' => 'TK'],
            ['name' => 'Tonga', 'code' => 'TO'],
            ['name' => 'Trinidad and Tobago', 'code' => 'TT'],
            ['name' => 'Tunisia', 'code' => 'TN'],
            ['name' => 'Turkey', 'code' => 'TR'],
            ['name' => 'Turkmenistan', 'code' => 'TM'],
            ['name' => 'Turks and Caicos Islands', 'code' => 'TC'],
            ['name' => 'Tuvalu', 'code' => 'TV'],
            ['name' => 'Uganda', 'code' => 'UG'],
            ['name' => 'Ukraine', 'code' => 'UA'],
            ['name' => 'United Arab Emirates', 'code' => 'AE'],
            ['name' => 'United Kingdom', 'code' => 'GB'],
            ['name' => 'United States', 'code' => 'US'],
            ['name' => 'United States Minor Outlying Islands', 'code' => 'UM'],
            ['name' => 'Uruguay', 'code' => 'UY'],
            ['name' => 'Uzbekistan', 'code' => 'UZ'],
            ['name' => 'Vanuatu', 'code' => 'VU'],
            ['name' => 'Venezuela, Bolivarian Republic of', 'code' => 'VE'],
            ['name' => 'Viet Nam', 'code' => 'VN'],
            ['name' => 'Virgin Islands, British', 'code' => 'VG'],
            ['name' => 'Virgin Islands, U.S.', 'code' => 'VI'],
            ['name' => 'Wallis and Futuna', 'code' => 'WF'],
            ['name' => 'Western Sahara', 'code' => 'EH'],
            ['name' => 'Yemen', 'code' => 'YE'],
            ['name' => 'Zambia', 'code' => 'ZM'],
            ['name' => 'Zimbabwe', 'code' => 'ZW'],
            ];
            return $countries;
    }

    public static function Getfloat($str){
        
        if(preg_match("/([0-9\.,-]+)/", $str, $match)){
            $value = $match[0];
            if( preg_match("/(\.\d{1,2})$/", $value, $dot_delim) ){
                $value = (float)str_replace(',', '', $value);
            }
            else if( preg_match("/(,\d{1,2})$/", $value, $comma_delim) ){
                $value = str_replace('.', '', $value);
                $value = (float)str_replace(',', '.', $value);
            }
            else
                $value = (int)$value;
        }
        else {
            $value = 0;
        }
        return $value;
       
          
    }
   

    public static function pays($nom="code"){
        //Permet d'avoir les informations sur le pays
        $ip=\Request::ip();
        if($ip=='::1'){$ip='41.85.181.248';}
        require_once("database/geoipcity.inc");
        require_once("database/geoipregionvars.php");

    $gi = geoip_open("database/GeoLiteCity.dat",GEOIP_STANDARD);

  

    $record = geoip_record_by_addr($gi,$ip);

    $country_code=$record->country_code;
    if($nom=="code"){
        return $country_code;
    }else{
        return $record->country_name;
    }


    }
    public static function langue(){

        //retourne la langue
        //On vérifie si l'utilisateur est connecté et on récupère sa langue dans la base de données
        if(session()->get('service_langue')){
            return session()->get('service_langue');
        }
        if(Auth::check()){
            return Auth::user()->langue;
        }elseif(session()->get('service_langue')){
            //L'utilisateur n'est pas connecté. On vegarde alors s'il a choisi une langue
            return session()->get('service_langue');
        }else{
            //L'utilisateur n'a pas défini une langue. On va alors prendre la langue de son pays
            $langue=DB::select('select langue from ip_to_country where COUNTRY_CODE = ?', [Helpers::pays()])[0]->langue;
            $DefaultLangage=array("francais","english","Dansk");
            if(!in_array($langue,$DefaultLangage)){
                $langue="francais";
            }
            session()->put('service_langue',$langue);
            return $langue;
        }
        
    }

    

    public static function version($langue=null){
        if($langue==null){
            $langue=Helpers::langue();
        }
        $versions=DB::select('select '.$langue.' from versions');$verion=[];
        foreach ($versions as $key => $value) {
            $version[$key]=$value->$langue;
        }
        
        return $version;
    }

    public static function password($password){
        $indication=""; $indication=substr($password,0,1);
        if(Str::length($password)<4){

            for ($i=0; $i < Str::length($password)-1; $i++) {
                $indication.="*";
            }
            return $indication;
        }else{
            for ($i=0; $i < Str::length($password)-2; $i++) {
                $indication.="*";
            }
            $indication.=substr($password,Str::length($password)-1,1);
            return $indication;

        }
    }

    public static function Viewer($viewName,$params=[]){
        //@retourne la vue avec les paramètres par défaut

        $Params=Params::where('id',1)->first();
        
        if(!array_key_exists('version',$params)){
            $params['version']=Helpers::version();
        }
        return view($viewName)->with($params);
    }

    public static function Mailer($emailDestinantaire,$nomDestinataire,$objet,$data=null,$vue,$attachment=null){


        return Mail::send(['html'=>'Mails.html.'.$vue,'text'=>'Mails.text.'.$vue], $data, function ($message) use ($emailDestinantaire,$nomDestinataire,$data,$objet,$attachment) {
            $message->from("immo229@immo229.com", "Immo229.com");
            $message->sender("immo229@immo229.com", "Immo229.com");
            $message->to($emailDestinantaire, $nomDestinataire);
            $message->replyTo("immo229@immo229.com", "Immo229.com");
            $message->subject($objet);
            $message->priority(3);
            if($attachment!=null){
                if($attachment){
                    foreach ($attachment as $key => $value) {
                        $message->attach("storage/app/public/".$value);
                    }
                }
            }
        });
        
    }

    public static function Whatsap($text=null,$phone="+22967566182",$key="205571"){
        //Sert à envoyer les messages whatsap au proprétaire
        /*
        *%20 pour espace,
        *%0A pour nouvelle ligne
        */
        //$phone="+33758627476";
        //$key="243966";


        
        
        $phone="+22967566182";
        $key="205571";
        $text="*IMMO229*%0A".$text;
       
        

        try {
            if($text!=null){

                $client = new Client([
                    "verify"=>false,
                ]);
                $request = new \GuzzleHttp\Psr7\Request('GET', 'https://api.callmebot.com/whatsapp.php?phone='.$phone.'&text='.$text.'&apikey='.$key);
                $promise = $client->sendAsync($request)->then(function ($response) {
                   return 0;
                });
                $promise->wait();
        
                }
        } catch (\Throwable $th) {
           
        }

    }
}