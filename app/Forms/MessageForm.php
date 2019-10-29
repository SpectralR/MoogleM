<?php

namespace App\Forms;

use Kris\LaravelFormBuilder\Form;

class MessageForm extends Form
{
    public function buildForm()
    {
       $this
            ->add('message', 'textarea', [
                'attr' => ['name' => 'wysiwyg', 'class' => 'wysiwyg'],
                'label' => false
            ])
            ->add('submit', 'submit', [
                'attr' =>['class' => 'btn btn-success margin-auto']
            ]);
    }
}
