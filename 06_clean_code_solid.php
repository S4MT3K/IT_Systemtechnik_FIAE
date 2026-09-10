<?php
// ========================================================================
// CLEAN CODE & SOLID-PRINZIPIEN
// ========================================================================
// Code, der FUNKTIONIERT, ist nur die halbe Miete. Code, den DU in 6 Monaten
// noch verstehst - oder ein Teamkollege ÜBERHAUPT verstehen kann - ist eine
// eigene Fähigkeit. Genau darum geht es bei "Clean Code".

// ------------------------------------------------------------------
// Naming - der wichtigste (und billigste) Hebel
// ------------------------------------------------------------------

// SCHLECHT: was ist $d, was macht f()?
function f($d) {
    return $d * 0.19;
}

// GUT: der Name verrät SOFORT, was passiert, ohne dass man den Body lesen muss
function berechneMehrwertsteuer(float $nettobetrag): float
{
    return $nettobetrag * 0.19;
}
echo berechneMehrwertsteuer(100); // 19
echo "<br>";


// ------------------------------------------------------------------
// DRY - Don't Repeat Yourself
// ------------------------------------------------------------------
// Wiederholt sich derselbe Code an mehreren Stellen, wird JEDE spätere
// Änderung zur Fehlerquelle - man muss sich an ALLE Stellen erinnern.

// SCHLECHT: dieselbe Rabattlogik zweimal geschrieben
function preisKundeA($preis) { return $preis * 0.9; }
function preisKundeB($preis) { return $preis * 0.9; } // Copy-Paste!

// GUT: EINE Stelle, die die Logik kennt
function preisMitRabatt(float $preis, float $rabattProzent = 10.0): float
{
    return $preis * (1 - $rabattProzent / 100);
}
echo preisMitRabatt(100); // 90
echo "<br>";


// ------------------------------------------------------------------
// KISS - Keep It Simple, Stupid
// ------------------------------------------------------------------
// Die einfachste Lösung, die das Problem löst, ist meistens die richtige -
// nicht die cleverste oder kürzeste.

// UNNÖTIG KOMPLIZIERT:
function istGerade1($n) { return ($n % 2 === 0) ? true : false; }

// EINFACHER (der Vergleich IST schon ein Boolean, siehe Booleans-Notiz):
function istGerade2(int $n): bool
{
    return $n % 2 === 0;
}
var_dump(istGerade2(4)); // true
echo "<br>";


// ------------------------------------------------------------------
// SOLID - fünf Prinzipien für gut wartbare OOP
// ------------------------------------------------------------------
// (Vollständige Beispiele würden hier den Rahmen sprengen, deswegen: Kern-
// idee jedes Buchstabens + ein Merksatz.)
//
// S - Single Responsibility: Eine Klasse sollte GENAU EINEN Grund haben,
//     sich zu ändern. Eine Klasse "Rechnung", die GLEICHZEITIG PDF-Export,
//     E-Mail-Versand UND Steuerberechnung macht, hat DREI Verantwortlichkeiten
//     - besser: drei separate Klassen.
//
// O - Open/Closed: Code sollte ERWEITERBAR sein, OHNE bestehenden Code zu
//     verändern. Genau das ermöglicht Vererbung/Interfaces aus Lektion 05:
//     eine neue Tier-Art hinzufügen, ohne die Tier-Klasse anzufassen.
//
// L - Liskov Substitution: Eine Unterklasse muss sich überall dort einsetzen
//     lassen, wo die Elternklasse erwartet wird, OHNE das Verhalten zu
//     brechen. Erwartet man ein "Vogel"-Objekt, darf ein "Papagei" (siehe 05)
//     nicht plötzlich anders/kaputt reagieren.
//
// I - Interface Segregation: Lieber mehrere kleine, spezifische Interfaces
//     als ein riesiges "Alleskönner"-Interface, das Klassen zwingt, Methoden
//     zu implementieren, die sie gar nicht brauchen.
//
// D - Dependency Inversion: Klassen sollten von ABSTRAKTIONEN (Interfaces)
//     abhängen, nicht von konkreten anderen Klassen - macht Code austauschbar
//     und leichter testbar (siehe Unit-Testing-Notiz).


// ------------------------------------------------------------------
// Code-Dokumentation: PHPDoc
// ------------------------------------------------------------------
// Guter Code erklärt sich oft selbst durch Namen (siehe oben) - aber manche
// Dinge (z.B. WARUM eine Entscheidung getroffen wurde, oder genaue Typen für
// die IDE) gehören in einen strukturierten Kommentar direkt vor der Funktion,
// den man PHPDoc nennt:

/**
 * Berechnet den Rabattpreis für einen gegebenen Ausgangspreis.
 *
 * @param float $preis Der Preis vor Rabatt in Euro.
 * @param float $rabattProzent Der Rabatt in Prozent (Standard: 10%).
 * @return float Der Preis nach Abzug des Rabatts.
 */
function preisMitRabattDokumentiert(float $preis, float $rabattProzent = 10.0): float
{
    return $preis * (1 - $rabattProzent / 100);
}

// Der Vorteil: IDEs wie PhpStorm lesen PHPDoc-Kommentare und zeigen dir beim
// Aufruf der Funktion automatisch an, was sie erwartet und zurückgibt - ganz
// ohne dass du selbst in die Funktion hineinschauen musst. JavaScript hat mit
// JSDoc ein fast identisches Konzept, nur mit eigener Syntax für die Tags.

// Merksatz: Clean Code + Dokumentation ist keine "nette Zusatzarbeit" -
// es ist der Unterschied zwischen einem Projekt, das ein Team WEITERPFLEGEN
// kann, und einem, das nach 6 Monaten niemand mehr anfassen will.
