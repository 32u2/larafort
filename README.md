# Laravel Starter
- Fortify
- Bootstrap 4
- Sass

## Installation

composer create-project --prefer-dist laravel/laravel larafort
cd larafort

(adjust .env file as needed to accommodate local db)

composer require laravel/fortify
php artisan vendor:publish --provider="Laravel\Fortify\FortifyServiceProvider"
php artisan migrate

npm i
npm install --save bootstrap jquery popper.js cross-env

Adjust resources/js/bootstrap.js:

``` javascript
try {
    window.Popper = require('popper.js').default;
    window.$ = window.jQuery = require('jquery');

    require('bootstrap');
} catch (e) {
}
```

Delete resources/css folder and create app.scss file in resources/sass

Import packages in the resources/sass/app.scss file:

``` css
// bootstrap
@import "~bootstrap/scss/bootstrap";
```

Update webpack.mix.js:
``` javascript
mix.js('resources/js/app.js', 'public/js')
    .sass('resources/sass/app.scss', 'public/css');
```

Run ```npm run dev``` to compile assets

## Fortify chores

### Views

- resources/views/layouts/app.blade.php 
- resources/views/auth/login.blade.php
- resources/views/auth/register.blade.php
- resources/views/auth/forgot-password.blade.php
- resources/views/auth/reset-password.blade.php
- resources/views/auth/verify-email.blade.php
- resources/views/home.blade.php

### Add Fortify provider

app/Providers/FortifyServiceProvider.

```
public function boot()
{
    Fortify::loginView(function () {
        return view('auth.login');
    });

    Fortify::authenticateUsing(function (Request $request) {
        $user = User::where('email', $request->email)->first();

        if ($user &&
            Hash::check($request->password, $user->password)) {
            return $user;
        }
    });

    Fortify::registerView(function () {
        return view('auth.register');
    });

    Fortify::requestPasswordResetLinkView(function () {
        return view('auth.forgot-password');
    });

    Fortify::resetPasswordView(function ($request) {
        return view('auth.reset-password', ['request' => $request]);
    });

    Fortify::verifyEmailView(function () {
        return view('auth.verify-email');
    });

    // ...
}
```

### Register Fortify provider

Add the new provider to your array of providers in config/app.php.

config/app.php

```
'providers' => [
    /*
     * Application Service Providers...
     */
    App\Providers\FortifyServiceProvider::class,
    [...]
]
```


