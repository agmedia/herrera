<?php
$_['heading_title'] = 'Sidrene cijene';

$_['text_extension'] = 'Proširenja';
$_['text_success'] = 'Postavke modula Sidrene cijene su spremljene.';
$_['text_edit'] = 'Postavke i masovni unos';
$_['text_enabled'] = 'Omogućeno';
$_['text_disabled'] = 'Onemogućeno';
$_['text_import'] = 'CSV uvoz';
$_['text_import_help'] = 'CSV mora sadržavati sidrenu cijenu, referentni datum i barem jedan identifikator proizvoda. Cijena i datum moraju biti uneseni zajedno; oba prazna polja brišu postojeći zapis. Sidrena cijena mora biti veća od nule. Podržani su razdjelnici točka-zarez, zarez i tabulator. Opći referentni datum je 10.09.2026.; za hranu, piće, higijenske potrepštine i proizvode za kućanstvo ostaje 02.05.2025.';
$_['text_import_scale_help'] = 'Veliki katalozi: product_id je najbrži identifikator jer koristi primarni indeks proizvoda. Uvoz čita datoteku strujno i potvrđuje pakete od 500 redaka. Modul prihvaća do 100 MB, ali PHP postavke upload_max_filesize/post_max_size i timeout web poslužitelja također moraju dopustiti prijenos; iznimno velike uvoze podijelite ako je proxy timeout kraći.';
$_['text_import_columns'] = 'Stupci: product_id, sku, model, anchor_price, reference_date (datum: GGGG-MM-DD, DD.MM.GGGG ili DD/MM/GGGG).';
$_['text_download_template'] = 'Preuzmi primjer CSV-a';
$_['text_import_complete'] = 'Uvoz je završen: ažurirano %d, obrisano %d, preskočeno %d redaka.';
$_['text_import_error_line'] = 'Redak %d: %s';
$_['text_ocmod_notice'] = 'Nakon prve instalacije ili promjene OCMOD datoteke osvježite Izmjene (Extensions → Modifications).';
$_['warning_customer_price'] = 'Uključena je postavka „Prikaži cijene prijavljenim korisnicima” (Login Display Prices). Gosti ne vide aktualnu cijenu pa im se namjerno ne prikazuje ni sidrena cijena. Isključite tu postavku ako obje cijene moraju biti javno vidljive.';

$_['entry_status'] = 'Prikaz na webshopu';
$_['entry_show_date'] = 'Prikaži referentni datum';
$_['entry_csv'] = 'CSV datoteka';
$_['entry_anchor_price'] = 'Sidrena cijena';
$_['entry_anchor_reference_date'] = 'Referentni datum';

$_['help_anchor_price'] = 'Cijena proizvoda na propisani referentni datum. Unesite vrijednost veću od nule u osnovnoj valuti trgovine, bez simbola valute.';
$_['help_anchor_reference_date'] = 'Datum na koji se sidrena cijena odnosi. Datum se sprema zasebno za svaki proizvod; opći datum je 10.09.2026., a za propisane postojeće kategorije 02.05.2025.';

$_['button_save'] = 'Spremi';
$_['button_cancel'] = 'Odustani';
$_['button_import'] = 'Uvezi CSV';

$_['error_permission'] = 'Nemate dopuštenje za izmjenu modula Sidrene cijene.';
$_['error_upload'] = 'CSV datoteka nije uspješno učitana.';
$_['error_file_size'] = 'Datoteka ne smije biti veća od 100 MB.';
$_['error_file_type'] = 'Dopuštene su samo CSV i TXT datoteke.';
$_['error_empty_file'] = 'CSV datoteka je prazna.';
$_['error_columns'] = 'Nedostaju obvezni stupci. Potrebni su anchor_price, reference_date i barem jedan od: product_id, sku ili model.';
$_['error_truncated_row'] = 'u retku nedostaje mapirano polje anchor_price ili reference_date; podaci nisu promijenjeni.';
$_['error_product_id'] = 'product_id mora biti cijeli broj od 1 do 2147483647.';
$_['error_identifier_length'] = 'SKU i model smiju sadržavati najviše 64 znaka.';
$_['error_import_locked'] = 'Drugi uvoz sidrenih cijena već je pokrenut. Pričekajte da završi pa pokušajte ponovno.';
$_['error_ambiguous_product'] = 'SKU ili model odgovara više proizvoda; upotrijebite product_id.';
$_['error_product_not_found'] = 'proizvod nije pronađen.';
$_['error_price'] = 'sidrena cijena nije valjana; unesite vrijednost veću od nule s najviše četiri decimale.';
$_['error_date'] = 'referentni datum nije valjan.';
$_['error_pair'] = 'sidrena cijena i referentni datum moraju biti zajedno uneseni ili oba prazna za brisanje zapisa.';
$_['error_anchor_price_pair'] = 'Sidrena cijena i referentni datum moraju biti oba prazna ili oba valjano popunjena. Sidrena cijena mora biti veća od nule.';
$_['error_row'] = 'podatke nije moguće spremiti.';
