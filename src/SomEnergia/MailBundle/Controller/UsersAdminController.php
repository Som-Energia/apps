<?php
namespace SomEnergia\MailBundle\Controller;

use Sonata\AdminBundle\Controller\CRUDController as Controller;
use Symfony\Component\HttpFoundation\RedirectResponse;

class UsersAdminController extends Controller
{

    /**
     * redirect the user depend on this choice
     *
     * @param object $object
     *
     * @return Response
     */
    protected function redirectTo($object)
    {
        $url = false;

        if ($this->get('request')->get('btn_update_and_list')) {
            $url = $this->admin->generateUrl('list');
        }
        if ($this->get('request')->get('btn_create_and_list')) {
            $url = $this->admin->generateUrl('list');
        }

        if ($this->get('request')->get('btn_create_and_create')) {
            $params = array();
            if ($this->admin->hasActiveSubClass()) {
                $params['subclass'] = $this->get('request')->get('subclass');
            }
            $url = $this->admin->generateUrl('create', $params);
        }
        
        if ($this->get('request')->get('btn_update_and_edit')) {
            //Update and edit To avoid PK route error in case of editing PK we redirect to list
            $url = $url = $this->admin->generateUrl('list');
        }

        if (!$url) {
            $url = $this->admin->generateObjectUrl('edit', $object);
        }

        return new RedirectResponse($url);
    }
}