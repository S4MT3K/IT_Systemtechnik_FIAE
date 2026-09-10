<?php
// ========================================================================
// API-AUTHENTIFIZIERUNG GRUNDLAGEN
// ========================================================================
// Eine öffentlich erreichbare REST-API (siehe eigene Notiz) kann nicht
// JEDEM Zugriff erlauben - Authentifizierung beweist gegenüber dem Server:
// "ich bin berechtigt, diese Anfrage zu stellen". Die Beispiele hier laufen
// gegen httpbin.org - einen öffentlichen Testdienst genau für solche Zwecke.

// ------------------------------------------------------------------
// Basic Auth - Benutzername + Passwort direkt im HTTP-Header
// ------------------------------------------------------------------
// Der einfachste (und älteste) Standard: Benutzername und Passwort werden
// mit einem Doppelpunkt verbunden, Base64-kodiert (KEINE Verschlüsselung,
// nur eine Textumwandlung!) und im "Authorization"-Header mitgeschickt:

$benutzer = "max";
$passwort = "geheim123";

$anmeldedaten = base64_encode("$benutzer:$passwort");

$kontext = stream_context_create([
    "http" => [
        "header" => "Authorization: Basic $anmeldedaten\r\n",
    ],
]);

$antwort = file_get_contents(
    "https://httpbin.org/basic-auth/$benutzer/$passwort",
    false,
    $kontext
);
echo $http_response_header[0]; // HTTP/1.1 200 OK
echo "<br>";
echo $antwort; // {"authenticated": true, "user": "max"}
echo "<br>";

// WICHTIG: Weil Base64 KEINE Verschlüsselung ist (jeder kann es decodieren!),
// ist Basic Auth NUR über HTTPS sicher - über eine unverschlüsselte HTTP-
// Verbindung wären Benutzername und Passwort für jeden im Netzwerk lesbar.


// ------------------------------------------------------------------
// Bearer Token - ein einzelnes, geheimes "Ticket" statt Passwort
// ------------------------------------------------------------------
// Statt bei JEDER Anfrage Benutzername+Passwort mitzuschicken, bekommt man
// sich EINMAL einloggend ein Token (eine lange, zufällige Zeichenkette),
// das man danach bei jeder weiteren Anfrage mitschickt - wie ein
// Garderobenticket, das man einmal bekommt und danach vorzeigt:

$token = "mein-geheimes-token-123"; // käme in der Praxis von einem Login-Endpunkt

$kontext2 = stream_context_create([
    "http" => [
        "header" => "Authorization: Bearer $token\r\n",
    ],
]);

$antwort2 = file_get_contents("https://httpbin.org/bearer", false, $kontext2);
echo $http_response_header[0]; // HTTP/1.1 200 OK
echo "<br>";
echo $antwort2; // {"authenticated": true, "token": "mein-geheimes-token-123"}
echo "<br>";

// Merksatz: Bearer Token ist heute der Standard für die meisten modernen
// APIs (auch bekannt als "API-Key"-Prinzip) - das bekannteste konkrete
// Format dafür heißt JWT (JSON Web Token), das zusätzlich noch Nutzer-
// Informationen und eine Ablaufzeit im Token selbst codiert.


// ------------------------------------------------------------------
// Was bei FALSCHEN Zugangsdaten passiert
// ------------------------------------------------------------------
$falscherKontext = stream_context_create([
    "http" => [
        "header" => "Authorization: Basic " . base64_encode("max:falsch") . "\r\n",
        "ignore_errors" => true, // sonst wirft file_get_contents eine Warning statt den Body zu liefern
    ],
]);
file_get_contents("https://httpbin.org/basic-auth/$benutzer/$passwort", false, $falscherKontext);
echo $http_response_header[0]; // HTTP/1.1 401 UNAUTHORIZED

// Merksatz: Status 401 (Unauthorized) heißt "wer bist du überhaupt/deine
// Zugangsdaten stimmen nicht" - zu unterscheiden von 403 (Forbidden): "ich
// weiß wer du bist, aber du darfst das trotzdem nicht".
