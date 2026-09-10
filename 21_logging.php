<?php
// ========================================================================
// LOGGING statt var_dump/die
// ========================================================================
// var_dump()/print_r()/die() (siehe Programmiergrundlagen) sind praktisch
// beim ENTWICKELN, aber in einer ECHTEN, laufenden Anwendung (im Betrieb,
// mit echten Nutzer:innen) unbrauchbar: niemand sitzt vor dem Bildschirm,
// um eine var_dump()-Ausgabe live zu sehen, und die Anwendung darf wegen
// eines kleinen Problems nicht einfach mit die() komplett abstürzen.
// Logging schreibt stattdessen strukturierte Meldungen in eine DATEI, die
// man sich SPÄTER in Ruhe ansehen kann.

// ------------------------------------------------------------------
// Log-Level - nicht jede Meldung ist gleich wichtig
// ------------------------------------------------------------------
// DEBUG   - Detailinfos, nur beim gezielten Fehlersuchen interessant
// INFO    - normale Ereignisse ("Nutzer hat sich eingeloggt")
// WARNING - etwas Ungewöhnliches, aber die Anwendung läuft weiter
// ERROR   - ein echtes Problem ist aufgetreten (siehe Exception-Handling)
// CRITICAL- die Anwendung kann so nicht weiterlaufen

class EinfacherLogger
{
    public function __construct(private string $pfad)
    {
    }

    private function schreibe(string $level, string $nachricht): void
    {
        $zeitstempel = date("Y-m-d H:i:s");
        $zeile = "[$zeitstempel] [$level] $nachricht" . PHP_EOL;
        file_put_contents($this->pfad, $zeile, FILE_APPEND); // siehe Programmiergrundlagen
    }

    public function info(string $nachricht): void
    {
        $this->schreibe("INFO", $nachricht);
    }

    public function warning(string $nachricht): void
    {
        $this->schreibe("WARNING", $nachricht);
    }

    public function error(string $nachricht): void
    {
        $this->schreibe("ERROR", $nachricht);
    }
}

$logPfad = sys_get_temp_dir() . "/beispiel_app.log";
if (file_exists($logPfad)) {
    unlink($logPfad); // fuer dieses Beispiel: alten Log-Stand loeschen
}

$logger = new EinfacherLogger($logPfad);
$logger->info("Anwendung gestartet");
$logger->warning("Konfigurationsdatei nicht gefunden, nutze Standardwerte");
$logger->error("Datenbankverbindung fehlgeschlagen");

// So sieht der fertige Log dann aus:
echo "<pre>" . file_get_contents($logPfad) . "</pre>";
unlink($logPfad); // Aufräumen für dieses Beispiel


// ------------------------------------------------------------------
// Wo Logs eigentlich hingehören
// ------------------------------------------------------------------
// In einem echten Projekt landen Logs typischerweise NICHT irgendwo im
// Anwendungscode verstreut, sondern in einer festen, dafür vorgesehenen
// Log-Datei (oder einem zentralen Log-System) - die professionelle
// PHP-Bibliothek dafür heißt "Monolog" (wieder per Composer installierbar,
// siehe Dependency-Management-Notiz).

// Merksatz: var_dump()/die() sind für den Moment ("was passiert HIER
// gerade") - Logging ist für die Nachbetrachtung ("was ist HEUTE NACHT UM
// 3 UHR passiert, als niemand hingeschaut hat"). Ein Log-Eintrag mit
// Zeitstempel und Level ist die Grundlage jeder späteren Fehlersuche in
// einer laufenden Anwendung.
