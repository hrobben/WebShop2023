# WebShop2023

# Installatie
- Ga op jouw pc in CLI (Command Line Interface, dosbox, powershell) naar jou directory: b.v.  "cd \xampp\htdocs" (prompt in dosbox word dan "C:\XAMPP\HTDOCS>")
- Voer uit het commando: "git clone (https://github.com/hrobben/WebShop2023.git)" (hierdoor krijg je in je htdocs een subdir "zorg")
- Ga naar de nieuwe directory "cd zorg" (je prompt word nu "C:\XAMPP\HTDOCS\ZORG")
- Gebuik nu composer om de installatie klaar te maken met "composer install"
- Met "yarn install" installeer je de WebEncore in de Symfony applicatie.
- "yarn encore dev-server" of "yarn watch" om de installatie te activeren en automatisch de wijzigingen lokaal door te voeren.
- "symfony serve" om de server te starten. (omdat het vorige commando blijft kijken naar de app.css en app.js in de "assets" directory) kan je beter een tweede CLI openen voor symfony serve.
- in een derde box kan je daarna nog de andere commandos uitvoeren.

# Enviroment ".env" bestand
In .env bestand kun je jouw instelling voor MySQL maken.

DATABASE_URL="mysql://henry:password@127.0.0.1:3306/zorg?serverVersion=8&charset=utf8mb4"
- Wijzig "henry:password" in eigen credentials (b.v "root:" bij XAMPP, omdat standaard geen wachtwoord nodig is in XAMPP)
- voer uit: - php bin/console doctrine:database:create
- voer uit: - php bin/console doctrine:schema:update --force --complete

# Werkwijze programmeren
- branch -> maak een branch aan per UserStory en noem deze zoals je de UserStory in Trello genoemd hebt.
- programmeer in deze branch jouw aanpassingen en nieuwe code
- commit/push om de code naar de locale (commit) en github (push) te sturen.
- Pull Request als je de code in de master branch wilt laten opnemen, PR (Pull Request) is een vraag en een check om de code die je gemaakt hebt te kunnen mengen met de "master" branch.
- Merge, als de code geen problemen opleverd en iedereen het eens is met de door jou gemaakte code.
- Als de master branch wijzigd word er een automatische verwerking gedaan naar de server (word dus meteen CI/CD doorgevoerd)

# Benodigdheden
De programmas die je nodig hebt zijn gratis (Open Source)
- composer https://getcomposer.org/download/
- git https://git-scm.com/download/win
- XAMPP (of op niet Windows MySQL server) https://www.apachefriends.org/download.html
- symfony https://github.com/symfony-cli/symfony-cli/releases/download/v5.5.1/symfony-cli_windows_amd64.zip (met de opdracht "symfony serve" activeer je de ingebouwde symfony apache server op poort 8000, dus in de browser met https://localhost:8000  op te roepen)
- nodejs https://nodejs.org/en/download/  is nodig om npm of yarn te kunnen gebruiken.
