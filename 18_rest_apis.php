<?php
// ========================================================================
// REST-APIS (PHP)
// ========================================================================
// Gleiches Prinzip wie in der .js-Datei: HTTP-Anfragen an eine REST-API
// stellen, JSON senden/empfangen. PHP hat dafür KEIN eingebautes "fetch()",
// aber zwei bewährte Wege: die einfache file_get_contents()-Variante (siehe
// Dateizugriff/Serialisierung), oder die mächtigere curl-Erweiterung.

// ------------------------------------------------------------------
// GET mit file_get_contents() - der einfachste Weg
// ------------------------------------------------------------------
$antwort = file_get_contents("https://jsonplaceholder.typicode.com/todos/1");
$daten = json_decode($antwort, true);
print_r($daten);
// [userId => 1, id => 1, title => "delectus aut autem", completed => false]

// Den HTTP-Status prüfen (steckt in einer speziellen, automatisch gefüllten
// Variable $http_response_header, sobald eine HTTP-Anfrage lief):
echo $http_response_header[0]; // "HTTP/1.1 200 OK"
echo "<br>";


// ------------------------------------------------------------------
// POST mit file_get_contents() + stream_context_create()
// ------------------------------------------------------------------
// Für POST braucht file_get_contents() einen "Kontext" - zusätzliche
// Einstellungen für die HTTP-Anfrage (Methode, Header, Body):

$payload = json_encode(["title" => "Neue Aufgabe", "completed" => false]);

$kontext = stream_context_create([
    "http" => [
        "method" => "POST",
        "header" => "Content-Type: application/json\r\n",
        "content" => $payload,
    ],
]);

$antwort2 = file_get_contents(
    "https://jsonplaceholder.typicode.com/todos",
    false,
    $kontext
);
echo $http_response_header[0]; // "HTTP/1.1 201 Created"
echo "<br>";
print_r(json_decode($antwort2, true));


// ------------------------------------------------------------------
// Die professionellere Alternative: curl
// ------------------------------------------------------------------
// In größeren Projekten nutzt man meist die curl-Erweiterung - mehr Kontrolle
// (Timeouts, Wiederholungsversuche, genauere Fehlerbehandlung), dafür etwas
// mehr Code. Nur zur Einordnung (Grundgerüst):
//
//   $ch = curl_init("https://jsonplaceholder.typicode.com/todos/1");
//   curl_setopt($ch, CURLOPT_RETURNTRANSFER, true); // Antwort als String statt Direktausgabe
//   $antwort = curl_exec($ch);
//   $statusCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
//   curl_close($ch);
//
// Fürs Verstehen des REST-Prinzips reicht file_get_contents() völlig aus -
// curl lohnt sich, sobald man z.B. eigene Timeouts oder wiederholte
// Verbindungsversuche braucht.

// Merksatz: Egal ob PHP oder JS - das REST-Prinzip bleibt identisch: HTTP-
// Methode wählen (GET/POST/...), Daten als JSON senden/empfangen, den
// Status-Code IMMER prüfen (nicht blind davon ausgehen, dass alles geklappt hat).
