Mailer Component
================

The Mailer component helps sending emails.

Getting Started
---------------

```bash
composer require symfony/mailer
```

```php
use Symfony\Component\Mailer\Transport;
use Symfony\Component\Mailer\Mailer;
use Symfony\Component\Mime\Email;

$transport = Transport::fromDsn('smtp://localhost');
$mailer = new Mailer($transport);

$email = (new Email())
    ->from('hello@example.com')
    ->to('you@example.com')
    //->cc('cc@example.com')
    //->bcc('bcc@example.com')
    //->replyTo('fabien@example.com')
    //->priority(Email::PRIORITY_HIGH)
    ->subject('Time for Symfony Mailer!')
    ->text('Sending emails is fun again!')
    ->html('<p>See Twig integration for better HTML integration!</p>');

$mailer->send($email);
```

To enable the Twig integration of the Mailer, require `symfony/twig-bridge` and
set up the `BodyRenderer`:

```php
use Symfony\Bridge\Twig\Mime\BodyRenderer;
use Symfony\Bridge\Twig\Mime\TemplatedEmail;
use Symfony\Component\EventDispatcher\EventDispatcher;
use Symfony\Component\Mailer\EventListener\MessageListener;
use Symfony\Component\Mailer\Mailer;
use Symfony\Component\Mailer\Transport;
use Twig\Environment as TwigEnvironment;

$twig = new TwigEnvironment(...);
$messageListener = new MessageListener(null, new BodyRenderer($twig));

$eventDispatcher = new EventDispatcher();
$eventDispatcher->addSubscriber($messageListener);

$transport = Transport::fromDsn('smtp://localhost', $eventDispatcher);
$mailer = new Mailer($transport, null, $eventDispatcher);

$email = (new TemplatedEmail())
    // ...
    ->htmlTemplate('emails/signup.html.twig')
    ->context([
        'expiration_date' => new \DateTimeImmutable('+7 days'),
        'username' => 'foo',
    ])
;
$mailer->send($email);
```

Sponsor
-------

<<<<<<< HEAD
=======
The Mailer component for Symfony 7.2 is [backed][1] by:

 * [Sweego][2], a European email and SMS sending platform for developers and product builders. Easily create, deliver, and monitor your emails and notifications.

>>>>>>> 049e9c5cd56276e2255d7f3c44e689248e341a1e
Help Symfony by [sponsoring][3] its development!

Resources
---------

 * [Documentation](https://symfony.com/doc/current/mailer.html)
 * [Contributing](https://symfony.com/doc/current/contributing/index.html)
 * [Report issues](https://github.com/symfony/symfony/issues) and
   [send Pull Requests](https://github.com/symfony/symfony/pulls)
   in the [main Symfony repository](https://github.com/symfony/symfony)

<<<<<<< HEAD
=======
[1]: https://symfony.com/backers
[2]: https://www.sweego.io/
>>>>>>> 049e9c5cd56276e2255d7f3c44e689248e341a1e
[3]: https://symfony.com/sponsor
