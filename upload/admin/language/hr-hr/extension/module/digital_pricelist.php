<?php
$_['heading_title'] = 'Digitalni XML/CSV cjenik';

$_['text_extension'] = 'Proširenja';
$_['text_success'] = 'Postavke digitalnog cjenika su spremljene.';
$_['text_generated'] = 'Digitalni cjenik je generiran. Broj proizvoda: %d.';
$_['text_edit'] = 'Postavke digitalnog cjenika';
$_['text_enabled'] = 'Omogućeno';
$_['text_disabled'] = 'Onemogućeno';
$_['text_yes'] = 'Da';
$_['text_no'] = 'Ne';
$_['text_none'] = '— Nije primjenjivo / nije odabrano —';
$_['text_never'] = 'Još nije generiran';
$_['text_feed_urls'] = 'Javni URL-ovi';
$_['text_cron'] = 'Automatsko generiranje';
$_['text_storage'] = 'Stanje datoteka';
$_['text_legal_fields'] = 'Podaci objekta i obvezna polja';
$_['text_recent_runs'] = 'Posljednja generiranja';
$_['text_no_runs'] = 'Nema zabilježenih generiranja.';
$_['text_generate_help'] = 'Postavite cron jednom dnevno prije 08:00. Preporučeni primjer pokreće cjenik svaki dan u 07:30, čime je pokriven i obvezni raspored radnim danom. Raspoređivač mora koristiti vremensku zonu Europe/Zagreb.';
$_['text_large_catalog_warning'] = 'Velik katalog: za redovno i početno generiranje koristite CLI cron. „Generiraj sada” radi unutar jednog administratorskog HTTP zahtjeva pa ga web-poslužitelj ili reverse proxy može prekinuti iako generator koristi ograničenu količinu memorije.';

$_['entry_status'] = 'Status';
$_['entry_archive_days'] = 'Čuvanje arhive (dana)';
$_['entry_include_disabled'] = 'Uključi neaktivne proizvode';
$_['entry_cron_token'] = 'Sigurnosni cron token';
$_['entry_xml_url'] = 'Aktualni XML';
$_['entry_csv_url'] = 'Aktualni CSV';
$_['entry_archives_url'] = 'Javni popis arhive';
$_['entry_cron_url'] = 'Zaštićeni web cron URL';
$_['entry_cli_command'] = 'CLI naredba';
$_['entry_last_generated'] = 'Posljednje generiranje';
$_['entry_current_filename'] = 'Naziv aktualne pohrane';
$_['entry_archive_files'] = 'Broj arhivskih datoteka';
$_['entry_xml_size'] = 'Veličina XML-a';
$_['entry_csv_size'] = 'Veličina CSV-a';
$_['entry_customer_group'] = 'B2C grupa kupaca';
$_['entry_language'] = 'Jezik cjenika';
$_['entry_unit_attribute'] = 'Atribut jedinice mjere';
$_['entry_unit_price_attribute'] = 'Atribut cijene po jedinici';
$_['entry_special_sale_name'] = 'Naziv posebnog oblika prodaje';
$_['entry_object_type'] = 'Oblik objekta';
$_['entry_object_address'] = 'Adresa objekta';
$_['entry_object_code'] = 'Oznaka objekta';

$_['column_generated_at'] = 'Vrijeme';
$_['column_status'] = 'Status';
$_['column_products'] = 'Proizvodi';
$_['column_duration'] = 'Trajanje';
$_['column_message'] = 'Poruka';

$_['button_save'] = 'Spremi';
$_['button_cancel'] = 'Odustani';
$_['button_generate'] = 'Generiraj sada';

$_['help_archive_days'] = 'Najmanje 30 dana. Arhiva ostaje javno dostupna kroz sigurnu read-only rutu.';
$_['help_include_disabled'] = 'U pravilu ostavite isključeno kako bi cjenik sadržavao proizvode u javnoj prodaji.';
$_['help_cron_token'] = 'Najmanje 32 znaka. Koristi se samo za web cron; CLI način ne izlaže token u popisu procesa.';
$_['help_customer_group'] = 'Javna B2C cijena koristi ovu grupu i nikada cijenu trenutačno prijavljenog kupca.';
$_['help_language'] = 'Fiksni jezik naziva, statusa zalihe i mapiranih atributa; ne ovisi o jeziku administratora ili posjetitelja.';
$_['help_unit_attribute'] = 'Ako je primjenjivo, odaberite OpenCart atribut u kojem je za proizvod upisana jedinica mjere.';
$_['help_unit_price_attribute'] = 'Ako je primjenjivo, odaberite atribut s cijenom po jedinici, primjerice „4,99 EUR/kg”.';
$_['help_special_sale_name'] = 'Naziv se objavljuje kada proizvod ima aktivnu posebnu ili količinsku cijenu za količinu 1.';
$_['help_object_identity'] = 'Ove vrijednosti ulaze u XML i naziv svake arhivske datoteke zajedno s brojem pohrane i vremenskom oznakom.';

$_['error_permission'] = 'Nemate dopuštenje za izmjenu digitalnog cjenika.';
$_['error_archive_days'] = 'Razdoblje čuvanja mora biti između 30 i 3650 dana.';
$_['error_cron_token'] = 'Cron token mora imati 32 do 128 slova, brojki, crtica ili podvlaka.';
$_['error_special_sale_name'] = 'Naziv posebnog oblika prodaje je obvezan.';
$_['error_object_identity'] = 'Oblik, adresa i oznaka objekta obvezni su.';
$_['error_generation'] = 'Generiranje nije uspjelo: %s';
