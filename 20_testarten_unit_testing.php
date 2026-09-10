<?php
// ========================================================================
// TESTARTEN (White-/Black-Box) & ECHTES UNIT-TESTING
// ========================================================================
// Frameworks sind fertige, wiederverwendbare Grundgerüste für Software
// (z.B. Bootstrap für CSS-Layouts, .NET für ganze Anwendungen) - Testarten
// wie White-Box und Black-Box sind dagegen etwas KOMPLETT anderes: Methoden,
// WIE man Software prüft. (Diese Verwechslung stand tatsächlich in der
// Original-Konzeption drin - deswegen hier bewusst sauber getrennt.)

// ------------------------------------------------------------------
// Black-Box-Test - nur die AUSSENSEITE testen
// ------------------------------------------------------------------
// Man kennt die interne Umsetzung NICHT (oder ignoriert sie bewusst) und
// prüft nur: "kommt bei bestimmten Eingaben das erwartete Ergebnis raus?" -
// wie bei einem Taschenrechner, den man testet, ohne die Elektronik zu kennen.

function istVolljaehrig(int $alter): bool
{
    return $alter >= 18;
}
// Black-Box-Test: probiere verschiedene Eingaben durch, OHNE den Code-Inhalt
// zu betrachten - nur ob das ERGEBNIS stimmt.


// ------------------------------------------------------------------
// White-Box-Test - die INTERNE Logik mitdenken
// ------------------------------------------------------------------
// Man kennt den Code UND testet gezielt jeden einzelnen Zweig/jede
// Bedingung darin (siehe Kontrollstrukturen aus Programmiergrundlagen) -
// z.B. bei einer if/elseif/else-Kette JEDEN der drei Zweige mindestens
// einmal durchlaufen lassen, nicht nur "irgendeinen".


// ------------------------------------------------------------------
// Echtes Unit-Testing - Tests, die man WIEDERHOLBAR ausführen kann
// ------------------------------------------------------------------
// Ein "Unit-Test" prüft eine EINZELNE, kleine Funktionseinheit (meist eine
// Funktion) automatisch, statt sie manuell im Browser/Terminal durchzuklicken.
// Professionell nutzt man dafür ein Test-Framework wie PHPUnit (installiert
// per Composer, siehe Dependency-Management-Notiz). Bevor wir das
// installieren, bauen wir das PRINZIP hier von Hand nach, um es zu verstehen:

function addiere(int $a, int $b): int
{
    return $a + $b;
}

// Ein winziger, selbstgebauter "Test-Runner": vergleicht erwarteten und
// tatsächlichen Wert, meldet PASS oder FAIL - genau das, was PHPUnit später
// automatisch für dich übernimmt.
function pruefeGleich(mixed $erwartet, mixed $tatsaechlich, string $testName): void
{
    if ($erwartet === $tatsaechlich) {
        echo "✓ PASS: $testName";
    } else {
        echo "✗ FAIL: $testName (erwartet: " . var_export($erwartet, true)
            . ", bekommen: " . var_export($tatsaechlich, true) . ")";
    }
    echo "<br>";
}

pruefeGleich(5, addiere(2, 3), "addiere(2, 3) sollte 5 ergeben");
pruefeGleich(0, addiere(-5, 5), "addiere(-5, 5) sollte 0 ergeben");
pruefeGleich(10, addiere(2, 3), "absichtlich falscher Test, zur Demo");


// ------------------------------------------------------------------
// Die Grundidee von TDD (Test-Driven Development)
// ------------------------------------------------------------------
// Statt erst den Code UND DANACH einen Test zu schreiben, dreht TDD die
// Reihenfolge um:
//
//   1. RED:   Schreibe zuerst einen Test für eine Funktion, die es noch
//             gar nicht gibt - der Test schlägt logischerweise fehl.
//   2. GREEN: Schreibe die EINFACHSTE mögliche Umsetzung, die den Test
//             bestehen lässt - nicht mehr, nicht weniger.
//   3. REFACTOR: Räume den Code jetzt sauber auf (siehe Clean-Code-Notiz),
//             OHNE dass die Tests dabei kaputtgehen - sie garantieren dir,
//             dass du beim Aufräumen nichts kaputt machst.
//
// Merksatz: Der eigentliche Wert von Tests zeigt sich nicht beim ERSTEN
// Schreiben, sondern SPÄTER: wenn du Monate danach etwas am Code änderst,
// sagen dir die Tests SOFORT, ob du versehentlich etwas kaputt gemacht hast
// - ohne dass du die ganze Anwendung von Hand durchklicken musst.
