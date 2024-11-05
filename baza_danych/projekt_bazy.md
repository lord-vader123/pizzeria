# Cel

Baza danych ma za zadanie przechowywać informacje na temat
pizz dostępnych w pizzerii, klientów, adresów dostaw oraz płatności.
Jej celem jest umożliwienie bezproblemowej edycji
menu oraz sprawnej obsługi zamówień, co przyczyni się do poprawy
jakości usług oraz satysfakcji klientów.

## Normalizacja

### 1PN (Pierwsza Postać Normalna)

Aby zapewnić, że dane są zorganizowane w sposób
efektywny i bez redundancji, należy je
podzielić na odpowiednie tabele. W 1PN każda kolumna powinna
zawierać atomowe (niepodzielne) wartości.

#### Klienci

- **imie_klienta**
- **nazwisko_klienta**
- **ulica_klienta**
- **nr_bloku_klienta**
- **nr_domu_klienta**
- **adres_zamowienia** (powiązane z tabelą adresów)

#### Pizze

- **nazwa_pizzy**
- **skladniki_pizzy**
- **cena_pizzy**

#### Zamówienia

- **id_klienta** (klucz obcy)
- **id_pizzy** (klucz obcy)
- **data_zamowienia**
- **cena_zamowienia**
- **koszt_dostawy**

#### Adresy

- **ulica**
- **nr_bloku**
- **nr_domu**

#### Płatności

- **id_zamowienia** (klucz obcy)
- **typ_platnosci** (np. gotówka, karta)
- **status_platnosci** (np. opłacona, nieopłacona)

### 2PN (Druga Postać Normalna)

| Tabela     | Atrybuty                                                                             |
| ---------- | ------------------------------------------------------------------------------------ |
| Klienci    | id_klienta, imie_klienta, nazwisko_klienta, id_adresu                                |
| Pizze      | id_pizzy, nazwa_pizzy, cena_pizzy                                                    |
| Zamówienia | id_zamowienia, id_klienta, id_pizzy, data_zamowienia, cena_zamowienia, koszt_dostawy |
| Adresy     | id_adresu, ulica_klienta, nr_bloku_klienta, nr_domu_klienta                          |
| Płatności  | id_platnosci, id_zamowienia, id_typu_platnosci, status_platnosci                     |

### 3PN (Trzecia Postać Normalna)

| Tabela         | Atrybuty                                                                             |
| -------------- | ------------------------------------------------------------------------------------ |
| Klienci        | id_klienta, imie_klienta, nazwisko_klienta, id_adresu                                |
| Pizze          | id_pizzy, nazwa_pizzy, cena_pizzy                                                    |
| Składniki      | id_skladnika, nazwa_skladnika, id_pizzy                                              |
| Zamówienia     | id_zamowienia, id_klienta, id_pizzy, data_zamowienia, cena_zamowienia, koszt_dostawy |
| Adresy         | id_adresu, ulica_klienta, nr_bloku_klienta, nr_domu_klienta                          |
| Płatności      | id_platnosci, id_zamowienia, id_typu_platnosci, status_platnosci                     |
| Typy_platnosci | id_typu, nazwa_typu                                                                  |
