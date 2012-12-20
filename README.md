Nerd Core
=========

The Nerd Core classes provide a foundation for applications to be built.

It provides a kernel implementation that provides an event dispatch/notify
interface, an object container and basic environment handling.

Creating an application kernel is simple:

    use Nerd\Core\Kernel\Kernel
      , Nerd\Core\Event\Dispatcher
      , Nerd\core\Cotnainer\Container;

    $dispatcher = new Dispatcher;
    $container  = new Container;
    $kernel     = new Kernel($dispatcher, $container);

Now we can add application objects to the container:

    $container->set('logger', new Monolog);

And access them from anywhere in your application via the kernel object:

    $kernel->getContainer()->get('logger');

Register application event listeners and attach objects to the event:

    $dispatcher->attach('application.start', new MyEventListener);

Attach data to the event instance:

    $event = new Event('application.start');
    $event->setArgument('loggerInstance', $kernel->getContainer()->get('logger'));

And Trigger them (optionally passing in an event object):

    $dispatcher->dispatch('application.start');
    $dispatcher->dispatch('application.start', $event);

Loading
-------

Include this package with composer, otherwise add the path to your PSR-0
compatible autoloader.

Resources
---------

You can run the unit tests with the following command:

    $ cd path/to/nerd-core/Nerd
    $ composer.phar install --dev
    $ phpunit