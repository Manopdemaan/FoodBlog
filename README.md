# Let's Play Tag!

Dit project is een eenvoudig blogplatform waarbij gebruikers berichten kunnen bekijken, taggen en leuk vinden. Het maakt gebruik van PHP en een MySQL-database om gegevens op te slaan en weer te geven. Dit document beschrijft de installatie en werking van het project.

## Inhoud

- [Beschrijving](#beschrijving)
- [Installatie](#installatie)
- [Gebruik](#gebruik)
- [Database](#database)
- [Bestanden](#bestanden)

## Beschrijving

Het "Let's Play Tag!" project is een foodblog waar gebruikers posts kunnen bekijken en leuk vinden. Berichten worden weergegeven met hun afbeeldingen, inhoud, en tags. Gebruikers kunnen ook nieuwe posts toevoegen via een formulier. Tags worden gebruikt om berichten te categoriseren en gemakkelijk op te zoeken.

## Installatie

1. **Download het project**:
   - Clone het project naar je lokale machine met behulp van de volgende Git-commando:
     ```bash
     git clone https://github.com/jouwgebruikersnaam/je-repository.git
     ```

2. **Configureer de database**:
   - Zorg ervoor dat je een MySQL-database hebt met de naam `foodblog`.
   - Bewerk het bestand `connection.php` om de juiste databasegegevens in te vullen:
     ```php
     $host = 'localhost';
     $username = 'root';
     $password = '';
     $dbname = 'foodblog';
     $dsn = 'mysql:host=' . $host . ';dbname=' . $dbname;
     ```

3. **Importeer de database**:
   - Gebruik het bestand `import.sql` om de database te vullen met de benodigde tabellen en gegevens. Dit kan via een MySQL client zoals phpMyAdmin of de command-line interface.

## Gebruik

1. **Start je webserver**:
   - Zorg ervoor dat je een webserver zoals Apache of Nginx hebt draaien met PHP-ondersteuning.

2. **Open het project in je browser**:
   - Ga naar `http://localhost/je-project-map/index.php` om de hoofdpagina van het blog te bekijken.

3. **Voeg een nieuwe post toe**:
   - Ga naar `new_post.php` en vul het formulier in om een nieuwe post toe te voegen met titel, afbeelding, inhoud en tags.

4. **Bekijk en tag posts**:
   - Op de hoofdpagina worden alle posts weergegeven. Je kunt ook berichten taggen en zien hoeveel likes ze hebben ontvangen.

## Bestanden

- `index.php`: De hoofdpagina waar berichten worden weergegeven en geliket kunnen worden.

- `new_post.php`: Een formulier voor het toevoegen van nieuwe berichten.

- `lookup.php`: Een pagina voor het zoeken naar berichten op basis van tags.

- `connection.php`: Bevat de databaseverbindinginstellingen.
- 
- `style.css`: De CSS-stijlen voor het project.

## Opmerkingen

- Zorg ervoor dat de databaseverbinding correct is ingesteld en dat je MySQL-server draait voordat je het project probeert uit te voeren.
- Het project maakt gebruik van een eenvoudige, maar functionele opzet voor een blogplatform.

Voor verdere vragen of problemen kun je contact opnemen met de projectbeheerder of de documentatie doorlezen voor meer gedetailleerde informatie.
