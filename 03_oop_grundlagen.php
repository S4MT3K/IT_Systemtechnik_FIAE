<?php
// ========================================================================
// OOP GRUNDLAGEN: Klassen, Methoden, Konstruktoren, Getter/Setter
// ========================================================================
// Bisher war unser Code eine Sammlung von Variablen und Funktionen, die
// lose nebeneinander existierten. Objektorientierte Programmierung (OOP)
// bündelt Daten UND die Funktionen, die zu diesen Daten gehören, in EINEM
// Baustein - einer Klasse. Man kann sich eine Klasse wie einen Bauplan
// vorstellen, ein Objekt ist dann das fertig gebaute Haus nach diesem Plan.

// ------------------------------------------------------------------
// Eine Klasse definieren
// ------------------------------------------------------------------
class Konto
{
    // Eigenschaften (Attribute/Properties) - die "Daten" des Objekts
    private float $kontostand;
    public string $inhaber;

    // Der KONSTRUKTOR läuft automatisch beim Erzeugen eines neuen Objekts.
    // Er "baut" das Objekt initial auf.
    public function __construct(string $inhaber, float $startguthaben = 0.0)
    {
        $this->inhaber = $inhaber;         // $this = "dieses konkrete Objekt"
        $this->kontostand = $startguthaben;
    }

    // Methoden - Funktionen, die zur Klasse gehören
    public function einzahlen(float $betrag): void
    {
        $this->kontostand += $betrag;
    }

    // GETTER - eine Methode, die einen Wert kontrolliert nach außen gibt
    public function getKontostand(): float
    {
        return $this->kontostand;
    }
}

// Ein Objekt (eine "Instanz") der Klasse erzeugen mit "new":
$konto = new Konto("Max", 100.0);
echo $konto->inhaber;           // Max - öffentliche Eigenschaft direkt lesbar
echo "<br>";
echo $konto->getKontostand();   // 100 - über den Getter, nicht direkt
echo "<br>";

$konto->einzahlen(50);
echo $konto->getKontostand();   // 150
echo "<br>";


// ------------------------------------------------------------------
// Warum private + Getter/Setter, statt einfach alles public zu machen?
// ------------------------------------------------------------------
// $kontostand ist "private" - von AUSSERHALB der Klasse gar nicht direkt
// erreichbar:

// echo $konto->kontostand; // Fehler! "Cannot access private property"

// Das ist GEWOLLT: so kann niemand von außen versehentlich (oder absichtlich)
// den Kontostand auf einen unsinnigen Wert setzen. Ein SETTER kann dagegen
// die Eingabe erst prüfen, bevor er sie übernimmt:

class Person
{
    private int $alter;

    public function __construct(int $alter)
    {
        $this->setAlter($alter); // Konstruktor nutzt gleich den eigenen Setter
    }

    public function setAlter(int $neuesAlter): void
    {
        if ($neuesAlter < 0) {
            $neuesAlter = 0; // einfache Absicherung: kein negatives Alter
        }
        $this->alter = $neuesAlter;
    }

    public function getAlter(): int
    {
        return $this->alter;
    }
}

$person = new Person(-5);
echo $person->getAlter(); // 0 - der Setter hat den unsinnigen Wert abgefangen
echo "<br>";

// Merksatz: Eigenschaften private machen und nur über Getter/Setter-Methoden
// zugänglich machen, nennt man Datenkapselung - dazu mehr in der nächsten Lektion.


// ------------------------------------------------------------------
// Mehrere Objekte derselben Klasse
// ------------------------------------------------------------------
// Jedes Objekt hat SEINE EIGENEN Werte für die Eigenschaften - wie mehrere
// Häuser, die nach demselben Bauplan gebaut wurden, aber unterschiedlich
// eingerichtet sind:

$kontoA = new Konto("Anna", 200.0);
$kontoB = new Konto("Ben", 50.0);

echo $kontoA->getKontostand(); // 200
echo "<br>";
echo $kontoB->getKontostand(); // 50 - komplett unabhängig von $kontoA
