# Laravel Flash

Simple laravel flash package used across systems

## Install

If you are using Laravel 5.4 or below, you will need to add the Service Provider below in manually to the config/app.php file. Otherwise it will be autoloaded on Laravel 5.5+

Provider:
```php
Industrious\Flash\FlashServiceProvider::class,
```

## Usage

##### Include in Layouts:

You will need to include the below partials in layouts file, so its available on all views.
```php
@include('industrious-flash::flash-messages')
```

##### Controllers:

To use it, simply include `FlashesMessages` Trait where required.

```php
use Industrious\Flash\Traits\FlashesMessages;

...

uses FlashesMessages;
```
You will then have access to the method and be able to use it as below;

```php
$this->flash('danger', 'Session has expired due to inactivity');
```

```php
$this->flash('success', 'Successfully updated user details');
```

The first parameter refers to `bootstrap style` and the second parameter is the `message` that will be displayed.

Check out the [Bootstrap documentation](https://getbootstrap.com/docs/4.0/components/alerts/) for all styling possibilities