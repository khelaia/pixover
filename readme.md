# pixover

[![Latest Version on Packagist][ico-version]][link-packagist]
[![Total Downloads][ico-downloads]][link-downloads]
[![Build Status][ico-travis]][link-travis]

The Pixover helps you make the web page more flexible and fast. You can upload photos with Pixover in as much resolution as you need. This will ultimately give you the optimum result for web page speed.

## Installation

* Via Composer

``` bash
$ composer require khelaia/pixover
```

* Add the service provider to your $providers array in config/app.php file like:

``` php
khelaia\pixover\pixoverServiceProvider::class
```

## Usage
* Import the class namespaces first, before using it
``` php 
use khelaia\pixover\pixover;
```
* Create Object

```php
$image = new pixover($file, $filename, $upload_path);
```

## Example
In this example, we are creating images in three different resolution x256 x512 and x128.
As a result we have array of image names
and 3 lightweight image
```php
public function store(Request $request){
    $file = $request->file('image');
    $image = new pixover($file,'thumbnail',public_path('images'));
    $image->setHight([256,512,128]);
    $image->done();
    return "success";
}
```
Uploaded file structure in /public directory

```text
.
├── ...
├── images                    
│   ├── x128          
│   │     └── thumbnail.jpg  
│   ├── x256                  
│   │     └── thumbnail.jpg
│   └── x512                
│         └── thumbnail.jpg
└── ...
```

## Change log

Please see the [changelog](changelog.md) for more information on what has changed recently.



## Contributing

Please see [contributing.md](contributing.md) for details and a todolist.

## Security

If you discover any security related issues, please email author email instead of using the issue tracker.

## Credits

- [Dimitri Khelaia][link-author]
- [All Contributors][link-contributors]

## License

license. Please see the [license file](license.md) for more information.

[ico-version]: https://img.shields.io/packagist/v/khelaia/pixover.svg?style=flat-square
[ico-downloads]: https://img.shields.io/packagist/dt/khelaia/pixover.svg?style=flat-square
[ico-travis]: https://img.shields.io/travis/khelaia/pixover/master.svg?style=flat-square
[ico-styleci]: https://styleci.io/repos/12345678/shield

[link-packagist]: https://packagist.org/packages/khelaia/pixover
[link-downloads]: https://packagist.org/packages/khelaia/pixover
[link-travis]: https://travis-ci.org/khelaia/pixover
[link-styleci]: https://styleci.io/repos/12345678
[link-author]: https://github.com/khelaia
[link-contributors]: ../../contributors
