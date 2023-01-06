{{ $user->nom . ' ' . $user->prenom . ',' }}
{{ 'Votre annonce a été enregistrée avec succès et sera validée puis mise en ligne dans les minutes à venir si elle est conforme à notre charte de fonctionnement.' }}
{{ '******************************************************************' }}
{{ 'Rappel de votre annonce:' }}
{{ "Type d'annonce: " }}{{ $annonce->typeAnnonce }}
{{ 'Type Construction: ' }}{{ $annonce->typeConstruction }}
{{ 'Quartier: ' }}{{ $annonce->quartier }}
{{ 'Ville: ' }}{{ $annonce->ville }}
{{ 'Loyer: ' }}{{ $annonce->loyer . $annonce->prix }}
{{ 'Description: ' }}{{ $annonce->description }}
