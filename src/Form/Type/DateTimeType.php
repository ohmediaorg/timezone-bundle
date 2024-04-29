<?php

namespace OHMedia\TimezoneBundle\Form\Type;

use OHMedia\TimezoneBundle\Service\Timezone;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType as BaseDateTimeType;
use Symfony\Component\OptionsResolver\OptionsResolver;

class DateTimeType extends AbstractType
{
    public function __construct(private Timezone $timezone)
    {
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'model_timezone' => 'UTC',
            'view_timezone' => $this->timezone->get(),
        ]);
    }

    public function getParent(): ?string
    {
        return BaseDateTimeType::class;
    }
}
