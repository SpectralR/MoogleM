<?php

namespace App\Forms;

use Kris\LaravelFormBuilder\Form;

class EventForm extends Form
{
    public function buildForm()
    {
        $this
            ->add('name', 'text')
            ->add('description', 'textarea')
            ->add('date', 'date')
            ->add('hour', 'time')
            ->add('submit', 'submit');
    }
}
