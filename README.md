<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

<p align="center">
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
</p>

## Authenticating using JWT-Auth composer package

Run command to install the package:

```bash
composer req tymon/jwt-auth
```

### Add service provider ( Laravel 5.4 or below )

Add the service provider to the providers array in the `config/app.php` config file as follows:

```php
'providers' => [
    ...

    Tymon\JWTAuth\Providers\LaravelServiceProvider::class,
]

'aliases'[
    ...

    'JWTAuth' => \Tymon\JWTAuth\Facades\JWTAuth::class,
    'JWTFactory' => \Tymon\JWTAuth\Facades\JWTFactory::class
]
```

### Publish the config

Run the following command to publish the package config file:

```bash
php artisan vendor:publish --provider="Tymon\JWTAuth\Providers\LaravelServiceProvider"
```

You should now have a `config/jwt.php` file that allows you to configure the basics of this package.

### Generate secret key

Run the helper command to generate a key for you:

```bash
php artisan jwt:secret
```

This will update your `.env` file with something like `JWT_SECRET=foobar`

It is the key that will be used to sign your tokens. How that happens exactly will depend on the algorithm that you choose to use.

## Resources

- [Laravel Vue js JWT authentication | Login , Register Token Based with Vuex and API Laravel -HINDI](https://www.youtube.com/watch?v=qJ-cMlCqlmo)
- [tymon/jwt-auth - Packagist](https://packagist.org/packages/tymon/jwt-auth)
- [github.com/tymondesigns/jwt-auth](https://github.com/tymondesigns/jwt-auth)
- [Laravel Installation - jwt-auth](https://jwt-auth.readthedocs.io/en/develop/laravel-installation/)
- [NPM - SweetAlert2](https://www.npmjs.com/package/sweetalert2/v/6.6.1?activeTab=readme)
- [SweetAlert2](https://sweetalert2.github.io/)
- [Vue-SweetAlert2](https://github.com/avil13/vue-sweetalert2)
- [Vuelidate for Vue 3](https://vuelidate-next.netlify.app/#installation)
