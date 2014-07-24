# Laravel Gravatar #
======
Laravel Gravatar is a very easy way to call gravatars with fallback images quite fast and efficiently.

## Installation ##
Begin by installing this package through Composer. Edit your project's composer.json file to require foinikas/gravatar.

    "require": {
        "foinikas/gravatar": "dev-master"
    }

Next, update Composer from the Terminal:

    composer update

Once this operation completes, the final step is to add the service provider. Open `app/config/app.php`, and add a new item to the providers array.

    'Foinikas\Gravatar\GravatarServiceProvider'
    
Do not worry about registering any Facade as it will register automatically a new Facade named `Gravatar`.
    
## Use Gravatar ##

Ready to call your first gravatar? Ok just make it:

    Gravatar::make('my@email.com');
    
That's it. Your gravatar was created!

## Parameters ##

Gravatar's `make` method can accept quite a few options:

    Gravatar::make($email, $attrs = [], $size = 50, $default = 'mm', $r = 'g', $secure = false);

### email ###
User's email address.

Note: If an invalid email address is provided an exception will be thrown.

Default value: not provided

### attributes ###
Attributes for the created img tag. Usage:

    ['class' => 'myClass', 'id' => 'myId'];

Default value: []

### size ###

An integer that demonstrates the gravatar's size you want.

Default value: 50

### default ###

This is the fallback image in case there is not a valid gravatar for the provided email address. This can be one of the default options Gravatar's api provides:

    '404', 'mm', 'identicon', 'monsterrid', 'wavatar', 'retro', 'blank'
    
or maybe a custom image's url you could provide:

    'img/myimage.jpg'
    
In case you provide a custom image then the package shall create a full path to it using Laravel's `URL::asset()` method.

Default value: 'mm'

### rating ###

Gravatar's rating option. Gravatar's api options:

    'g', 'pg', 'r', 'x'
    
Default value: 'g'

### secure ###

If you're displaying Gravatars on a page that is being served over SSL, then you'll want to serve your Gravatars via SSL as well. To achieve this just set this to true.

Default value: false

For more information about the default options Gravatar's API provides visit [Gravatar](http://el.gravatar.com/site/implement/)
