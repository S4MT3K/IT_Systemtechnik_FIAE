// ========================================================================
// NEBENLÄUFIGKEIT: Threading vs. Event-Loop vs. Multi-Prozess
// ========================================================================
// "Nebenläufigkeit" heißt: mehrere Dinge scheinen (oder sind tatsächlich)
// GLEICHZEITIG zu passieren. Verschiedene Sprachen/Umgebungen lösen das
// grundlegend unterschiedlich - hier die drei wichtigsten Modelle im Vergleich.

// ------------------------------------------------------------------
// Modell 1: Event-Loop (JavaScript im Browser & in Node.js)
// ------------------------------------------------------------------
// JavaScript hat NUR EINEN Ausführungsstrang (Single-Threaded) - es kann zu
// JEDEM Zeitpunkt buchstäblich nur EINE Codezeile gleichzeitig ausführen.
// "Gleichzeitigkeit" entsteht dadurch, dass wartende Aktionen (Timer,
// Netzwerk-Anfragen, siehe Async/Await-Notiz) das Programm NICHT blockieren,
// sondern im Hintergrund laufen und ihren Callback erst dann einreihen,
// wenn der aktuelle Code fertig ist:

console.log("Start");
setTimeout(() => console.log("Sollte bald kommen (0ms Wartezeit)"), 0);

// Eine BLOCKIERENDE (synchrone) Operation zeigt die Grenze dieses Modells:
function blockiereFuer(millisekunden) {
    const ende = Date.now() + millisekunden;
    while (Date.now() < ende) {
        // aktives Warten - blockiert den EINZIGEN Thread komplett!
    }
}
console.log("Blockiere jetzt für 50ms...");
blockiereFuer(50);
console.log("Fertig blockiert");
// ERGEBNIS: der Timeout-Callback kommt ERST NACH dem Blockieren, obwohl er
// mit 0ms Wartezeit geplant war! In einem Event-Loop-Modell blockiert JEDE
// lang laufende, synchrone Berechnung ALLES andere - es gibt keinen "zweiten
// Thread", der parallel weiterlaufen könnte.

// Merksatz: Event-Loop = ein Koch in einer Küche, der zwischen mehreren
// Gerichten hin- und herspringt, während er wartet (Wasser kocht, Ofen
// heizt vor) - aber niemals zwei Dinge GLEICHZEITIG in der Hand hat.


// ------------------------------------------------------------------
// Modell 2: Echtes Threading (z.B. C#, Java)
// ------------------------------------------------------------------
// Sprachen wie C# oder Java können ECHTE Threads starten - mehrere
// Ausführungsstränge, die von der CPU tatsächlich PARALLEL (auf mehreren
// Kernen) abgearbeitet werden können. Nur zur Einordnung, nicht ausführbar:
//
//   Thread thread = new Thread(() => {
//       Console.WriteLine("Läuft in einem ZWEITEN Thread");
//   });
//   thread.Start();
//   Console.WriteLine("Läuft gleichzeitig im Hauptthread");
//
// Der große Vorteil: eine lange Berechnung in Thread A blockiert NICHT
// Thread B. Der große Nachteil: SYNCHRONISATION wird nötig - wenn zwei
// Threads GLEICHZEITIG denselben Wert verändern wollen, kann ein "Race
// Condition" genanntes Problem entstehen (das Ergebnis hängt vom zufälligen
// Timing ab). Dafür gibt es "Locks"/"Mutexe": nur EIN Thread darf gerade
// einen bestimmten Codeabschnitt betreten, alle anderen warten.


// ------------------------------------------------------------------
// Modell 3: Multi-Prozess (klassisches PHP im Webserver-Betrieb)
// ------------------------------------------------------------------
// PHP-Skripte selbst laufen typischerweise KOMPLETT synchron, Zeile für
// Zeile, ohne eigenen Event-Loop UND ohne eigenes Threading. "Gleichzeitigkeit"
// entsteht bei PHP-Webanwendungen stattdessen auf einer ANDEREN Ebene: der
// Webserver (z.B. über PHP-FPM) startet für JEDE eingehende Anfrage einen
// eigenen, komplett unabhängigen PROZESS (oder nimmt einen bereits laufenden
// aus einem "Pool"). 100 gleichzeitige Nutzer:innen bedeuten 100 (weitgehend)
// unabhängige PHP-Prozesse, die sich nicht gegenseitig blockieren können.

// Merksatz: Event-Loop (JS) = ein Koch, der geschickt zwischen Aufgaben
// jongliert. Threading (C#/Java) = mehrere Köche in DERSELBEN Küche, die
// sich abstimmen müssen. Multi-Prozess (klassisches PHP) = mehrere
// komplett getrennte Küchen, die einander gar nicht sehen können.
