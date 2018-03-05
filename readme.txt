Konfiguracja:

uzupełnienie pliku db_config.php danymi logowania do bazy
ustawienie odpowiedniego bazowego url $root w index.php

Technologie i biblioteki:
- biblioteka GUMP do walidacji
- jQuery, bootstrap do front-endu
- pdo do zarządzania bazą
- gotowa templatka logowania/rejestracji - https://bootsnipp.com/snippets/featured/login-and-register-tabbed-form

Resztę funkcjonalności postanowiłem zaimplementować używając czystego obiektowego PHP.
Użyłem wzorca MVC

Struktura:
Controller - kontrolery używane w aplikacji, obsługiwanie żądań
Database - interfejs i implementacja dostępu do bazy danych, globalnie dostępna klasa DB
Helpers - walidator i klasy pomocnicze
View - widoki, formularze
public - css i js

.htaccess - przekierowywanie wszystkich żądań na index.php

W mojej implementacji dodałem użytkownikom atrybut is_admin, który decyduje, którzy użytkownicy mogą dodawać/edytować/usuwać innych.
Nowo rejestrowani użytkownicy domyślnie nie są adminami.
DB::seed() tworzy administratora z loginem admin@e.pl i hasłem admin1

Możliwe poprawki:
- przeniesienie generowania sql z User do Model
- obsługa błędów bazy danych
- zwiększenie hermetyzacji obsługi baz danych - uniknięcie używania fetch() i fetchAll() poza klasą DBMySQL
- dodanie pełnych testów jednostkowych
- zbadanie dziwnego wyświetlania widoku admin.create.php (mimo generowania niemal identycznego html-a co admin.edit.php)


