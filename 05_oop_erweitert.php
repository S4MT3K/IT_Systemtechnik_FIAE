<?php
// ========================================================================
// OOP ERWEITERT: Vererbung, Interfaces, abstrakte & anonyme Klassen
// ========================================================================

// ------------------------------------------------------------------
// Vererbung (extends) - schon in 04 genutzt, hier die Details
// ------------------------------------------------------------------
// Eine Klasse kann von einer anderen ERBEN: sie bekommt automatisch alle
// Eigenschaften und Methoden der "Elternklasse" und kann sie erweitern oder
// überschreiben (wie Hund/Katze <- Tier in der letzten Lektion).


// ------------------------------------------------------------------
// Abstrakte Klassen - ein Bauplan, der selbst nie gebaut wird
// ------------------------------------------------------------------
// Eine ABSTRAKTE Klasse legt fest, WAS ihre Unterklassen können müssen
// (über "abstract"-Methoden ohne eigenen Code), aber sie kann selbst NIEMALS
// direkt erzeugt werden - nur ihre konkreten Unterklassen dürfen das:

abstract class Vogel
{
    public function __construct(protected string $name)
    {
    }

    // Keine Implementierung hier - JEDE Unterklasse MUSS das selbst umsetzen:
    abstract public function machGeraeusch(): string;

    // Normale, fertige Methode - wird von allen Unterklassen geerbt:
    public function vorstellen(): string
    {
        return "Ich bin " . $this->name . ". " . $this->machGeraeusch();
    }
}

// new Vogel("x"); // Fehler! "Cannot instantiate abstract class Vogel"


// ------------------------------------------------------------------
// Interfaces - ein reiner "Vertrag" ohne jegliche Implementierung
// ------------------------------------------------------------------
// Ein Interface legt NUR fest, welche Methoden eine Klasse anbieten MUSS -
// gar keine gemeinsame Basis-Funktionalität wie bei einer abstrakten Klasse,
// nur die Namen und Signaturen der Methoden:

interface Fliegbar
{
    public function fliege(): string;
}

// Eine Klasse kann von EINER abstrakten Klasse erben (extends), aber
// GLEICHZEITIG mehrere Interfaces "implementieren" (implements):

class Papagei extends Vogel implements Fliegbar
{
    public function machGeraeusch(): string
    {
        return "Ich kann sprechen!";
    }

    public function fliege(): string
    {
        return "{$this->name} fliegt los!";
    }
}

$papagei = new Papagei("Polly");
echo $papagei->vorstellen(); // Ich bin Polly. Ich kann sprechen! (geerbte Methode)
echo "<br>";
echo $papagei->fliege();     // Polly fliegt los! (aus dem Interface umgesetzt)
echo "<br>";

// instanceof prüft, ob ein Objekt zu einer Klasse oder einem Interface "passt":
var_dump($papagei instanceof Fliegbar); // true
var_dump($papagei instanceof Vogel);    // true

// Merksatz: abstrakte Klasse = "gemeinsame Basis + offene Punkte", Interface
// = "reiner Vertrag, keine Basis-Funktionalität". Eine Klasse kann nur EINE
// Elternklasse haben, aber BELIEBIG VIELE Interfaces implementieren.


// ------------------------------------------------------------------
// Anonyme Klassen - eine Klasse ohne eigenen Namen, direkt "vor Ort" erzeugt
// ------------------------------------------------------------------
// Praktisch für einmalige, kleine Objekte, für die sich eine eigene, benannte
// Klassendefinition nicht lohnt:

$logger = new class {
    public function log(string $nachricht): void
    {
        echo "[LOG] $nachricht";
    }
};
$logger->log("Test");
echo "<br>";

// Merksatz: Anonyme Klassen sind selten, aber praktisch für kleine
// Helferobjekte (z.B. in Tests), bei denen ein eigener Klassenname nur
// unnötig Ballast wäre.


// ------------------------------------------------------------------
// Vergleich: Interfaces in C#
// ------------------------------------------------------------------
// Nur zur Einordnung, nicht ausführbar - C# hat dasselbe Grundkonzept,
// nur mit eigener Syntax (Interfaces beginnen per Konvention mit "I"):
//
//   interface IFliegbar {
//       string Fliege();
//   }
//
//   class Papagei : Vogel, IFliegbar {
//       public string Fliege() => $"{Name} fliegt los!";
//   }
//
// Das Prinzip (Vertrag ohne Implementierung, mehrere Interfaces pro Klasse)
// ist in praktisch jeder objektorientierten Sprache identisch - nur die
// Schreibweise unterscheidet sich.
