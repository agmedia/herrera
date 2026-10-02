# Povrati i jednostrani raskid — OpenCart 3.0.3.8

Instalabilni OC3 modul za elektronički jednostrani raskid ugovora i zaseban povrat/reklamaciju zbog nedostatka.

## Funkcionalnosti

- stavka **„Jednostrani raskid ugovora”** pod Informacije u podnožju (Default i Basel `#collapse1`)
- dvostupanjska funkcija: unos podataka i pregled, zatim zaseban gumb **„Potvrditi raskid ugovora”**
- podaci o potrošaču, ugovoru/narudžbi, artiklima, datumu primitka i elektroničkom sredstvu za potvrdu
- razlog nije obvezan za jednostrani raskid
- trenutačna potvrda kupcu e-poštom koja sadrži cijelu izjavu, referencu, datum i vrijeme podnošenja
- zaseban pokušaj slanja obavijesti administratoru, neovisan o rezultatu slanja kupcu
- administrativni pregled, statusi, interne bilješke, pretraga i CSV izvoz koji se čita keyset paketima od 500 zapisa i struji bez učitavanja cijele evidencije u memoriju
- CSV zaštita od spreadsheet formula injectiona
- CSRF token, server-side potvrda nacrta i honeypot zaštita od jednostavnog spama
- responzivan prikaz za mobilne i desktop uređaje

## Instalacija

1. U OpenCart administraciji otvorite **Extensions → Installer** i učitajte `legal_return.ocmod.zip`.
2. Otvorite **Extensions → Modifications** i kliknite **Refresh**.
3. Otvorite **Extensions → Extensions → Modules**, instalirajte **Povrati i jednostrani raskidi** i spremite postavke.
4. Provjerite administratorsku adresu e-pošte i testirajte oba tijeka zahtjeva.

Kod izravnog deploymenta repozitorija datoteke su već u glavnom `upload/` stablu, a OCMOD je u `upload/system/legal_return.ocmod.xml`. I dalje je potrebno osvježiti modifikacije te jednom instalirati modul kako bi se kreirala tablica i uključio status.

## Podaci i deinstalacija

Zahtjevi se spremaju u tablicu `{DB_PREFIX}legal_return_request`. Deinstalacija briše postavke, ali namjerno ne briše zapise zahtjeva. Rok čuvanja i brisanje podataka treba uskladiti s internom politikom privatnosti i pravnim obvezama trgovca.

## Pravni izvori

- Zakon o izmjenama i dopunama Zakona o zaštiti potrošača, NN 59/2026, osobito čl. 81.a: https://narodne-novine.nn.hr/clanci/sluzbeni/2026_06_59_728.html
- Pravilnik o sadržaju i obliku obavijesti o pravu potrošača na jednostrani raskid, NN 117/2022: https://narodne-novine.nn.hr/clanci/sluzbeni/2022_10_117_1795.html
- Službene EU informacije o vraćanju: https://europa.eu/youreurope/citizens/consumers/shopping/returns/index_hr.htm

Modul tehnički provodi traženi tijek, ali ne zamjenjuje pravni pregled uvjeta poslovanja, iznimaka od prava na raskid, troškova povrata i drugih obavijesti konkretnog trgovca.
