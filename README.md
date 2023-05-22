<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

<p align="center">
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
</p>

## Installing Vue

After setting up a Laravel project as required, we need to pair it with Vue. Open a terminal inside your current Laravel project and run the below command to install Vue.

```bash
npm install vue@latest vue-loader@latest vue-router
```

By default, Laravel 10 should be installed with **Vite** as the bundler **Webpack**. If your project folder contains a **vite.config.js** file then it is using **Vite**. If you have a **webpack.mix.js** then it uses **Webpack**

### Setup Vue with Vite

- Inside your `resource/js/app.js` file, add the below code to import the necessary dependencies to setup a Vue.js application and mount it to a specified element on a HTML page.

```javascript
// Import the createApp function from the Vue library. This function is used to create a new Vue instance.
import { createApp } from 'vue';

// Imports the "main" Vue component of the application as "app".
import app from './layouts/main.vue'

// Creates a new Vue instance using the createApp function and mounts it to the #app element which will be defined in welcome.blade.php
createApp(app).mount("#app")
```

- Define the HTML element where the Vue app will be mounted as shown below. In this case, `resources/views/welcome.blade.php`.

```html
// welcome.blade.php
// Remove the existing code inside the <body> tag
...
<body class="antialiased">
    <div id="app"></div>

    @vite('resources/js/app.js')
</body>
```

- Created a folder called `layouts`. Inside this new folder, create a vue file, lets name this `main.vue`. Fill it with the following code.

```javascript
<template>
  <div>
    <h1>
      Hello, Entry point here!
    </h1>
  </div>
</template>
```

- Now, we'll need to `@vitejs/plugin-vue` npm package to enable Vite to handle Vue components (.vue files) by transforming them into JavaScript modules that can be loaded by the browser. Run below command to install it.

```bash
npm i @vitejs/plugin-vue
```

- Add the folling lines to `vite.config.js` to import the above plugin.

```javascript
// vite.config.js
import vue from '@vitejs/plugin-vue'

export default {
  plugins: [vue()],
}
```

- Now run `npm run dev` to start the Vite server / frontend and `php artisan serve` start the Laravel server / backend in separate terminal inside your project path.
- By default, Laravel starts at `port 8000` unless we define some other port in the `.env` file. Try opening the URL: <http://127.0.0.1:8000/>

#### References

- [Install Vue 3 In Laravel 9 With Vite | Laravel Vite With Vue 3 | Vite Laravel Vue 3 | #1 HINDI](https://www.youtube.com/watch?v=8_ptB59jcWM&t=2s), it's in Hindi, will update link to English version if it exists.
- [@vitejs/plugin-vue](https://www.npmjs.com/package/@vitejs/plugin-vue)

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


### Create "jwt.verify" middleware

```bash
php artisan make:middleware JWTMiddleware
```

### Register JWTMiddleware in `app/Http/Kernel.php`

```php
protected $middlewareAliases = [
    ...

    'jwt.verify' => \App\Http\Middleware\JWTMiddleware::class,
];
```

## Authentication related changes on Vue side of the project

Install Vuex by running `npm install vuex`,

## Resources

- [Laravel Vue js JWT authentication | Login , Register Token Based with Vuex and API Laravel -HINDI](https://www.youtube.com/watch?v=qJ-cMlCqlmo)
- [tymon/jwt-auth - Packagist](https://packagist.org/packages/tymon/jwt-auth)
- [github.com/tymondesigns/jwt-auth](https://github.com/tymondesigns/jwt-auth)
- [Laravel Installation - jwt-auth](https://jwt-auth.readthedocs.io/en/develop/laravel-installation/)
- [NPM - SweetAlert2](https://www.npmjs.com/package/sweetalert2/v/6.6.1?activeTab=readme)
- [SweetAlert2](https://sweetalert2.github.io/)
- [Vue-SweetAlert2](https://github.com/avil13/vue-sweetalert2)
- [Vuelidate for Vue 3](https://vuelidate-next.netlify.app/#installation)
- [Vue 3 DatePicker](https://vue3datepicker.com/installation/)
