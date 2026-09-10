# Dependency Management: Composer (PHP) & npm (JavaScript)

*Alle Befehle unten wurden tatsächlich ausgeführt (echtes Paket installiert und
benutzt) - keine Behauptungen.*

## Einleitung

Für fast jedes Problem, das du lösen willst, hat schon jemand anderes eine fertige,
getestete Bibliothek geschrieben - UUID-Generierung, Datum-Formatierung, HTTP-Clients,
und vieles mehr. Dependency Management (Abhängigkeitsverwaltung) ist das Werkzeug, um
solche fremden Bibliotheken sauber in dein Projekt einzubinden, statt sie selbst neu
zu schreiben.

## Composer - der Paketmanager für PHP

```bash
composer init --name="meine-firma/mein-projekt"   # erstellt composer.json
composer require ramsey/uuid                       # installiert ein Paket
```

Das erzeugt eine `composer.json` (die gewünschten Pakete UND ihre Versionen) und
lädt automatisch alle benötigten Dateien in einen `vendor/`-Ordner:

```json
{
    "require": {
        "ramsey/uuid": "^4.9"
    }
}
```

Danach kannst du das Paket sofort benutzen - EIN Include reicht (Composers
"Autoloader" kümmert sich automatisch darum, die richtige Datei nachzuladen, sobald
eine Klasse aus dem Paket gebraucht wird):

```php
<?php
require __DIR__ . '/vendor/autoload.php';

use Ramsey\Uuid\Uuid;

$uuid = Uuid::uuid4();
echo $uuid->toString(); // z.B. "a1b2c3d4-e5f6-..." - eine zufällige, eindeutige ID
```

## npm - der Paketmanager für JavaScript

Fast identisches Prinzip, andere Sprache:

```bash
npm init -y              # erstellt package.json
npm install chalk        # installiert ein Paket (hier: farbige Konsolen-Ausgaben)
```

```json
{
    "dependencies": {
        "chalk": "^4.1.2"
    }
}
```

```javascript
const chalk = require("chalk");
console.log(chalk.green("Funktioniert!")); // grün eingefärbter Text im Terminal
```

## Warum das Versionsnummern-Format wichtig ist

Sowohl `composer.json` als auch `package.json` speichern nicht nur den Paketnamen,
sondern auch eine Versionsangabe wie `^4.9` oder `^4.1.2`. Das `^` bedeutet: "diese
Version oder neuere, aber KEINE Version mit einer größeren ERSTEN Zahl" - so bekommt
man automatisch Fehlerbehebungen, aber keine Änderungen, die absichtlich etwas
grundlegend anders machen (sogenannte "Breaking Changes").

## Was NICHT ins Git-Repository gehört

Die heruntergeladenen Pakete selbst (`vendor/` bei Composer, `node_modules/` bei npm)
werden NICHT mit eingecheckt - sie können anhand von `composer.json`/`package.json`
jederzeit neu heruntergeladen werden (`composer install`/`npm install`). Deswegen
gehören beide Ordner in die `.gitignore` (siehe Programmiergrundlagen).

## Grundprinzip

Dependency Management trennt "was mein Projekt BRAUCHT" (die `.json`-Datei, wird
committed) von "die tatsächlichen heruntergeladenen Dateien" (der Ordner, wird NICHT
committed). Jede:r im Team lädt sich mit einem einzigen Befehl exakt dieselben
Abhängigkeiten in exakt denselben Versionen herunter.

## Mini-Übung

1. Was ist der Unterschied zwischen `composer.json` und dem `vendor/`-Ordner?
2. Warum committet man `node_modules/` normalerweise NICHT in Git?
3. Was bedeutet `^4.9` als Versionsangabe?

**Lösung:**
1. `composer.json` listet, WELCHE Pakete in WELCHEN Versionen gebraucht werden
   (kompakte Textdatei) - `vendor/` enthält die tatsächlich heruntergeladenen Dateien
   dieser Pakete (kann sehr groß werden).
2. Weil er jederzeit aus `package.json` heraus neu generiert werden kann (`npm
   install`) - ihn einzuchecken würde das Repository nur unnötig aufblähen.
3. "Diese Version oder neuere Korrekturen/kleine Verbesserungen, aber keine Version
   mit einer größeren ersten Zahl (die absichtlich etwas Grundlegendes ändern könnte)".
