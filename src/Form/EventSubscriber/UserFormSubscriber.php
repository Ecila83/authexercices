<?php

use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;

class UserFormSubscriber implements EventSubscriberInterface {
    Public function onPreSetDataEvent(FormEvent $event){
        $data = $event->getData();
        $form = $event->getForm();
        if ($data->getName() === 'pierre') {
            $form->get('gender');
        }
    }

    Public function onPostSetDataEvent(FormEvent $event){
        $data = $event->getData();
        $form = $event->getForm();
        if ($data->getName() === 'pierre') {
            $form->get('gender')->setData('homme');
        }
    }

    Public function onPreSubmitEvent(FormEvent $event){
        $data = $event->getData();
        if ($data['name']) {
            $data['email'] = $data['name'] . '@gmail.com';
        }
        $event->setData($data);
    }
    
    public static function getSubscribedEvents() {
        return [
            FormEvents::PRE_SET_DATA => 'onPreSetDataEvent',
            FormEvents::POST_SET_DATA => 'onPostSetDataEvent',
            FormEvents::PRE_SUBMIT => 'onPreSubmitEvent'
        ];
    }
}