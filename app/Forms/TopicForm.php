<?php

namespace App\Forms;

use Kris\LaravelFormBuilder\Form;

class TopicForm extends Form
{
    public function buildForm()
    {
        $this
            ->add('name', 'text')
            ->add('message', 'textarea',[
                'attr' => ['class' => 'wysiwyg', 'name' => 'wysiwyg']
            ])
            ->add('submit', 'submit', [
                'attr' =>['class' => 'btn btn-success margin-auto']
            ]);
    }
}
