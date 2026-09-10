# Themenkonzept „IT-Systemtechnik / Fortgeschrittene Konzepte"

Nachfolge-Repo zu [Progrmmierung_Grundlagen](https://github.com/S4MT3K/Progrmmierung_Grundlagen) —
genau die "Fachunterricht/Stufe 2"-Themen (OOP, Exceptions, Algorithmen, Design
Patterns), die dort bewusst rausgehalten wurden, plus alles, was in Modul 7 der
Konzeption dazu draufsteht — bereinigt und erweitert um das, was einen guten
Programmierer wirklich ausmacht, nicht nur was die Konzeption zufällig auflistet.

## Quelle & Abgleich

- `Konzeption u-FIAE_B_NRW_korrigiert.pdf`, **Modul 7: IT-Systemtechnik (360 UE)**,
  Punkte 7a.01–7a.14.
- **Auffällig:** Modul 7 ist inhaltlich zu ~95% identisch mit Modul 9 „Fachunterricht
  Anwendungsentwicklung" (540 UE) aus der Programmiergrundlagen-Recherche — offenbar
  derselbe Inhaltsblock einfach zweimal verwendet, nur ohne den Projektarbeit-Punkt
  am Ende. Kein Einzelfehler mehr, sondern ein Muster in diesem Dokument.
- **KMK-Rahmenlehrplan-Anker:** Lernfeld 11a „Funktionalität in Anwendungen
  realisieren" (3. Ausbildungsjahr, Vertiefung Anwendungsentwicklung) — passt am
  besten zur Kompetenzbeschreibung (modulare Softwarekomponenten entwickeln,
  Qualität sichern, Testfälle formulieren).
- **Diesmal bewusst NICHT nur curriculum-getrieben**: die Konzeption listet Werkzeuge
  und Sprachfeatures auf, sagt aber wenig darüber, was einen Entwickler tatsächlich
  BESSER macht (Code-Qualität, Datenstrukturen, Effizienz, Sicherheit, Werkzeuge des
  Alltags). Diese Lücken sind unten explizit ergänzt.

## Korrekturen (Unsinn/zu Spezifisches raus)

| Fund in 7a.xx | Problem | Lösung |
|---|---|---|
| 7a.09 „Frameworks": White-Box \| Black-Box \| Bootstrap \| .NET Framework | White-Box/Black-Box sind TestARTEN, keine Frameworks — wurden einfach mit reingemischt | Sauber getrennt: Testarten als eigener, ausgebauter Punkt (inkl. echtem Unit-Testing), echte Frameworks separat als Konzept erklärt |
| 7a.11 „Das Interface Runable" | Java-spezifisches Detail (Typo bei „Runnable" im Original inklusive), für ein polyglottes Repo zu speziell | Rausgenommen, dafür allgemeines Nebenläufigkeits-Konzept (Threading vs. Event-Loop vs. Multi-Prozess) im Sprachvergleich |
| 7a.10 „ObjectOutputStream/ObjectInputStream", „Klasse Console", „Delta-Ausdrücke" | Java-API-Spezifika, nicht sprachübergreifend relevant | Rausgenommen, dafür JSON-Serialisierung als universelles, praxisrelevantes Beispiel (direkter Vorgriff auf REST-APIs) |
| 7a.03 „Paket-Hierarchie" | Java/C#-spezifisches Packaging-Konzept | Nur als kurzer Sprachvergleich (Namespaces) erwähnt, keine eigene Lektion |

## Neu aufgenommen — dein ursprünglicher Wunsch

- Komplexe Datentypen inkl. `null`/`undefined`/`Infinity`/`NaN` im Sprachvergleich
- Rekursion
- Callback-Funktionen
- Async/Await
- REST-APIs

## Neu aufgenommen — didaktischer Mehrwert, nicht in der Konzeption

Dinge, die kein Curriculum-Dokument explizit fordert, die aber den Unterschied
zwischen "kann Code schreiben, der läuft" und "ist ein guter Programmierer" ausmachen:

- **Datenstrukturen** (Stack, Queue, Linked List, Hash Map) — die Bausteine, aus
  denen so gut wie jeder Algorithmus besteht, nicht nur PHP-Arrays.
- **Big-O-Notation / Algorithmuskomplexität** — WARUM eine Lösung bei 10 Einträgen
  schnell ist und bei 10 Millionen einbricht. Ohne das versteht man Performance-
  Probleme nie wirklich.
- **Clean Code & SOLID-Prinzipien** — Naming, DRY, KISS, Single Responsibility &
  Co. Der Unterschied zwischen Code, den nur du selbst noch verstehst, und Code,
  den ein Team pflegen kann.
- **Echtes Unit-Testing** (statt nur der Begriffe White-/Black-Box): eine Testbibliothek
  benutzen, Assertions schreiben, die Grundidee von TDD.
- **Typsicherheit** — PHP Type Hints & `strict_types`, kurzer TypeScript-Ausblick.
  Direkter Gegenpol zum Type-Juggling-Problem aus Programmiergrundlagen.
- **Funktionale Konzepte**: `map`/`filter`/`reduce`, Pure Functions, Immutability —
  Ergänzung zu Callbacks, heute in praktisch jeder Sprache relevant.
- **Sichere Programmierung**: SQL-Injection, XSS, Passwort-Hashing, Input-Validierung
  — der praktische Gegenpart zur bürokratischen "Schutzbedarfsanalyse", die wir aus
  Programmiergrundlagen rausgehalten haben. Hier gehört es hin.
- **Logging** statt nur `var_dump`/`die()` — Log-Level, wohin Logs gehören, warum
  man in echten Projekten nicht mit Debug-Ausgaben arbeitet.
- **Git vertieft**: Branching-Strategien, Merge-Konflikte lösen, Pull-Request-Workflow
  — in Programmiergrundlagen bewusst nur OneNote-Stoff, hier aber Kernkompetenz.
- **Dependency Management**: Composer (PHP) / npm (JS) — wie man fremde Bibliotheken
  einbindet, statt alles selbst zu schreiben.

## Beibehalten — dein Wunsch

- UML (Klassen-, Objekt-, Sequenzdiagramme)
- PAP (Programmablaufplan)
- Struktogramm (Nassi-Shneiderman)

## Themenliste (überarbeiteter Vorschlag)

| # | Thema | Sprache(n) | Herkunft |
|---|---|---|---|
| 01 | Komplexe Datentypen, `null`/`undefined`/`Infinity`/`NaN` im Vergleich | PHP + JS (+ C#) | neu (dein Wunsch) |
| 02 | Typsicherheit: PHP Type Hints/`strict_types`, TypeScript-Ausblick | PHP + TS | neu (didaktisch) |
| 03 | OOP Grundlagen: Klassen, Methoden, Konstruktoren, Getter/Setter | PHP | 7a.03 |
| 04 | OOP vertieft: Kapselung, Polymorphie, OOA/OOD/OOP | PHP | 7a.04 |
| 05 | OOP erweitert: Vererbung, Interfaces, abstrakte Klassen | PHP + C# | 7a.05 (bereinigt) |
| 06 | Clean Code & SOLID-Prinzipien | PHP | neu (didaktisch) |
| 07 | UML, PAP, Struktogramm | sprachunabhängig + PHP | 7a.06 |
| 08 | Exception-Handling: try/catch/throw, eigene Exceptions | PHP | 7a.08 |
| 09 | Datenstrukturen: Stack, Queue, Linked List, Hash Map | PHP | neu (didaktisch) |
| 10 | Algorithmen & Design Patterns: Sortieralgorithmen, MVC, 3-Schichten-Architektur | PHP | 7a.13 |
| 11 | Big-O-Notation / Algorithmuskomplexität | PHP | neu (didaktisch) |
| 12 | Rekursion | PHP + JS | neu (dein Wunsch) |
| 13 | Callback-Funktionen | JS + PHP | neu (dein Wunsch) |
| 14 | Funktionale Konzepte: map/filter/reduce, Pure Functions | JS + PHP | neu (didaktisch) |
| 15 | Async/Await | JS (+ C#-Vergleich) | neu (dein Wunsch) |
| 16 | Nebenläufigkeit: Threading vs. Event-Loop vs. Multi-Prozess | C# + JS (konzeptionell) | 7a.11 (bereinigt) |
| 17 | Serialisierung: JSON (& Dateiverarbeitung) | PHP + JS | 7a.10 (bereinigt) |
| 18 | REST-APIs | JS (fetch) + PHP (curl) | neu (dein Wunsch) |
| 19 | Sichere Programmierung: SQL-Injection, XSS, Passwort-Hashing | PHP | neu (didaktisch) |
| 20 | Testarten (White-/Black-Box) & echtes Unit-Testing | PHP (PHPUnit-Grundidee) | 7a.09 (bereinigt + erweitert) |
| 21 | Logging statt var_dump/die | PHP | neu (didaktisch) |
| 22 | GUI Grundlagen (konzeptionell) | C# | 7a.12 |
| 23 | Git vertieft: Branching, Merge-Konflikte, PR-Workflow | — (Konzept) | neu (didaktisch) |
| 24 | Dependency Management: Composer/npm | PHP/JS (Konzept) | neu (didaktisch) |

**Bewusst weggelassen:** Modul-Verwaltungskram (7a.01 Kursmaterialien/IDE-Setup,
7a.14 Modulauswertung) — organisatorisch, kein Lerninhalt.

## Offene Fragen an dich

1. 24 Themen ist deutlich mehr als die ursprünglichen 15 — passt der Umfang, oder
   sollen wir etwas kürzen/auf später verschieben (z.B. 23/24 als optional markieren)?
2. Reihenfolge/Sprachwahl so ok, oder soll ich was tauschen?

Sobald das steht, schreibe ich die Lektionen.
