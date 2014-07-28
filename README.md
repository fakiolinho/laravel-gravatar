# Laravel Gravatar #
[![Travis CI](http://img.shields.io/travis/joyent/node/v0.6.svg)](https://travis-ci.org/fakiolinho/laravel-gravatar) [![MIT](http://img.shields.io/npm/l/express.svg)](http://opensource.org/licenses/MIT)

Laravel Gravatar is a very easy way to call gravatars with fallback images quite fast and efficiently while using Laravel 4 framework.

## Installation ##
Begin by installing this package through Composer. Edit your project's composer.json file to require foinikas/gravatar.

    "require": {
        "foinikas/gravatar": "dev-master"
    }

Next, update Composer from the Terminal:

    composer update

Once this operation completes, the final step is to add the service provider. Open `app/config/app.php`, and add a new item to the providers array.

    'Foinikas\Gravatar\GravatarServiceProvider'
    
Do not worry about registering any Facade as it will register automatically a new Facade named `Gravatar` for you.
    
## Use Gravatar ##

Ready to call your first gravatar? Ok just create a gravatar image:

    Gravatar::image('my@email.com');

or maybe just a gravatar url is ok:

    Gravatar::url('my@email.com');
    
That's it. Your gravatar was created!

## Parameters ##
Gravatar's `image` method can accept quite a few options:

    Gravatar::image($email, array $attrs = null, $size = 50, $default = null, $r = 'g', $secure = false);

Gravatar's `url` method can accept almost the same except for the `$attrs` array:

    Gravatar::url($email, $size = 50, $default = null, $r = 'g', $secure = false);

### email ###
User's email address.

Note: If an invalid email address is provided an exception will be thrown.

Default value: not provided

### attributes ###
Attributes for the created img tag. Usage:

    ['class' => 'myClass', 'id' => 'myId'];

Default value: null

### size ###

An integer that demonstrates the gravatar's size you want.

Default value: 50

### default ###

This is the fallback image in case there is not a valid gravatar for the provided email address. This can be either the default Gravatar logo if default parameter is left blank or can be one of the many options Gravatar's api provides:

    '404', 'mm', 'identicon', 'monsterid', 'wavatar', 'retro', 'blank'
    
or also it could be a custom image's url you may choose to provide:

    'img/myimage.jpg'
    
In case you provide a custom image then the package shall create a full path to it using Laravel's `URL::asset()` method.

Default value: null (Gravatar logo)

### rating ###

Gravatar's rating option. Gravatar's api options:

    'g', 'pg', 'r', 'x'
    
Default value: 'g'

### secure ###

If you're displaying Gravatars on a page that is being served over SSL, then you'll want to serve your Gravatars via SSL as well. To achieve this just set this to true.

Default value: false

## License ##

All code created by foinikas is open-sourced software licensed under the [MIT license](http://opensource.org/licenses/MIT)

For more information about the default options Gravatar's API provides visit [Gravatar](http://el.gravatar.com/site/implement/)
