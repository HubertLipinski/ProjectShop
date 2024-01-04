<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400"></a></p>

<p align="center">
<a href="https://travis-ci.org/laravel/framework"><img src="https://travis-ci.org/laravel/framework.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

# ProjectShop

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
