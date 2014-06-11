## Hooky app

**Edgar Guerra**
| Crèdit de Sintesi 2014
| Desenvolupament d'Aplicacions Informàtiques (**DAI**)

-----

### Installation

* Requisites
	* [Composer - Dependency Manager for PHP](http://getcomposer.org/doc/00-intro.md#installation-nix) (Global installation recommended)
* [Laravel PHP Framework](http://laravel.com/docs/quick#installation)
* Packages included:
	* [Cartalyst Sentry 2 - Authentication and Authorization package](http://docs.cartalyst.com/sentry-2/installation/laravel-4)

* Download and install the framework's dependencies: `composer install`
* Set the application key: `php artisan key:generate`
* Edit database configuration file `app/config/database.php`, define the database connections and set mysql to default.

```php
'default' => 'mysql',
[...]
'mysql' => array(
	'driver'    => 'mysql',
	'host'      => 'localhost',
	'database'  => 'hookydb',
	'username'  => 'root',
	'password'  => '12346',
	'charset'   => 'utf8',
	'collation' => 'utf8_unicode_ci',
	'prefix'    => '',
),
```
* Migrate Sentry tables: `php artisan migrate --package=cartalyst/sentry`
* Migrate custom tables: `php artisan migrate`
* Seed database with example data: `php artisan db:seed`
* Serve the application on the PHP development server: `php artisan serve`

-----

* Add this to Faker/Provider/Base.php
```
/**
 * Returns X random elements from a passed array
 *
 * @param  array $array
 * @param  integer $count
 * @return mixed
 */
public static function randomElements($array = array('a', 'b', 'c'), $count = 1)
{
    $array_tmp = array();
    for ($i=0; $i < $count; $i++) { 
        $array_tmp[] = self::randomElement($array);
    }
    return $array_tmp;
}
```