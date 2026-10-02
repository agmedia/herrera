# Digitalni XML/CSV cjenik za OpenCart 3.0.3.8

Modul generira aktualni XML i CSV cjenik te javno dostupnu arhivu prethodnih verzija. Datoteke fizički ostaju u `DIR_STORAGE/digital_pricelist`, a dohvaćaju se isključivo kroz read-only catalog rute. Modul je pripremljen prema zahtjevima NN 101/2026, uz odgođenu primjenu do 17. studenoga 2026.

## Instalacija

1. Prenesite sadržaj direktorija `upload/` u korijen OpenCarta.
2. U administraciji otvorite **Extensions > Extensions > Modules**.
3. Instalirajte i otvorite **Digitalni XML/CSV cjenik**.
4. Obvezno provjerite oblik, adresu i oznaku objekta, javnu B2C grupu kupaca te mapiranje atributa jedinice mjere i cijene po jedinici.
5. Spremite postavke i odaberite **Generiraj sada** za inicijalnu provjeru.

Adresa objekta pri instalaciji preuzima se iz OpenCart catalog URL-a (`HTTPS_CATALOG`, odnosno `HTTP_CATALOG`). Generator odbija izradu ako su oblik, adresa ili oznaka objekta prazni, pa ne može objaviti datoteku s generičkim placeholder identitetom.

Instalacija stvara samo vlastite tablice `digital_pricelist_run` i `digital_pricelist_archive` s aktivnim OpenCart prefiksom te dodaje access/modify prava grupi administratora koji instalira modul. Deinstalacija isključuje javne rute, ali namjerno ne briše postavke, evidenciju ni arhivu.

## Objavljeni podaci

Svaki proizvod sadrži:

- `product_id`, `product_code`, `sku` i `model`
- `name` i `brand`
- `unit_of_measure` i `unit_price` kada su primjenjivi i mapirani na OpenCart atribute
- `regular_price`, `current_price` i `retail_price` (MPC)
- `special_sale` i `special_sale_type`
- `anchor_price` i `anchor_reference_date`
- `barcode` (prva dostupna vrijednost redom EAN, UPC, JAN, ISBN, MPN)
- `availability_code`, tekst dostupnosti, lokalnu količinu, količinu kod dobavljača (ako postoji Herrera `suplierqty` kolona) i ukupnu raspoloživu količinu
- valutu, URL proizvoda i vrijeme zadnje izmjene.

Aktualna cijena prati OpenCart frontend logiku za anonimnog B2C kupca: prvo se uzima aktivni `product_discount` za količinu 1, a aktivni `product_special` ima prednost nad njim. Ne koristi se individualna cijena prijavljenog kupca, uključujući lokalnu `product_price_by_customer_id` prilagodbu. Proizvod je dostupan kada je aktivan, datum dostupnosti je nastupio i lokalna plus dobavljačka količina je veća od nule, odnosno kada mu je `subtract = 0`.

Jezik feeda bira se izričito u postavkama modula, pa ručno generiranje iz administracije i javno/cron generiranje uvijek daju iste nazive i atribute.

Sidrena cijena čita se iz tablice `${DB_PREFIX}product_anchor_price` koju stvara modul sidrenih cijena. Digitalni cjenik radi i prije instalacije tog modula; tada su polja sidrene cijene prazna.

## Javni URL-ovi

Rute ne zahtijevaju autentikaciju i namijenjene su i automatiziranim botovima:

```text
https://trgovina.example/index.php?route=extension/module/digital_pricelist/xml
https://trgovina.example/index.php?route=extension/module/digital_pricelist/csv
https://trgovina.example/index.php?route=extension/module/digital_pricelist/archives
```

`archives` vraća JSON popis javno dostupnih verzija. Svaka stavka sadrži read-only `url` za dohvat konkretne arhivske XML ili CSV datoteke. Ruta za preuzimanje prihvaća samo strogo provjeren naziv s popisa te ne otkriva fizičku storage putanju.

Stabilni XML/CSV URL-ovi vraćaju usklađen `Content-Disposition` naziv aktualne datoteke. Naziv aktualne i svake arhivske datoteke ima oblik:

```text
cjenik_{oblik-objekta}_{adresa}_{oznaka}_pohrana-000001_YYYYMMDD_HHMMSS.xml
cjenik_{oblik-objekta}_{adresa}_{oznaka}_pohrana-000001_YYYYMMDD_HHMMSS.csv
```

Prethodne verzije čuvaju se najmanje 30 dana. Veća vrijednost može se postaviti u administraciji.

## Dnevni raspored

Zakonski raspored traži ažuriranje radnim danom najkasnije do 08:00, a modul je podešen za traženo generiranje jednom dnevno. Preporučeni CLI cron pokreće se svaki dan u 07:30:

```cron
CRON_TZ=Europe/Zagreb
30 7 * * * /usr/bin/php /apsolutna/putanja/do/opencarta/system/cli/digital_pricelist.php
```

CLI način je preporučen jer ne izlaže tajni token u popisu procesa ili logu URL-ova. Cron raspoređivač i OpenCart na produkciji trebaju koristiti vremensku zonu `Europe/Zagreb`; ako hosting ne podržava `CRON_TZ`, istu zonu treba postaviti u njegovom sučelju za zakazane zadatke.

Ako hosting dopušta samo HTTP cron, koristite HTTPS URL prikazan u administraciji. Token se može poslati u query parametru ili, sigurnije, zaglavljem:

```sh
curl --fail --silent --show-error \
  -H 'X-Digital-Pricelist-Token: OVDJE_TOKEN' \
  'https://trgovina.example/index.php?route=extension/module/digital_pricelist/cron'
```

Generator koristi ekskluzivni file lock, tako da se paralelna pokretanja ne mogu preklapati. Zapisuje privremene datoteke u istom storage direktoriju, a XML, CSV i metapodatke objavljuje kao zaključani par s automatskim vraćanjem prethodne verzije ako zamjena ne uspije. Arhiviranje prvo koristi hard-link na istom storage volumenu (O(1)), a na hostovima koji ga ne podržavaju prelazi na streaming filesystem copy.

Javni URL-ovi samo čitaju zadnju uspješno objavljenu verziju: nikada ne pokreću skupo generiranje na anonimni GET, a prije prvog uspješnog generiranja vraćaju HTTP 503. Ruta pod kratkim shared lockom otvara stabilan file descriptor, zatim otpušta lock i struji taj snapshot. Zato spor bot ili download ne drži cijelu datoteku u PHP memoriji i ne odgađa sljedeću objavu. Odgovori podržavaju `HEAD` i `ETag`/HTTP 304.

## Veliki katalozi i kapacitet

Proizvodi se čitaju keyset paginacijom (`product_id > zadnji_id`) u paketima od 500, bez sporog `OFFSET`-a i bez učitavanja cijelog kataloga u memoriju. Svaki paket odmah se zapisuje u otvorene privremene XML/CSV datoteke, a brojač se povećava za svaki stvarno zapisan proizvod. Potrošnja memorije zato ostaje približno stalna i kod desetaka ili stotina tisuća artikala.

Za veliki katalog koristite CLI cron, uključujući prvo generiranje. Administratorski gumb **Generiraj sada** radi sinkrono u jednom HTTP zahtjevu pa ga proxy ili web-poslužitelj može vremenski prekinuti neovisno o PHP memory/time postavkama.

Minimalnih 30 dnevnih verzija znači približno 60 arhivskih datoteka (XML + CSV), uz aktualni par i privremeni par tijekom generiranja. Za storage planirajte najmanje `(prosječna veličina XML-a + CSV-a) × 32`, a preporučeno oko `× 35` radi promjene kataloga i sigurnosne rezerve. Hard-link uklanja privremeno dupliciranje stare aktualne verzije; fallback copy može kratkotrajno tražiti još jedan par datoteka.

## Operativna provjera

Nakon instalacije provjerite:

1. da ručno generiranje završi sa statusom `success`;
2. da javni XML i CSV URL vraćaju HTTP 200 bez prijave;
3. da je naziv preuzete datoteke usklađen s identitetom objekta;
4. da `archives` nakon drugog generiranja prikazuje prethodnu verziju i javni URL;
5. da cijena testnog proizvoda odgovara anonimnom frontend prikazu, uključujući aktivni discount/special i porez prema postavci trgovine;
6. da su jedinica mjere i cijena po jedinici popunjene samo za proizvode na koje se primjenjuju;
7. da cron završi prije 08:00 u vremenskoj zoni trgovine.

Generator bilježi posljednja pokretanja u administraciji, a tehničke pogreške generiranja ili javnog čitanja upisuju se i u standardni OpenCart error log.
