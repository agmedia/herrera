# OpenCart 3.0.3.8 — cijene, digitalni cjenik, povrati i zakonsko jamstvo

Ovaj repozitorij sadrži četiri odvojena modula:

1. **Sidrene cijene** (`anchor_price`)
2. **Digitalni XML/CSV cjenik** (`digital_pricelist`)
3. **Povrati i jednostrani raskidi** (`legal_return`)
4. **Zakonsko jamstvo – najmanje 2 godine** (`legal_warranty`)

## Instalacija nakon objave koda

1. Objavite sadržaj direktorija `upload/` u postojeću OpenCart instalaciju.
2. U administraciji otvorite **Extensions > Extensions**, odaberite vrstu **Modules** i instalirajte sva četiri modula.
3. Otvorite **Extensions > Modifications** i kliknite **Refresh**. Time se primjenjuju OCMOD zahvati iz `upload/system/*.ocmod.xml` na Basel i zadane predloške.
4. Otvorite svaki modul, provjerite postavke i spremite ih.
5. Očistite OpenCart i temu cache ako produkcijska instalacija koristi dodatni cache izvan standardnog OCMOD cachea.

Moduli za povrate i jamstvo nalaze se i u `extensions/legal_return` odnosno `extensions/legal_warranty` kao izvori zasebnih OpenCart installer paketa. Runtime kopije pod `upload/` namijenjene su izravnoj objavi ovoga repozitorija.

## 1. Sidrene cijene

Modul stvara tablicu `${DB_PREFIX}product_anchor_price`, dodaje sidrenu cijenu i referentni datum na administratorski obrazac proizvoda te ih prikazuje na stranici proizvoda, kategorijama, rezultatima pretraživanja, posebnim ponudama i modulima proizvoda.

Sidrena cijena prikazuje se samo gostima i prijavljenim kupcima iz glavne grupe **Default** (`customer_group_id = 1`). Za sve veleprodajne/B2B i ostale grupe potpuno je skrivena. Također se nikada ne prikazuje sama ako posjetitelj nema pravo vidjeti aktualnu cijenu. Ako je uključena OpenCart postavka **Login Display Prices / Prikaži cijene prijavljenim korisnicima**, obje cijene su gostima skrivene, a modul u administraciji prikazuje upozorenje. Za javni prikaz aktualne i sidrene cijene tu postavku treba isključiti.

Masovni unos podržava CSV/TXT s razdjelnicima `;`, `,` ili tabulatorom. Obvezna su polja `anchor_price`, `reference_date` i barem jedan identifikator: `product_id`, `sku` ili `model`. Cijena i datum uvijek čine par: oba prazna polja brišu zapis, a svaki drugi unos zahtijeva valjanu cijenu veću od nule i valjani datum. Primjer CSV-a može se preuzeti iz administracije.

Uvoz je prilagođen velikim katalozima: datoteka se čita redak-po-redak, u memoriji se drži najviše jedan paket od 500 redaka, identifikatori se razrješavaju skupnim upitima, a promjene se spremaju skupnim upsertom/brisanjima u zasebnoj transakciji za svaki paket. Dva paralelna uvoza sprječava file lock. `product_id` je preporučeni identifikator za desetke ili stotine tisuća artikala jer se traži preko primarnog indeksa; SKU/model služe kao fallback i trebaju biti indeksirani na velikoj bazi. Modul prihvaća datoteke do 100 MB, uz uvjet da PHP `upload_max_filesize`/`post_max_size` i timeout web/proxy poslužitelja dopuštaju takav zahtjev. Ako infrastruktura ima kraći timeout, iznimno velik CSV treba podijeliti u više datoteka; svaki paket se zasebno potvrđuje pa se ne drži jedna transakcija kroz cijeli uvoz.

Nakon instalacije provjerite:

- unos i spremanje na jednom proizvodu;
- CSV s decimalnim zarezom i datumom `GGGG-MM-DD`;
- prikaz teksta `Cijena na dan DD.MM.GGGG.:` na desktopu i mobitelu;
- proizvode bez sidrene cijene, kod kojih se ništa dodatno ne smije prikazati.

## 2. Digitalni XML/CSV cjenik

Detaljna konfiguracija, javne rute, polja i operativna provjera opisani su u [digital-pricelist.md](digital-pricelist.md).

Obvezno konfigurirajte oblik, adresu i oznaku prodajnog objekta, javnu B2C grupu kupaca te, kada su primjenjivi, atribute jedinice mjere i cijene po jedinici. Nakon spremanja prvo generiranje za veći katalog pokrenite CLI naredbom navedenom u detaljnim uputama digitalnog cjenika.

Za automatsko generiranje jednom dnevno u 07:30 postavite produkcijski cron:

```cron
CRON_TZ=Europe/Zagreb
30 7 * * * /usr/bin/php /apsolutna/putanja/do/opencarta/system/cli/digital_pricelist.php
```

Ako hosting ne podržava `CRON_TZ`, odaberite vremensku zonu `Europe/Zagreb` u njegovom sučelju za zakazane zadatke.

Stabilne javne rute su:

```text
index.php?route=extension/module/digital_pricelist/xml
index.php?route=extension/module/digital_pricelist/csv
index.php?route=extension/module/digital_pricelist/archives
```

Aktualne datoteke koriste propisani naziv pri preuzimanju. Prethodne XML i CSV verzije dostupne su kroz javni arhivski popis i čuvaju se najmanje 30 dana.

## 3. Povrati i jednostrani raskidi

Modul dodaje poveznicu **Jednostrani raskid ugovora** u odjeljak **Informacije** podnožja, uključujući Basel `#collapse1`. Obrazac razdvaja zakonski raskid u roku od 14 dana od povrata/reklamacije zbog nedostatka.

Raskid se predaje u dva koraka: unos podataka, zatim pregled i zasebna funkcija **Potvrditi raskid ugovora**. Broj narudžbe i adresa e-pošte moraju odgovarati istoj narudžbi u istoj trgovini. Pokušaji provjere i slanja ograničeni su po IP adresi i narudžbi, a obrazac uvijek prikazuje i alternativnu adresu trgovca za slanje izjave. Nakon potvrde zahtjev dobiva referentni broj i vrijeme podnošenja, sprema se u administratorski pregled te se kupcu i administratoru neovisno pokušavaju poslati e-poruke. Administracija omogućuje filtriranje, promjenu statusa, internu bilješku i CSV izvoz.

Nakon instalacije postavite administratorsku adresu e-pošte i izvedite test s adresom kojoj možete provjeriti ulaznu poštu. Ako potvrda kupcu ne uspije, zahtjev ostaje spremljen, greška se bilježi, a stranica uspjeha jasno upozorava korisnika.

## 4. Zakonsko jamstvo

Modul prikazuje brendiranu poveznicu **Zakonsko jamstvo – najmanje 2 godine** neposredno prije podnožja, obavijest u standardnom i Basel/Quick checkoutu te poseban blok u HTML potvrdi narudžbe.

Poveznica otvara izvorni hrvatski kolor SVG Europske komisije bez izmjena. Lokalna datoteka mora zadržati SHA-256:

```text
a22432ff287ae772fd7f1bc7198dce26cbcfba3b1c8c6fa207189c1163e2612e
```

Nakon instalacije provjerite modal na desktopu i mobitelu, oba checkouta koja su aktivna na produkciji te stvarno primljenu HTML potvrdu narudžbe. U e-poruci zakonsko jamstvo i raskid ugovora u roku od 14 dana moraju ostati u odvojenim blokovima.

## Pravne i operativne napomene

Implementacija daje tehničku osnovu prema trenutačno objavljenim službenim zahtjevima. Prije produkcijskog puštanja odgovorna osoba treba potvrditi identitet prodajnog objekta, mapiranje podataka, tekstove trgovca i produkcijski raspored.

Službeni izvori korišteni za implementaciju:

- Provedbena uredba Komisije (EU) 2025/1960 i grafičke datoteke obavijesti Europske komisije;
- Zakon o zaštiti potrošača, izmjene objavljene u NN 59/2026;
- Pravilnik o digitalnom cjeniku, NN 101/2026;
- Your Europe informacije o jamstvima i povratima na hrvatskom jeziku.
