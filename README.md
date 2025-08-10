# Laravel Inertia Attributes

Add Inertia.js attributes to your Laravel project using PHP 8 attributes.

## Requirements

- PHP 8.0 or higher
- Laravel 8.x, 9.x, 10.x, 11.x, or 12.x
- Inertia.js

## Installation

You can install the package via composer:

```bash
composer require martinpham/laravel-inertia-attributes
```

## Usage

This package allows you to use PHP 8 attributes to define Inertia.js properties and methods in your Laravel controllers.

### Basic Example

```php
use MartinPham\InertiaAttributes\Attributes\InertiaPage;

class UserController extends Controller
{
    #[InertiaPage('User/Index')]
    public function index()
    {

    }
    
    #[InertiaPage('User/Show')]
    public function show(User $user)
    {
        
    }
}
```


## Credits

- [Martin Pham](https://github.com/martinpham)
## License

The MIT License (MIT). Please see [License File](LICENSE) for more information.
