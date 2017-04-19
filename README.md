
## Install the Application

Clone the repository

    git clone git@github.com:Ju4n/api-aivo.git

Install dependencies with [composer](https://getcomposer.org/)

    composer install

Configure **app id** and **app secret** in [src/Aivo/Config/settings.php](https://github.com/Ju4n/api-aivo/blob/master/src/Aivo/Config/settings.php)

    // Facebook SKD Settings
    'facebookSDK'               => [
        'app_id'                => '{app_id}',
        'app_secret'            => '{app_secret}',
        'default_graph_version' => 'v2.5'
    ]

To run the application in development, you can also run this command.

	php composer.phar start

Make a **GET** request to the following URL using a web browser or REST Client

    http://localhost:8080/profile/facebook/<id>

Run this command to run the test suite

	php composer.phar test
