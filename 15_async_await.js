// ========================================================================
// ASYNC/AWAIT
// ========================================================================
// Manche Aktionen brauchen ZEIT: eine Netzwerk-Anfrage (siehe REST-API-Notiz),
// eine Datei lesen, eine Wartezeit. JavaScript blockiert dabei NICHT das
// ganze Programm (siehe Nebenläufigkeits-Notiz: Single-Threaded Event Loop),
// sondern arbeitet mit sogenannten Promises - "Versprechen" auf ein
// Ergebnis, das irgendwann in der Zukunft ankommt.

// ------------------------------------------------------------------
// Ein Promise von Hand erzeugen (zum Verstehen, nicht der Alltag)
// ------------------------------------------------------------------
function warte(millisekunden, wert) {
    return new Promise((resolve) => {
        setTimeout(() => resolve(wert), millisekunden);
        // resolve(...) heißt: "das Versprechen ist eingelöst, hier ist das Ergebnis"
    });
}

// Die "alte" Art, ein Promise zu nutzen: .then()
warte(10, "Ergebnis A").then((wert) => console.log("then():", wert));


// ------------------------------------------------------------------
// async/await - dasselbe, aber liest sich wie normaler, synchroner Code
// ------------------------------------------------------------------
// "async" vor einer Funktion sagt: "diese Funktion gibt immer ein Promise
// zurück". "await" davor pausiert NUR diese Funktion (nicht das ganze
// Programm!), bis das Promise eingelöst ist.

async function holeDaten() {
    console.log("1: vor dem await");
    const wert = await warte(10, "Ergebnis B"); // wartet hier auf das Ergebnis
    console.log("3: nach dem await:", wert);
    return wert;
}

holeDaten().then((ergebnis) => console.log("Rückgabewert:", ergebnis));
console.log("2: läuft SOFORT weiter, wartet NICHT auf holeDaten()");

// Reihenfolge der Ausgabe: 1, 2, dann erst (später) 3 - der Rest des
// Programms wird NICHT blockiert, während holeDaten() wartet.


// ------------------------------------------------------------------
// Fehlerbehandlung bei async/await - dieselbe Syntax wie sonst (Lektion 08!)
// ------------------------------------------------------------------
function schlaegtFehl() {
    return new Promise((resolve, reject) => {
        setTimeout(() => reject(new Error("Simulierter Fehler")), 5);
        // reject(...) heißt: "das Versprechen wurde NICHT eingelöst, Fehler!"
    });
}

async function testFehlerbehandlung() {
    try {
        await schlaegtFehl();
    } catch (fehler) {
        console.log("Abgefangen:", fehler.message);
    }
}
testFehlerbehandlung();

// Merksatz: try/catch funktioniert bei await GENAUSO wie bei normalem,
// synchronem Code (siehe Exception-Handling-Notiz) - das ist der große
// Vorteil von async/await gegenüber der älteren .then()/.catch()-Syntax.


// ------------------------------------------------------------------
// Mehrere asynchrone Dinge GLEICHZEITIG abwarten - Promise.all()
// ------------------------------------------------------------------
async function mehrereGleichzeitig() {
    // Beide "warte()"-Aufrufe starten SOFORT gleichzeitig, statt nacheinander:
    const [ergebnisA, ergebnisB] = await Promise.all([
        warte(10, "X"),
        warte(5, "Y"),
    ]);
    console.log("Promise.all:", ergebnisA, ergebnisB);
}
mehrereGleichzeitig();

// Merksatz: await NACHEINANDER (zwei separate await-Zeilen) würde die
// Wartezeiten AUFADDIEREN. Promise.all() lässt sie PARALLEL laufen - bei
// unabhängigen Aktionen (z.B. zwei verschiedene API-Anfragen) fast immer
// die bessere Wahl.
