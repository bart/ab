Laravel A/B Testing
===================
AB is a server-side A/B testing tool for Laravel applications and provides a pretty simple feature set that is a great free alternative to services like Optimizely. It allows you to experiment with different variations of your website while test selection will be handled automatically.

Installation
------------
Install using composer:

    composer require bart/ab

Add the service provider to `app/config/app.php`:

    Bart\Ab\ServiceProvider::class,

Register the AB alias:

    'AB' => Bart\Ab\Facade::class,

Configuration
-------------

Publish the included configuration file like this:

    php artisan vendor:publish --provider="Bart\Ab\ServiceProvider"

Next, edit the `config/packages/bart/ab/config.php` file. The following configuration options are available:


### Enabled
Enables or disbales the A/B testing.

    'enabled' => true


### Default
If A/B testing is disbaled, `AB::getCurrentTest()` will return this.

    'default' => 'none'


### Tests
An array of test identifiers with an assigned level of distibution.

    'tests' => [
        'teaser1' => 1,
        'teaser2' => 2,
        'teaser3' => 1,
    ]

The above (default) configuration will display teaser version 2 to 50% of your users, whereas version 1 and 3 will be displayed to 25% of your users each.


Usage
-----
After you have defined your tests and enabled testing in the config you can start designing your A/B tests. It's as easy as 1-2-3 because the only thing you need to do is displaying a different peace of content for each test. Let's assume you have defined the tests from above, your view could look like this:

    @test('teaser1')
        Teaser 1 is being displayed
    @endtest

    @test('teaser2')
        Teaser 2 is being displayed
    @endtest

    @test('teaser3')
        Teaser 3 is being displayed
    @endtest


### Tracking
This package doesn't handle any goal or conversion tracking because every company is approaching this in a slightly different way. We would suggest to use a custom Google Analytics dimension and pass the assigned test version in your master view:

    dataLayer.push({'version': '{{ AB::getCurrentTest() }}'});


Contribution and questions
-------
If you have any questions or suggestions please feel free to ask or create megre request. Happy testing!