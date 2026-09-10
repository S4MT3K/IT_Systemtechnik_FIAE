// ========================================================================
// SERIALISIERUNG: JSON (JavaScript)
// ========================================================================
// JavaScript und JSON sind eng verwandt (der Name kommt von "JavaScript
// Object Notation") - die eingebauten Funktionen heißen deshalb nicht
// json_encode/json_decode wie in PHP, sondern JSON.stringify()/JSON.parse().

const nutzer = {
    name: "Max",
    alter: 25,
    hobbys: ["Lesen", "Programmieren"],
};

const json = JSON.stringify(nutzer); // Objekt -> JSON-String
console.log(json);
// {"name":"Max","alter":25,"hobbys":["Lesen","Programmieren"]}

const zurueck = JSON.parse(json); // JSON-String -> Objekt
console.log(zurueck.hobbys[1]); // Programmieren


// ------------------------------------------------------------------
// Lesbar formatiertes JSON (praktisch beim Debuggen)
// ------------------------------------------------------------------
// JSON.stringify() akzeptiert zwei weitere Parameter: einen optionalen
// Filter (hier: null = alle Felder) und die Einrückungstiefe:

const schoenFormatiert = JSON.stringify(nutzer, null, 2);
console.log(schoenFormatiert);
// {
//   "name": "Max",
//   "alter": 25,
//   "hobbys": [
//     "Lesen",
//     "Programmieren"
//   ]
// }

// Merksatz: JSON ist der gemeinsame Nenner zwischen JavaScript (Frontend/
// Browser) und PHP (Backend/Server, siehe .php-Datei) - genau deswegen ist
// es das Standardformat für REST-APIs (siehe eigene Notiz): das Backend
// serialisiert seine PHP-Arrays zu JSON, das Frontend deserialisiert
// dasselbe JSON wieder zu JavaScript-Objekten.
