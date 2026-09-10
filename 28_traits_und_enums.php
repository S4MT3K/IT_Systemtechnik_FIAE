<?php
// ========================================================================
// TRAITS & ENUMS (PHP-spezifische OOP-Werkzeuge)
// ========================================================================
// Zwei PHP-Features, die es so in vielen anderen Sprachen nicht (oder
// anders) gibt, die aber im PHP-Alltag ständig vorkommen.

// ------------------------------------------------------------------
// Traits - Code zwischen Klassen TEILEN, ohne Vererbung zu benutzen
// ------------------------------------------------------------------
// Eine Klasse kann in PHP nur von EINER Elternklasse erben (siehe OOP-
// Lektionen). Was aber, wenn zwei völlig UNVERWANDTE Klassen dieselbe
// Fähigkeit brauchen (z.B. "kann loggen") - dafür extra eine gemeinsame
// Elternklasse zu erfinden, wäre unpassend. Ein Trait ist fertiger Code,
// den man in JEDE beliebige Klasse "hineinmischen" kann:

trait Loggbar
{
    public function log(string $nachricht): void
    {
        // static::class gibt den NAMEN der tatsächlichen Klasse zurück,
        // die dieses Trait gerade benutzt:
        echo "[" . static::class . "] $nachricht";
        echo "<br>";
    }
}

class Bestellung
{
    use Loggbar; // "mischt" die log()-Methode direkt in diese Klasse ein
}

class Nutzer
{
    use Loggbar; // dieselbe Fähigkeit, obwohl Bestellung und Nutzer NICHTS
                 // miteinander zu tun haben
}

(new Bestellung())->log("erstellt");   // [Bestellung] erstellt
(new Nutzer())->log("registriert");    // [Nutzer] registriert

// Merksatz: Vererbung (extends) beantwortet "WAS IST dieses Objekt"
// (Papagei IST EIN Vogel, siehe OOP-erweitert-Lektion). Ein Trait
// beantwortet "WAS KANN dieses Objekt zusätzlich" - unabhängig von seiner
// Position in einer Vererbungshierarchie.


// ------------------------------------------------------------------
// Enums (seit PHP 8.1) - eine feste, benannte Menge an Möglichkeiten
// ------------------------------------------------------------------
// Früher (und in vielen anderen Sprachen ohne Enums) hätte man dafür
// Strings ("offen", "in_bearbeitung") oder Zahlen (0, 1, 2) benutzt - mit
// dem Risiko von Tippfehlern, die der Typchecker (siehe Typsicherheit-
// Lektion) nicht erkennen kann. Ein Enum macht daraus einen ECHTEN Typ:

enum Status
{
    case Offen;
    case InBearbeitung;
    case Abgeschlossen;
}

function beschreibeStatus(Status $status): string
{
    // match() (siehe Kontrollstrukturen) mit Enum-Fällen - der Typchecker
    // kann hier sogar prüfen, ob ALLE möglichen Fälle abgedeckt sind!
    return match ($status) {
        Status::Offen => "noch nicht gestartet",
        Status::InBearbeitung => "wird bearbeitet",
        Status::Abgeschlossen => "fertig",
    };
}

echo beschreibeStatus(Status::InBearbeitung); // wird bearbeitet
echo "<br>";

// beschreibeStatus("offen"); // Fehler! Ein String ist KEIN gültiger Status,
// das hätte man mit einem einfachen String niemals abfangen können.


// ------------------------------------------------------------------
// Backed Enums - jedem Fall einen konkreten Wert zuordnen
// ------------------------------------------------------------------
// Praktisch, wenn der Enum-Wert z.B. auch in einer Datenbank oder einer
// API gespeichert/übertragen werden soll:

enum Prioritaet: int
{
    case Niedrig = 1;
    case Mittel = 2;
    case Hoch = 3;
}

echo Prioritaet::Hoch->value; // 3 - der zugrundeliegende Wert
echo "<br>";
echo Prioritaet::Hoch->name;  // "Hoch" - der Name des Falls
echo "<br>";

// Von einem gespeicherten Wert ZURÜCK zum Enum-Fall:
$prioritaet = Prioritaet::from(2);
var_dump($prioritaet); // enum(Prioritaet::Mittel)

// Merksatz: Enums verhindern "unmögliche Zustände" im Code - eine Variable
// vom Typ Status kann NUR einer der drei definierten Fälle sein, niemals
// ein Tippfehler wie "OffenXY" oder ein komplett falscher Wert.
