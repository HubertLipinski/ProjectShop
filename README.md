# ProjectShop

Prosty sklep internetowy oparty na Laravel + Vue <br/> <br/>
**Demo**: [http://projectshop.cloud](http://projectshop.cloud)

## Funkcjonalności

### Sklep:
- Logowanie / rejestracja / przypomnienie hasła
- Lista produktów z filtrowaniem i paginacją
- Lista zamówień
- System koszyka
- Integracja płatności PayU

### Panel Administracyjny:
- System ról i uprawnień
- Zarządzanie Użytkownikami
- Zarządzanie Produktami
- Zarządzanie Kategoriami
- Możliwość zalogowania się na innego użytkownika

## Wymagania
- PHP 8.1
- Node v16

## Instalacja

```shell
git clone https://github.com/HubertLipinski/ProjectShop.git
cd ProjectShop
cp .env.example .env
```

```sh
composer install
php artisan key:generate
php artisan migrate --seed
php artisan storage:link
```

```shell
npm install
npm run dev
```

Laravel Sail (WSL2 + docker)
```shell
composer install
alias sail='[ -f sail ] && sh sail || sh vendor/bin/sail'
sail up -d
sail artisan key:generate
sail artisan migrate --seed
sail artisan storage:link
sail npm install
sail npm run prod
```


### Płatności
Aplikacja posiada integracje płatności poprzez **PayU**.
Domyślne dane znajdują się w .env.example lub można użyć tych tutaj: <https://developers.payu.com/europe/pl/docs/testing/sandbox/>
