# Themenkonzept „IT-Systemtechnik / Fortgeschrittene Konzepte"

Nachfolge-Repo zu [Progrmmierung_Grundlagen](https://github.com/S4MT3K/Progrmmierung_Grundlagen) —
genau die "Fachunterricht/Stufe 2"-Themen (OOP, Exceptions, Algorithmen, Design
Patterns), die dort bewusst rausgehalten wurden, plus alles, was in Modul 7 der
Konzeption dazu draufsteht — bereinigt und erweitert.

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

## Korrekturen (Unsinn/zu Spezifisches raus)

| Fund in 7a.xx | Problem | Lösung |
|---|---|---|
| 7a.09 „Frameworks": White-Box \| Black-Box \| Bootstrap \| .NET Framework | White-Box/Black-Box sind TestARTEN, keine Frameworks — wurden einfach mit reingemischt | Sauber getrennt: Testarten (White-/Black-Box-Test) als eigener Punkt, echte Frameworks (Bootstrap, .NET, als Konzept "wiederverwendbares Grundgerüst") separat erklärt |
| 7a.11 „Das Interface Runable" | Java-spezifisches Detail (Typo bei „Runnable" im Original inklusive), für ein polyglottes Repo zu speziell | Rausgenommen, dafür allgemeines Nebenläufigkeits-Konzept (Threading vs. Event-Loop vs. Multi-Prozess) im Sprachvergleich |
| 7a.10 „ObjectOutputStream/ObjectInputStream", „Klasse Console", „Delta-Ausdrücke" | Java-API-Spezifika, nicht sprachübergreifend relevant | Rausgenommen, dafür JSON-Serialisierung als universelles, praxisrelevantes Beispiel (direkter Vorgriff auf REST-APIs) |
| 7a.03 „Paket-Hierarchie" | Java/C#-spezifisches Packaging-Konzept | Nur als kurzer Sprachvergleich (Namespaces) erwähnt, keine eigene Lektion |

## Neu aufgenommen (dein Wunsch)

- Komplexe Datentypen inkl. `null`/`undefined`/`Infinity`/`NaN` im Sprachvergleich
- Rekursion
- Callback-Funktionen
- Async/Await
- REST-APIs

## Beibehalten (dein Wunsch)

- UML (Klassen-, Objekt-, Sequenzdiagramme)
- PAP (Programmablaufplan)
- Struktogramm (Nassi-Shneiderman)

## Themenliste (Vorschlag, Sprache je nach bestem Fit — PHP/JS primär, C#/C++ wo sinnvoll)

| # | Thema | Sprache(n) | Herkunft |
|---|---|---|---|
| 01 | Komplexe Datentypen, `null`/`undefined`/`Infinity`/`NaN` im Vergleich | PHP + JS (+ C#) | neu |
| 02 | OOP Grundlagen: Klassen, Methoden, Konstruktoren, Getter/Setter | PHP | 7a.03 |
| 03 | OOP vertieft: Kapselung, Polymorphie, OOA/OOD/OOP | PHP | 7a.04 |
| 04 | OOP erweitert: Vererbung, Interfaces, abstrakte Klassen | PHP + C# | 7a.05 (bereinigt) |
| 05 | UML, PAP, Struktogramm | sprachunabhängig + PHP | 7a.06 |
| 06 | Exception-Handling: try/catch/throw, eigene Exceptions | PHP | 7a.08 |
| 07 | Rekursion | PHP + JS | neu |
| 08 | Callback-Funktionen | JS + PHP | neu |
| 09 | Async/Await | JS (+ C#-Vergleich) | neu |
| 10 | Nebenläufigkeit: Threading vs. Event-Loop vs. Multi-Prozess | C# + JS (konzeptionell) | 7a.11 (bereinigt) |
| 11 | Serialisierung: JSON (& Dateiverarbeitung) | PHP + JS | 7a.10 (bereinigt) |
| 12 | REST-APIs | JS (fetch) + PHP (curl) | neu |
| 13 | GUI Grundlagen (konzeptionell) | C# | 7a.12 |
| 14 | Algorithmen & Design Patterns: Sortieralgorithmen, MVC, 3-Schichten-Architektur | PHP | 7a.13 |
| 15 | Testarten (White-/Black-Box) & echte Frameworks | konzeptionell + PHP | 7a.09 (bereinigt) |

**Bewusst weggelassen:** Modul-Verwaltungskram (7a.01 Kursmaterialien/IDE-Setup,
7a.14 Modulauswertung) — organisatorisch, kein Lerninhalt.

## Offene Frage an dich

Passt die Reihenfolge/Sprachwahl so, oder soll ich was tauschen (z.B. Exception-Handling
vor OOP, weil einfacher)? Sobald das steht, schreibe ich die Lektionen.
