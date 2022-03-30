# Overview

This bundle ensures all Dbal datetime types are stored in the UTC timezone for
consistency. When the values are read from the database, they are converted back
to a timezone of your choosing.

The bundle also offers a kernel-level timezone listener that makes sure the
default PHP timezone is always set.

# Installation

Enable the bundle in `config/bundles.php`:

```php
return [
    // ...
    OHMedia\TimezoneBundle\OHMediaTimezoneBundle::class => ['all' => true],
];
```

Update `config/packages/doctrine.yml`:

```yaml
doctrine:
    # ...
    dbal:
        # ...
        types:
            datetime: OHMedia\TimezoneBundle\Doctrine\Dbal\UTCDateTimeType
            datetimetz: OHMedia\TimezoneBundle\Doctrine\Dbal\UTCDateTimeType
            datetime_immutable: OHMedia\TimezoneBundle\Doctrine\Dbal\UTCDateTimeImmutableType
            datetimetz_immutable: OHMedia\TimezoneBundle\Doctrine\Dbal\UTCDateTimeImmutableType
```

# Usage

You can set a global timezone for your entire app by updating
`config/packages/oh_media_timezone.yaml` with:

```yaml
oh_media_timezone:
    timezone: 'America/Regina' # the default
```

You can also have timezones per user if your user entity uses the Trait
`OHMedia\TimezoneBundle\Entity\Traits\TimezoneUser`. This will add a property
called `timezone` to your user. You can update your user form like so:

```php
use Symfony\Component\Form\Extension\Core\Type\TimezoneType;

// ...

$builder->add('timezone', TimezoneType::class);
```