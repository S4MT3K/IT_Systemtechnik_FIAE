<?php
// ========================================================================
// SERIALISIERUNG: JSON & Random-Access-Dateizugriff
// ========================================================================
// "Serialisierung" heißt: ein Datenstruktur (Array, Objekt) in ein Format
// umwandeln, das man SPEICHERN oder ÜBER DAS NETZWERK VERSENDEN kann - z.B.
// als Text in eine Datei oder als HTTP-Antwort (siehe REST-API-Notiz).
// "Deserialisierung" ist der umgekehrte Weg zurück zur Datenstruktur.

// ------------------------------------------------------------------
// JSON (JavaScript Object Notation) - das universelle Austauschformat
// ------------------------------------------------------------------
// JSON ist trotz des Namens LÄNGST sprachunabhängig - so gut wie jede
// moderne Sprache kann JSON lesen und schreiben. Es ist das mit Abstand
// gebräuchlichste Format für APIs (siehe REST-API-Notiz) und Konfigurationen.

$nutzer = [
    "name" => "Max",
    "alter" => 25,
    "hobbys" => ["Lesen", "Programmieren"],
];

$json = json_encode($nutzer); // Serialisierung: Array -> JSON-String
echo $json;
echo "<br>";
// {"name":"Max","alter":25,"hobbys":["Lesen","Programmieren"]}

$zurueck = json_decode($json, true); // Deserialisierung: JSON-String -> Array
// (das "true" sagt: gib mir ein assoziatives Array, keine Objekte)
print_r($zurueck);

// Merksatz: JSON kann NUR einfache Datentypen abbilden (Strings, Zahlen,
// Booleans, null, Arrays, verschachtelte Objekte) - Dinge wie Funktionen
// oder Datumsobjekte müssen erst in einfachere Werte umgewandelt werden,
// bevor sie serialisiert werden können.


// ------------------------------------------------------------------
// Random-Access-Dateizugriff - gezielt an einer bestimmten Stelle lesen/schreiben
// ------------------------------------------------------------------
// In Programmiergrundlagen hast du Dateien immer KOMPLETT gelesen
// (file_get_contents) oder ans Ende angehängt (FILE_APPEND). Manchmal will
// man aber gezielt NUR einen bestimmten Ausschnitt lesen, ohne die ganze
// (eventuell riesige) Datei einzulesen - das nennt man "Random Access"
// (wahlfreier/direkter Zugriff), im Gegensatz zum sequentiellen Lesen von
// Anfang bis Ende:

$pfad = sys_get_temp_dir() . "/beispiel.txt";
file_put_contents($pfad, "0123456789ABCDEFGHIJ");

$handle = fopen($pfad, "r"); // Datei zum Lesen öffnen, gibt einen "Handle" zurück
fseek($handle, 10);          // Lesezeiger DIREKT an Position 10 springen lassen
echo fread($handle, 5);      // liest 5 Zeichen AB Position 10
echo "<br>";
// Ausgabe: ABCDE - wir mussten die ersten 10 Zeichen NICHT einlesen, um dorthin
// zu gelangen!
fclose($handle);             // Handle wieder schließen, wenn fertig
unlink($pfad);                // Aufräumen (Testdatei löschen)

// Merksatz: fopen()/fseek()/fread()/fclose() sind das "klassische", manuelle
// Gegenstück zu file_get_contents() - mehr Kontrolle (gezielt an eine Stelle
// springen), aber auch mehr Verantwortung (Handle selbst wieder schließen!).
// Relevant vor allem bei SEHR großen Dateien, bei denen ein komplettes
// Einlesen zu viel Speicher bräuchte.
