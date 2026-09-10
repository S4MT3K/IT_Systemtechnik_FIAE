<?php
// ========================================================================
// SICHERE PROGRAMMIERUNG: SQL-Injection, XSS, Passwort-Hashing
// ========================================================================
// Der praktische Gegenpart zur "Schutzbedarfsanalyse" (die eher Papierkram
// ist): konkrete, alltägliche Angriffsmuster kennen UND wissen, wie man sie
// im eigenen Code verhindert. Alle drei Themen hier zählen zu den am
// häufigsten ausgenutzten Schwachstellen in Webanwendungen.

// ------------------------------------------------------------------
// SQL-Injection - wenn Nutzereingaben zu SQL-Befehlen werden
// ------------------------------------------------------------------
// UNSICHER: Nutzereingabe wird direkt in den SQL-String eingebaut:

$eingabe = "admin' OR '1'='1"; // das könnte jemand ins Login-Feld eintippen
$unsicheresQuery = "SELECT * FROM users WHERE name = '$eingabe'";
echo $unsicheresQuery;
echo "<br>";
// SELECT * FROM users WHERE name = 'admin' OR '1'='1'
// '1'='1' ist IMMER wahr - diese Abfrage würde ALLE Nutzer zurückgeben,
// egal ob "admin" wirklich existiert! Ein Angreifer könnte sich so ohne
// gültiges Passwort einloggen.

// SICHER: Prepared Statements (mit PDO) - Nutzereingaben werden NIEMALS als
// Teil des SQL-Textes behandelt, sondern getrennt als reine DATEN übergeben:
//
//   $pdo = new PDO("mysql:host=localhost;dbname=meine_db", $user, $pass);
//   $stmt = $pdo->prepare("SELECT * FROM users WHERE name = :name");
//   $stmt->execute(["name" => $eingabe]);
//   $ergebnis = $stmt->fetchAll();
//
// Egal was in $eingabe steht (auch "admin' OR '1'='1") - die Datenbank
// interpretiert es IMMER als reinen Textwert, niemals als SQL-Befehl.
// (Kein DB-Server hier verfügbar, deswegen nicht direkt ausführbar - das
// Muster "prepare() + execute() mit benannten Platzhaltern" ist aber Standard.)

// Merksatz: NIEMALS Nutzereingaben direkt in einen SQL-String einbauen -
// IMMER Prepared Statements verwenden.


// ------------------------------------------------------------------
// XSS (Cross-Site Scripting) - wenn Nutzereingaben zu ausführbarem Code werden
// ------------------------------------------------------------------
// UNSICHER: Nutzereingabe wird ungefiltert als HTML ausgegeben:

$userKommentar = "<script>alert('XSS')</script>";
echo "Unsicher: " . $userKommentar;
echo "<br>";
// Der Browser würde das <script>-Tag TATSÄCHLICH ausführen - ein Angreifer
// könnte so z.B. Session-Cookies anderer Nutzer:innen stehlen.

// SICHER: htmlspecialchars() wandelt HTML-Sonderzeichen in harmlosen Text um:
echo "Sicher: " . htmlspecialchars($userKommentar, ENT_QUOTES, 'UTF-8');
echo "<br>";
// &lt;script&gt;alert(&#039;XSS&#039;)&lt;/script&gt; - der Browser zeigt das
// jetzt als reinen TEXT an, führt es aber nicht mehr aus.

// Merksatz: JEDE Nutzereingabe, die du in eine HTML-Seite ausgibst, muss
// durch htmlspecialchars() (oder ein vergleichbares Escaping) laufen - egal
// ob Kommentar, Name, oder Suchbegriff.


// ------------------------------------------------------------------
// Passwort-Hashing - Passwörter NIE im Klartext speichern
// ------------------------------------------------------------------
// Ein Hash ist eine EINWEG-Umwandlung: aus dem Passwort wird ein langer,
// nicht umkehrbarer Text. Selbst wer die Datenbank komplett stiehlt, kann
// aus dem Hash NICHT das Original-Passwort zurückrechnen.

$passwort = "MeinGeheimesPasswort123";
$hash = password_hash($passwort, PASSWORD_DEFAULT); // NIEMALS md5()/sha1() dafür benutzen!
echo $hash;
echo "<br>";

// Beim Login prüft man NICHT den Hash direkt, sondern lässt PHP vergleichen:
var_dump(password_verify("MeinGeheimesPasswort123", $hash)); // true
var_dump(password_verify("FalschesPasswort", $hash));         // false
echo "<br>";

// Interessant: zwei Hashes DESSELBEN Passworts sehen unterschiedlich aus!
$hash2 = password_hash($passwort, PASSWORD_DEFAULT);
var_dump($hash === $hash2); // false! Trotzdem verifiziert beide korrekt:
var_dump(password_verify($passwort, $hash2)); // true

// Der Grund: password_hash() mischt automatisch einen zufälligen "Salt" mit
// ein, damit gleiche Passwörter NICHT denselben Hash ergeben - das
// verhindert sogenannte "Rainbow-Table"-Angriffe (vorberechnete Listen
// bekannter Passwort-Hashes).

// Merksatz: password_hash()/password_verify() sind die EINZIGEN Funktionen,
// die man für Passwörter benutzen sollte - niemals md5(), sha1() oder eigene
// "Verschlüsselung", die alle für diesen Zweck unsicher oder ungeeignet sind.
