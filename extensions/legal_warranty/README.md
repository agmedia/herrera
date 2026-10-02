# Zakonsko jamstvo — OpenCart 3.0.3.8

Instalabilni OC3 modul za uočljivu obavijest **„Zakonsko jamstvo – najmanje 2 godine”**.

## Funkcionalnosti

- kompaktna uočljiva brand traka s poveznicom i modalom neposredno prije podnožja na svim stranicama
- prikaz pune službene hrvatske obavijesti u boji, bez izmjene sadržaja
- zasebna obavijest u standardnom i ugrađenom Quick Checkoutu
- obavijest u HTML potvrdi narudžbe e-poštom
- jasna odvojenost zakonskog jamstva od prava na jednostrani raskid u roku od 14 dana
- poveznica na službene EU informacije
- responzivan modal i checkout prikaz
- pojedinačne postavke za poveznicu prije podnožja, checkout i e-poštu

## Službeni asset

U paket je uključen točan hrvatski kolor SVG `Legal guarantee_notice HR.svg` iz službenog ZIP paketa Europske komisije. Datoteka nije sadržajno uređivana niti rekreirana.

- službeni ZIP: https://commission.europa.eu/document/download/27c45f1f-78a1-47a7-a7cc-adf23afee5ea_en?filename=SVG.zip
- ugrađena datoteka: `catalog/view/theme/default/image/legal-warranty/legal-guarantee-notice-hr-color.svg`
- veličina: `512377` bajtova
- SHA-256: `a22432ff287ae772fd7f1bc7198dce26cbcfba3b1c8c6fa207189c1163e2612e`

## Instalacija

1. U OpenCart administraciji otvorite **Extensions → Installer** i učitajte `legal_warranty.ocmod.zip`.
2. Otvorite **Extensions → Modifications** i kliknite **Refresh**.
3. Otvorite **Extensions → Extensions → Modules**, instalirajte **Zakonsko jamstvo – najmanje 2 godine** i spremite postavke.
4. Provjerite blok neposredno prije podnožja, oba checkouta i testnu potvrdu narudžbe na mobilnom i desktop prikazu.

Kod izravnog deploymenta repozitorija datoteke su već u glavnom `upload/` stablu, a OCMOD je u `upload/system/legal_warranty.ocmod.xml`. I dalje je potrebno osvježiti modifikacije te jednom instalirati modul kako bi se uključio status.

## Pravni i službeni izvori

- Provedbena uredba Komisije (EU) 2025/1960: https://eur-lex.europa.eu/legal-content/HR/TXT/?uri=CELEX:32025R1960
- Službene upute Europske komisije i vektorski asseti: https://commission.europa.eu/publications/practical-guidelines-and-high-resolution-vector-files-eu-notice-and-label-product-guarantees_en
- Your Europe — obavijest i pravila prikaza: https://europa.eu/youreurope/business/selling-in-eu/consumer-contracts-guarantees/eu-legal-guarantee-notice-and-garan-label/index_hr.htm
- Your Europe — informacije za potrošače: https://europa.eu/youreurope/citizens/consumers/shopping/guarantees/index_hr.htm

Usklađena obavijest obvezna je od 27. rujna 2026.; pri internetskom prikazu mora biti u boji i njezini se elementi ne smiju mijenjati.
