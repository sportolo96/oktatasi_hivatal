# Felvételi Pontszámítás API - Dokumentáció

### Bevezetés

Ez a projekt az Oktatási Hivatal számára készült vezető PHP fejlesztői tesztfeladat részeként. A fejlesztés során a **Test-Driven Development (TDD)** módszertanát alkalmaztam, hogy biztosítsam a kód megbízhatóságát és karbantarthatóságát. Első lépésként a tesztek kerültek megírásra, majd az ezek által definiált követelményeket kielégítő szolgáltatások implementálása következett.

### Fejlesztési Elvek

A projekt során kiemelt figyelmet fordítottam a következőkre:

- **Tiszta kód**: A kód könnyen érthető, karbantartható és újrafelhasználható.
- **Modularitás**: Az alkalmazás logikája könnyen bővíthető.
- **Automatizált tesztelés**: A stabilitás biztosítása érdekében minden alapvető funkcióhoz automatizált tesztek készültek.

## Fejlesztési Folyamat

1. **Tesztvezérelt Fejlesztés (TDD):**
    - Első lépésként az összes szükséges tesztet megírtam a várható funkciókhoz és viselkedéshez.
    - A tesztek lefedik az alapvető pontszámítási szabályokat, a hibakezelést és a különböző érettségi tárgytípusokat.

2. **Funkcionalitás Implementálása:**
    - Az elkészült tesztek alapján implementáltam azokat a szolgáltatásokat, amelyek biztosítják a rendszer működését.
    - Az implementáció során ügyeltem a kód letisztultságára és újrahasznosíthatóságára.

3. **Tesztelés és Ellenőrzés:**
    - Az elkészült kódot folyamatosan teszteltem a `php artisan test` parancs segítségével.
    - Az adatbázishoz egy SQLite alapértelmezett adatbázist használtam, amely könnyen konfigurálható és gyors tesztelési lehetőséget biztosít.

## Technológiai Stack

- **PHP 8.2**
- **Laravel 11**
- **SQLite** az alapértelmezett adatbázishoz
- **TDD (Tesztvezérelt Fejlesztés)**
- **PHPUnit** a teszteléshez
- **Seeder-ek** az alapadatok betöltéséhez
- **Postman** az API hívások manuális tesztelésére
- **Git** verziókezeléshez
- **Valet** szerverkörnyezet
- **macOS** operációs rendszer

### API Funkcionalitás

A projekt keretében létrehoztam egy teszt API-t, amely a `api/calculat` végponton érhető el. Az API POST kérések fogadására alkalmas, az alábbi JSON struktúrát várva:

```json
{
    "valasztott-szak": {
        "egyetem": "PPKE",
        "kar": "BTK",
        "szak": "Anglisztika"
    },
    "erettsegi-eredmenyek": [
        {
            "nev": "magyar nyelv és irodalom",
            "tipus": "közép",
            "eredmeny": "70%"
        },
        {
            "nev": "történelem",
            "tipus": "közép",
            "eredmeny": "80%"
        },
        {
            "nev": "matematika",
            "tipus": "közép",
            "eredmeny": "90%"
        },
        {
            "nev": "angol",
            "tipus": "emelt",
            "eredmeny": "94%"
        },
        {
            "nev": "kémia",
            "tipus": "közép",
            "eredmeny": "95%"
        }
    ],
    "tobbletpontok": [
        {
            "kategoria": "Nyelvvizsga",
            "tipus": "B2",
            "nyelv": "angol"
        },
        {
            "kategoria": "Nyelvvizsga",
            "tipus": "C1",
            "nyelv": "angol"
        }
    ]
}
```

### Válasz Példa

Sikeres hívás esetén a válasz a következő formátumban érkezik:

```json
{
    "osszpontszam": 438
}
```

### Tesztelés

Az alkalmazás funkcionalitásának tesztelésére a Laravel beépített tesztelési keretrendszerét használtam. A tesztek futtatásához az alábbi parancs használható:

```bash
php artisan test
```

### Adatbázis

A projekt SQLite adatbázist használ, amely a `database` mappában található. Az alapvető felvételi adatok betöltéséhez egy seeder-t készítettem, amely az alábbi parancs futtatásával érhető el:

```bash
php artisan db:seed
```

### Telepítés és Futás

1. Klónozza a projektet a GitHub-ról:
    ```bash
    git clone <repository-url>
    ```

2. Telepítse a szükséges csomagokat:
    ```bash
    composer install
    ```

3. Hozzon létre egy `.env` fájlt az `.env.example` alapján, majd állítsa be az `APP_KEY`-t a következő parancsal.
    ```bash
    php artisan key:generate
    ```

4. Migrálja az adatbázist:
    ```bash
    php artisan migrate
    ```

5. Töltse be az alapadatokat:
    ```bash
    php artisan db:seed
    ```

6. Indítsa el a fejlesztői szervert amennyiben szükséges:
    ```bash
    php artisan serve
    ```

### Licenc

Ez a projekt az Oktatási Hivatal számára készült tesztfeladat, és nem használható fel kereskedelmi célokra vagy más projektekben az engedélyük nélkül.

### Közreműködés

A kód minőségének fenntartása érdekében minden hozzájárulás szívesen fogadott, de a változtatások előtt kérjük, vegye fel a kapcsolatot a projekt adminisztrátorával.

---

Amennyiben bármilyen kérdése lenne a projekttel kapcsolatban, kérem, keressen bizalommal!

bicskei.daniel96@gmail.com
