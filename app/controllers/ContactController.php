<?php

class ContactController extends ControllerBase
{
    public function initialize()
    {
        $this->view->setTemplateAfter('main');
        Phalcon\Tag::setTitle('Свяжитесь со мной');
        parent::initialize();
    }

    public function indexAction()
    {
    }

    public function sendAction()
    {
        if ($this->request->isPost() == true) {

            $name = $this->request->getPost('name', array('striptags', 'string'));
            $email = $this->request->getPost('email', 'email');
            $comments = $this->request->getPost('comments', array('striptags', 'string'));

            $contact = new Contact();
            $contact->name = $name;
            $contact->email = $email;
            $contact->comments = $comments;
            $contact->created_at = new Phalcon\Db\RawValue('now()');
            if ($contact->save() == false) {
                foreach ($contact->getMessages() as $message) {
                    $this->flash->error((string) $message);
                }
            } else {
                $this->flash->success('Спасибо! В течении нескольких часов с вами свяжется администатор сайта .');
                return $this->forward('index/index');
            }
        }
        return $this->forward('contact/index');
    }
}
