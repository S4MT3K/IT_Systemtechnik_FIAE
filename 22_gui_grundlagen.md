# GUI Grundlagen (konzeptionell)

*Kein .NET SDK in dieser Umgebung installiert - deswegen als Markdown-Notiz mit
Code-Beispielen statt als ausführbare `.cs`-Datei. Das Prinzip ist aber überall
(WinForms/WPF in C#, Swing/JavaFX in Java, sogar HTML/CSS im Browser) identisch.*

## Einleitung

Bisher haben unsere Programme nur Text ausgegeben (`echo`/`console.log`). Ein GUI
(Graphical User Interface) zeigt stattdessen Fenster, Buttons, Textfelder - alles,
was man mit der Maus anklicken kann, statt es zu tippen.

## Einstieg in die Graphische Programmierung

Der fundamentale Unterschied zu allem bisher Gelernten: ein GUI-Programm läuft nicht
einfach "von oben nach unten durch und ist fertig" - es WARTET die meiste Zeit und
reagiert nur, WENN der Nutzer etwas tut. Das nennt man ereignisgesteuerte
Programmierung (Event-Driven Programming).

```csharp
// C# mit Windows Forms - nur zur Einordnung, nicht ausführbar (kein SDK hier)
var fenster = new Form { Text = "Mein erstes Fenster" };
var knopf = new Button { Text = "Klick mich!" };

// Event-Handler: eine Callback-Funktion (siehe eigene Notiz!), die läuft,
// WENN der Button geklickt wird - nicht vorher, nicht "irgendwann automatisch"
knopf.Click += (sender, e) => MessageBox.Show("Geklickt!");

fenster.Controls.Add(knopf);
Application.Run(fenster); // startet die "Event Loop" des Fensters (siehe
                          // Nebenläufigkeits-Notiz) und wartet auf Ereignisse
```

## Events (Ereignisse) & Event-Schnittstellen

Ein GUI-Element kann mehrere verschiedene Ereignisse auslösen: `Click` (Klick),
`MouseEnter`/`MouseLeave` (Maus rein/raus), `KeyPress` (Taste gedrückt), `TextChanged`
(Text geändert). Für jedes Ereignis registriert man eine Callback-Funktion - exakt
dasselbe Callback-Prinzip wie in der eigenen Callback-Notiz, nur dass hier NICHT der
Entwickler entscheidet, WANN die Funktion läuft, sondern der Nutzer per Mausklick.

## Layout Management

Wie werden mehrere GUI-Elemente auf dem Fenster ANGEORDNET, auch wenn der Nutzer das
Fenster in der Größe verändert? Layout-Manager (z.B. `FlowLayoutPanel`,
`TableLayoutPanel` in C#, oder Flexbox/Grid im Web) übernehmen automatisch die
Positionierung, statt dass man jedes Element auf feste Pixel-Koordinaten legen muss.

## GUI-Elemente im Überblick

Die üblichen Bausteine, die in praktisch jedem GUI-Framework wiederkehren:

- **Button** - klickbare Aktion auslösen
- **TextBox/Input** - Texteingabe
- **Label** - reiner Anzeigetext
- **CheckBox/RadioButton** - Ja/Nein bzw. Auswahl aus mehreren Optionen
- **ComboBox/Select** - Dropdown-Auswahlliste
- **ListView/Table** - Liste bzw. Tabelle von Einträgen

## Grundprinzip

GUI-Programmierung dreht das gewohnte "Programm läuft einmal durch"-Modell um: das
Programm WARTET dauerhaft und reagiert nur auf Ereignisse, die der Nutzer auslöst.
Genau das macht Event-Handler (= Callbacks) zum zentralen Baustein jeder GUI.

## Mini-Übung

1. Was passiert in einem GUI-Programm, wenn kein Ereignis eintritt?
2. Was ist ein Layout-Manager gut für?
3. Nenne zwei typische Events eines Buttons.

**Lösung:**
1. Das Programm wartet einfach weiter (Event Loop), es "hängt" nicht - es hat nur
   nichts zu tun, bis der Nutzer etwas tut.
2. Er ordnet GUI-Elemente automatisch an, auch bei sich ändernder Fenstergröße,
   statt feste Pixel-Koordinaten von Hand zu berechnen.
3. Z.B. `Click` (angeklickt) und `MouseEnter` (Maus fährt drüber).
