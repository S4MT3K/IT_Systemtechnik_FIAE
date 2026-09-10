<?php
// ========================================================================
// UML, PAP & STRUKTOGRAMM - AUFBAUEND AUF PROGRAMMIERGRUNDLAGEN
// ========================================================================
// PAP und Struktogramm kennst du schon aus Programmiergrundlagen (dort für
// einfache Verzweigungen/Schleifen). Hier kommt UML dazu - das Werkzeug, um
// GANZE KLASSEN und ihre BEZIEHUNGEN zueinander zu planen, nicht nur den
// Ablauf EINER Funktion.

// ------------------------------------------------------------------
// UML-Klassendiagramm - der Bauplan für unsere OOP-Klassen (Lektion 05)
// ------------------------------------------------------------------
// Ein Klassendiagramm zeigt: Klassenname, Eigenschaften (mit Sichtbarkeit
// und Typ), Methoden (mit Parametern und Rückgabetyp), und die BEZIEHUNGEN
// zwischen den Klassen. Sichtbarkeits-Symbole: + public, - private, # protected
//
//   ┌────────────────────────────┐
//   │       <<abstract>>          │
//   │           Vogel              │
//   ├────────────────────────────┤
//   │ # name: string                │
//   ├────────────────────────────┤
//   │ + machGeraeusch(): string      │  <- abstrakt, kursiv im echten UML
//   │ + vorstellen(): string          │
//   └──────────────┬──────────────┘
//                  │  (durchgezogener Pfeil mit hohler Spitze = VERERBUNG)
//                  │
//   ┌──────────────▼──────────────┐         ┌ ─ ─ ─ ─ ─ ─ ─ ─ ─ ┐
//   │           Papagei             │╌╌╌╌╌╌╌╌╌▷│  <<interface>>    │
//   ├────────────────────────────┤         │    Fliegbar         │
//   │ + machGeraeusch(): string      │         ├ ─ ─ ─ ─ ─ ─ ─ ─ ─ ┤
//   │ + fliege(): string              │         │ + fliege(): string │
//   └────────────────────────────┘         └ ─ ─ ─ ─ ─ ─ ─ ─ ─ ┘
//   (gestrichelter Pfeil mit hohler Spitze = INTERFACE-IMPLEMENTIERUNG)
//
// **Beziehungsarten, die man kennen sollte:**
// - Vererbung (durchgezogen, hohle Pfeilspitze): "IST EIN" - Papagei IST EIN Vogel
// - Interface-Implementierung (gestrichelt, hohle Pfeilspitze): "VERSPRICHT" -
//   Papagei VERSPRICHT, fliegbar zu sein
// - Assoziation (einfache Linie): zwei Klassen KENNEN sich, z.B. "Konto" kennt
//   "Kunde" (Konto hat ein Attribut vom Typ Kunde)
// - Aggregation (Linie mit hohler Raute): "HAT EIN", aber Teile können auch
//   OHNE das Ganze existieren, z.B. "Orchester" hat "Musiker" - Musiker
//   existieren auch außerhalb des Orchesters
// - Komposition (Linie mit gefüllter Raute): "HAT EIN" UND die Teile können
//   NICHT ohne das Ganze existieren, z.B. "Haus" hat "Zimmer" - ein Zimmer
//   ohne Haus ergibt keinen Sinn
//
// **Unterschied Attribut vs. Assoziation:** Ein Attribut ist ein einfacher
// Wert (`string $name`), eine Assoziation ist ein Verweis auf ein ANDERES
// Objekt (`Kunde $besitzer`) - beides steht im Klassendiagramm im
// Eigenschaften-Bereich, aber eine Assoziation wird zusätzlich als eigene
// Linie zwischen den beiden Klassen gezeichnet.


// ------------------------------------------------------------------
// UML-Sequenzdiagramm - zeigt den zeitlichen ABLAUF von Methodenaufrufen
// ------------------------------------------------------------------
// Während das Klassendiagramm die STATISCHE Struktur zeigt (welche Klassen
// gibt es), zeigt ein Sequenzdiagramm den DYNAMISCHEN Ablauf: wer ruft wann
// wen auf. Zeit läuft von oben nach unten:
//
//   Kunde              Bestellung          Lager
//     │                     │                 │
//     │─── bestellen() ────▶│                 │
//     │                     │──prüfeBestand()▶│
//     │                     │◀──── true ──────│
//     │◀── Bestätigung ─────│                 │
//
// Praktisch, um zu planen, WIE mehrere Objekte zusammenarbeiten, bevor man
// den Code schreibt.


// ------------------------------------------------------------------
// Use-Case-Diagramm - WER kann WAS mit dem System tun
// ------------------------------------------------------------------
// Die einfachste UML-Diagrammart: ein Strichmännchen (Akteur) verbunden mit
// Ovalen (Anwendungsfällen):
//
//   (Kunde) ────── (Produkt bestellen)
//      │
//      └────────── (Bestellstatus einsehen)
//
// Praktisch ganz am ANFANG eines Projekts (in der OOA-Phase, siehe Lektion 04),
// um grob abzustecken, was das System überhaupt können muss - noch bevor man
// über Klassen nachdenkt.


// ------------------------------------------------------------------
// Kurzer Rückblick: PAP & Struktogramm (Details siehe Programmiergrundlagen)
// ------------------------------------------------------------------
// PAP (Programmablaufplan) und Struktogramm planen den Ablauf INNERHALB
// einer einzelnen Methode - z.B. wie `machGeraeusch()` intern entscheidet,
// was es zurückgibt. UML-Diagramme planen dagegen die Struktur ZWISCHEN
// mehreren Klassen. Beide Ebenen ergänzen sich: UML für die große Architektur,
// PAP/Struktogramm für die Details einer einzelnen Methode.

echo "Siehe Kommentare oben - diese Lektion ist bewusst diagrammlastig.";
