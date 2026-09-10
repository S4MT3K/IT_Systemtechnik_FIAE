<?php
// ========================================================================
// EXCEPTION-HANDLING: try/catch/throw, eigene Exceptions, Asserts
// ========================================================================
// In Programmiergrundlagen hast du schon gesehen, dass z.B. eine Division
// durch 0 einen DivisionByZeroError wirft - und dass wir das Abfangen
// (try/catch) auf "später" verschoben haben. Hier ist "später".

// ------------------------------------------------------------------
// try / catch - einen Fehler kontrolliert abfangen
// ------------------------------------------------------------------
// OHNE try/catch würde ein Fehler das komplette Skript abbrechen. MIT
// try/catch kannst du selbst entscheiden, wie das Programm reagiert:

try {
    echo 10 / 0;
} catch (\DivisionByZeroError $e) {
    echo "Abgefangen: " . $e->getMessage(); // Division by zero
}
echo "<br>";
// Das Skript läuft NORMAL weiter - ohne try/catch wäre hier Schluss gewesen.


// ------------------------------------------------------------------
// finally - läuft IMMER, egal ob ein Fehler auftrat oder nicht
// ------------------------------------------------------------------
try {
    echo "Versuch...";
    throw new \Exception("Etwas ging schief");
} catch (\Exception $e) {
    echo "Gefangen: " . $e->getMessage();
} finally {
    echo " | Aufräumen (finally läuft IMMER)";
}
echo "<br>";
// Praktisch z.B. um eine geöffnete Datei/Datenbankverbindung IMMER zu
// schließen, egal ob die Verarbeitung erfolgreich war oder nicht.


// ------------------------------------------------------------------
// Eigene Exceptions - wenn die eingebauten nicht spezifisch genug sind
// ------------------------------------------------------------------
// Eine eigene Exception ist einfach eine Klasse, die von \Exception erbt
// (siehe Vererbung, Lektion 05):

class UngueltigesAlterException extends \Exception
{
}

function setzeAlter(int $alter): int
{
    if ($alter < 0) {
        throw new UngueltigesAlterException("Alter darf nicht negativ sein: $alter");
    }
    return $alter;
}

try {
    setzeAlter(-5);
} catch (UngueltigesAlterException $e) {
    echo "Eigene Exception gefangen: " . $e->getMessage();
}
echo "<br>";

// Merksatz: Eigene Exceptions machen im catch-Block sofort klar, WELCHER
// Fehlertyp aufgetreten ist - statt eine generische Fehlermeldung zu prüfen.


// ------------------------------------------------------------------
// Mehrere catch-Blöcke - unterschiedlich auf unterschiedliche Fehler reagieren
// ------------------------------------------------------------------
try {
    $ergebnis = 10 / 0;
} catch (\DivisionByZeroError $e) {
    echo "Speziell: Division durch 0!";
} catch (\Throwable $e) {
    // \Throwable fängt ALLES ab, was Error oder Exception ist - als
    // "Auffangnetz" ganz am Ende, wenn nichts Spezielleres gepasst hat.
    echo "Allgemeiner Fehler: " . $e->getMessage();
}
echo "<br>";

// Merksatz: catch-Blöcke werden der Reihe nach geprüft - der SPEZIFISCHERE
// Fehlertyp muss deswegen VOR dem allgemeinen \Throwable stehen.


// ------------------------------------------------------------------
// assert() - Annahmen im Code überprüfbar machen
// ------------------------------------------------------------------
// assert() prüft eine Bedingung, die eigentlich IMMER wahr sein sollte. Ist
// sie es nicht, deutet das auf einen Programmierfehler hin (nicht auf eine
// normale, erwartbare Fehlerursache wie bei einer echten Exception):

assert(1 + 1 === 2); // stimmt, passiert nichts sichtbares
echo "assert bestanden";
echo "<br>";

// Asserts werden typischerweise NUR während der Entwicklung aktiv geprüft
// (per php.ini-Einstellung "zend.assertions") und im fertigen Produktions-
// Betrieb übersprungen, um Rechenzeit zu sparen - anders als echte Exceptions,
// die IMMER laufen. Praktisch für Selbstkontrollen wie "diese Liste darf an
// dieser Stelle nie leer sein" während der Entwicklung.
