# Monitora

1. Pokreni projekt sa ./vendor/bin/sail up

2. Ako App-Key iz nekog razloga nije dobar ili ga nema u .env datoteci, potrebno ga je kreirati sa 
    ./vendor/bin/sail artisan key:generate


Importanje podataka sa API-ja:

1. Potrebno je okinuti "./vendor/bin/sail artisan migrate" kako bi se odvrtile sve migracije. Ako zelite resetirati bazu najbolje odvrtiti "./vendor/bin/sail artisan migrate:refresh" komandu koja ce ponovno kreirati bazu i pripadajuce tablice bez podataka.

2. Za manualni update podataka postoje dvije opcije:
    -  ./vendor/bin/sail artisan app:update-posts-command (Dohvacanje svih postova. Od 2000. godine do danas)
    -  ./vendor/bin/sail artisan app:update-posts-command --yesterday (Dohvacanje postova od jucer)


3. Nakon sto je sve gotovo, potrebno je pokrenuti cronjob:
    - ./vendor/bin/sail artisan schedule:work

    Ova komanda ce pokrenuti laravelov scheduler koji onda pokrece sve komande koje se nalaze u Kernel.php datoteci. Trenutno je aktivna samo ova komanda: 
    
    $schedule->command('app:update-posts-command --yesterday')->daily();

    Ako zelite ukloniti "./vendor/bin/sail" i umjesto toga pisati samo "sail" : 
    - https://laravel.com/docs/10.x/sail#configuring-a-shell-alias :D
