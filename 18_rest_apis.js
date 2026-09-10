// ========================================================================
// REST-APIS (JavaScript, mit fetch)
// ========================================================================
// Eine REST-API ist eine Schnittstelle, über die Programme per HTTP (dem
// Protokoll, das auch normale Webseiten ausliefert) Daten austauschen -
// meist in JSON (siehe Serialisierungs-Notiz). REST definiert dabei
// Konventionen, WELCHE HTTP-Methode für WELCHE Aktion benutzt wird:
//
//   GET    - Daten ABRUFEN, verändert nichts
//   POST   - NEUE Daten anlegen
//   PUT    - bestehende Daten KOMPLETT ersetzen
//   PATCH  - bestehende Daten TEILWEISE ändern
//   DELETE - Daten löschen
//
// Die Beispiele hier nutzen jsonplaceholder.typicode.com - eine öffentliche,
// extra für Lern-/Testzwecke bereitgestellte Fake-API (nichts wird wirklich
// dauerhaft gespeichert).

// ------------------------------------------------------------------
// GET - Daten abrufen
// ------------------------------------------------------------------
async function holeTodo() {
    const antwort = await fetch("https://jsonplaceholder.typicode.com/todos/1");
    console.log("Status:", antwort.status); // 200 = OK

    const daten = await antwort.json(); // JSON-Antwort einlesen (async!)
    console.log(daten);
    // { userId: 1, id: 1, title: 'delectus aut autem', completed: false }
}


// ------------------------------------------------------------------
// POST - neue Daten anlegen
// ------------------------------------------------------------------
async function erstelleTodo() {
    const antwort = await fetch("https://jsonplaceholder.typicode.com/todos", {
        method: "POST",
        headers: {
            "Content-Type": "application/json", // sagt dem Server: "hier kommt JSON"
        },
        body: JSON.stringify({ title: "Neue Aufgabe", completed: false }),
    });

    console.log("POST Status:", antwort.status); // 201 = Created

    const daten = await antwort.json();
    console.log(daten); // die Fake-API gibt das "erstellte" Objekt zurück
}


// ------------------------------------------------------------------
// Fehlerbehandlung - fetch() wirft KEINEN Fehler bei 404/500!
// ------------------------------------------------------------------
async function holeNichtVorhanden() {
    const antwort = await fetch("https://jsonplaceholder.typicode.com/todos/999999");
    // fetch() lehnt das Promise NUR bei echten Netzwerkfehlern ab (keine
    // Verbindung möglich) - einen HTTP-Fehlerstatus wie 404 muss man SELBST
    // prüfen, sonst merkt man ihn nicht:
    if (!antwort.ok) { // antwort.ok ist false bei Status 400-599
        console.log("Fehler! Status:", antwort.status);
        return;
    }
    console.log(await antwort.json());
}

(async () => {
    await holeTodo();
    await erstelleTodo();
    await holeNichtVorhanden();
})();

// Merksatz: fetch() gibt IMMER ein Promise zurück, das nur bei echten
// Verbindungsproblemen fehlschlägt - HTTP-Fehlercodes (404, 500, ...) muss
// man explizit über response.ok bzw. response.status selbst abfragen.
