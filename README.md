# Digital Hub task

Słowem wstępu ;) Użyłem frameworka Laravel 12 oraz podejścia DDD (Domain-Driven Design), dzięki temu mamy jasne oddzielenie warstwy logiki biznesowej, aplikacyjnej oraz infrastruktury. Co prawda to jest prosty CRUD, który nie zawira logiki biznesowej ale w przyszłości może już ją zawierać, projekt może się rozwinąć ;)  
Założeniem tego API jest użycie lokalne, więc nie robiłem żadnych metod uwierzytelniania. Gdyby miało być użyte publicznie na pewno trzeba by zastosować uwierzytelnianie np. za pomocą tokenów JWT oraz zabezpieczyć enpointy zmieniające stan aplikacji.

## Jak odpalić projekt

```
cp .env.example .env (do testu można użyc lokalnej bazy sqlite)
php artisan migrate
php artisan db:seed
php artisan serve
```

## Jak odpalić testy

```
php artisan test (Odpala proste testy integracyjne)
```

## API

### Reprezentacje danych

#### LabTest

| Pole        | Typ                 | Przykład                                              |
| ----------- | ------------------- | ----------------------------------------------------- |
| id          | UUID                | 2bd11169-0768-46c1-ac3b-791e25d573f7                  |
| code        | int                 | 46                                                    |
| code_icd    | string              | 02 yr                                                 |
| name        | Map<string, string> | {"iz": "aut", "jh": "quia", "vw": "id"}               |
| description | Map<string, string> | {"de": "eveniet", "np": "quos", "ub": "perspiciatis"} |
| ord         | int                 | 29                                                    |
| categories  | LabTestCategory[]   | patrz: LabTestCategory                                |

---

#### LabTestCategory

| Pole      | Typ                 | Przykład                                        |
| --------- | ------------------- | ----------------------------------------------- |
| id        | UUID                | 64f90fac-f71b-4c50-a7c0-5e32c9e9971d            |
| name      | Map<string, string> | {"jg": "eos", "kj": "quis", "us": "doloremque"} |
| ord       | int                 | 15                                              |
| lab_tests | LabTest[]           | patrz: LabTest                                  |

### Struktura odpowiedzi

#### Przykład dla sukcesu

```json
{
    "status": "success",
    "message": "Success",
    "data": [
        {
            "id": "2bd11169-0768-46c1-ac3b-791e25d573f7",
            "code": 46,
            "code_icd": "02 yr",
            "name": {
                "iz": "aut",
                "jh": "quia",
                "vw": "id"
            },
            "description": {
                "de": "eveniet",
                "np": "quos",
                "ub": "perspiciatis"
            },
            "ord": 29,
            "categories": [
                {
                    "id": "64f90fac-f71b-4c50-a7c0-5e32c9e9971d",
                    "name": {
                        "jg": "eos",
                        "kj": "quis",
                        "us": "doloremque"
                    },
                    "ord": 15,
                    "lab_tests": null
                }
            ]
        }
    ]
}
```

#### Przykład dla błędu

```json
{
    "status": "error",
    "message": "Validation Error",
    "errors": {
        "id": ["The id field must be a valid UUID."]
    }
}
```

### Endpointy

#### GET `/api/lab-tests`

Zwraca listę kbadań laboratoryjnych razem z powiązanymi kategoriami.

### Parametry dostępne w body

| Parametr     | Typ      | Wymagany | Domyślna wartość | Opis          |
| ------------ | -------- | -------- | ---------------- | ------------- |
| `name`       | `string` | Nie      | `null`           | Nazwa testu   |
| `synonym`    | `string` | Nie      | `null`           | Synonim testu |
| `categoryId` | `uuid`   | Nie      | `null`           | ID kategorii  |
| `code`       | `int`    | Nie      | `null`           | Kod testu     |
| `codeIcd`    | `string` | Nie      | `null`           | Kod ICD       |

#### GET `/api/lab-tests/{UUID}`

Zwraca konkretne badanie razem z powiązanymi kategoriami.

#### POST `/api/lab-tests`

Tworzy nowe badanie

### Parametry dostępne w body

| Parametr      | Typ                   | Wymagany | Opis                     |
| ------------- | --------------------- | -------- | ------------------------ |
| `code`        | `int`                 | Tak      | Kod testu                |
| `code_icd`    | `string`              | Tak      | Kod ICD                  |
| `name`        | `Map<string, string>` | Tak      | Nazwy w różnych językach |
| `description` | `Map<string, string>` | Tak      | Opisy w różnych językach |
| `public`      | `boolean`             | Tak      | Czy test jest publiczny  |

#### PUT `/api/lab-tests/{UUID}`

Aktualizuje badanie

### Parametry dostępne w body

Przynajmniej jeden jest wymagany

| Parametr      | Typ                   | Wymagany | Opis                     |
| ------------- | --------------------- | -------- | ------------------------ |
| `code`        | `int`                 | Nie      | Kod testu                |
| `code_icd`    | `string`              | Nie      | Kod ICD                  |
| `name`        | `Map<string, string>` | Nie      | Nazwy w różnych językach |
| `description` | `Map<string, string>` | Nie      | Opisy w różnych językach |
| `public`      | `boolean`             | Nie      | Czy test jest publiczny  |
| `categories`  | `Array<uuid>`         | Nie      | Id kategorii             |

#### DELETE `/api/lab-tests/{UUID}`

Usuwa (softdelete delete=1) badanie. Soft delete dlatego, że badanie może być wykorzystywane np. w wynikach u klientów.

#### GET `/api/lab-test-categories`

Zwraca listę kategorii badań laboratoryjnych razem z powiązanymi badaniami.

### Parametry dostępne w body

| Parametr | Typ      | Wymagany | Domyślna wartość | Opis        |
| -------- | -------- | -------- | ---------------- | ----------- |
| `name`   | `string` | Nie      | `null`           | Nazwa testu |

#### GET `/api/lab-test-categories/{UUID}`

Zwraca konkretną kategorię razem z powiązanymi badaniami.

#### POST `/api/lab-test-categories`

Tworzy nową kategorię

### Parametry dostępne w body

| Parametr | Typ                   | Wymagany | Opis                     |
| -------- | --------------------- | -------- | ------------------------ |
| `name`   | `Map<string, string>` | Tak      | Nazwy w różnych językach |
| `public` | `boolean`             | Tak      | Czy test jest publiczny  |
| `ord`    | `int`                 | Tak      | Kolejność                |

#### PUT `/api/lab-test-cateegories/{UUID}`

Aktualizuje kategorię

### Parametry dostępne w body

Przynajmniej jeden jest wymagany

| Parametr    | Typ                   | Wymagany | Opis                     |
| ----------- | --------------------- | -------- | ------------------------ |
| `name`      | `Map<string, string>` | Nie      | Nazwy w różnych językach |
| `public`    | `boolean`             | Nie      | Czy test jest publiczny  |
| `ord`       | `int`                 | Nie      | Kolejność                |
| `lab_tests` | `Array<uuid>`         | Nie      | Id kategorii             |

#### DELETE `/api/lab-test-categories/{UUID}`

Usuwa (softdelete delete=1) kategorię. Soft delete dlatego, że kategoria może być wykorzystywana np. w wynikach u klientów.

#### Nie są zwracane obiekty z flagą public=0 oraz delete=0
