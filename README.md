# trivia

Trivia spēle. 

Spēles uzstādījumi un API endpoint dati ir pieejami atsevišķos uzstādījumos (configs) tie nav hardkodēti.

Uzdevuma izpildei ir ievēroti SOLID principi. 
Biznesa loģika ir nodalīta atsevišķās servisu (service) klasēs un izmantoti interfeisi.
Kļūdu paziņojumi (error handling) tiek apstrādāti un logoti log failos.

Ņemot vēra ka uzdevuma aprakstā nav minēts nekas par datu bāžu lietošanu vai nelietošanu, tad visi spēles dati
tiek glabāti sesijās, taču, ņemot vērā ka tas var mainīties (Tāpat kā API) tad arī šī loģika tiek atdalīta atsevišķos
servisos, lai tos pēc vajadzības varētu mainīt.

Lai palaistu projektu (Setup instructions):

1. Jānoklonē repozitorijs
2. Jāizveido tukša DB
3. Jāpārsauc fails ".env.example" uz ".env"
4. Jāuzstāda DB konfigurācija ".env" failā (DB var palikt tukša)
5. Run "composer install" from project root
7. Run "php artisan key:generate" from project root
8. Run "php artisan serve" from project root

-- Iespējams var vajadzēt pielabot failu/direktoju atļaujas (permissions) uz Linux

API endpoint dati ir atrodami:
app/config/api.php

Spēles jautājumu skaits ir rediģējams:
app/config/game.php

Izmantotās tehnoloģijas:

### Back end:

1. Laravel 10 [Laravel Framework (https://laravel.com/)]
   
### Front end:

1. HTML5
2. CSS3
2. JavaScript:
  
### Paraugs:
 
### Sākuma skats:
![Index view](https://i.imgur.com/z0ynr2G.png "Index view")
### Game over:
![Game Over](https://i.imgur.com/mpHC7TX.png "Game Over")
### Final:
![Game Win](https://i.imgur.com/Eoksga3.png "Game Win")
