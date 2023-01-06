@extends('Mails.html.template')
@section('contenu')
    <p
        style="Margin:0;-webkit-text-size-adjust:none;-ms-text-size-adjust:none;mso-line-height-rule:exactly;font-family:roboto, 'helvetica neue', helvetica, arial, sans-serif;line-height:27px;color:#fef0f0;font-size:18px">
        {{ $user->nom . ' ' . $user->prenom . ',' }}
    </p>
    <p
        style="Margin:0;-webkit-text-size-adjust:none;-ms-text-size-adjust:none;mso-line-height-rule:exactly;font-family:roboto, 'helvetica neue', helvetica, arial, sans-serif;line-height:27px;color:#fef0f0;font-size:18px">
        {{ 'Votre annonce a été enregistrée avec succès et sera validée puis mise en ligne dans les minutes à venir si elle est conforme à notre charte de fonctionnement.' }}
    </p>
    <p
        style="Margin:0;-webkit-text-size-adjust:none;-ms-text-size-adjust:none;mso-line-height-rule:exactly;font-family:roboto, 'helvetica neue', helvetica, arial, sans-serif;line-height:27px;color:#fef0f0;font-size:18px">
        {{ '******************************************************************' }}
    </p>
    <p
        style="Margin:0;-webkit-text-size-adjust:none;-ms-text-size-adjust:none;mso-line-height-rule:exactly;font-family:roboto, 'helvetica neue', helvetica, arial, sans-serif;line-height:27px;color:#fef0f0;font-size:18px">
        {{ 'Rappel de votre annonce:' }}
    </p>
    <p
        style="Margin:0;-webkit-text-size-adjust:none;-ms-text-size-adjust:none;mso-line-height-rule:exactly;font-family:roboto, 'helvetica neue', helvetica, arial, sans-serif;line-height:27px;color:#fef0f0;font-size:18px">
        {{ "Type d'annonce: " }}<strong>{{ $annonce->typeAnnonce }}</strong>
    </p>
    <p
        style="Margin:0;-webkit-text-size-adjust:none;-ms-text-size-adjust:none;mso-line-height-rule:exactly;font-family:roboto, 'helvetica neue', helvetica, arial, sans-serif;line-height:27px;color:#fef0f0;font-size:18px">
        {{ 'Type Construction: ' }}<strong>{{ $annonce->typeConstruction }}</strong>
    </p>
    <p
        style="Margin:0;-webkit-text-size-adjust:none;-ms-text-size-adjust:none;mso-line-height-rule:exactly;font-family:roboto, 'helvetica neue', helvetica, arial, sans-serif;line-height:27px;color:#fef0f0;font-size:18px">
        {{ 'Quartier: ' }}<strong>{{ $annonce->quartier }}</strong>
    </p>
    <p
        style="Margin:0;-webkit-text-size-adjust:none;-ms-text-size-adjust:none;mso-line-height-rule:exactly;font-family:roboto, 'helvetica neue', helvetica, arial, sans-serif;line-height:27px;color:#fef0f0;font-size:18px">
        {{ 'Ville: ' }}<strong>{{ $annonce->ville }}</strong>
    </p>
    <p
        style="Margin:0;-webkit-text-size-adjust:none;-ms-text-size-adjust:none;mso-line-height-rule:exactly;font-family:roboto, 'helvetica neue', helvetica, arial, sans-serif;line-height:27px;color:#fef0f0;font-size:18px">
        {{ 'Loyer: ' }}<strong>{{ $annonce->loyer . $annonce->prix }}</strong>
    </p>
    <p
        style="Margin:0;-webkit-text-size-adjust:none;-ms-text-size-adjust:none;mso-line-height-rule:exactly;font-family:roboto, 'helvetica neue', helvetica, arial, sans-serif;line-height:27px;color:#fef0f0;font-size:18px">
        {{ 'Description: ' }}<strong>{{ $annonce->description }}</strong>
    </p>
@endsection
