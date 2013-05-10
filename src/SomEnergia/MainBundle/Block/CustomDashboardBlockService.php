<?php

namespace SomEnergia\MainBundle\Block;
//namespace InstitutoStorico\Bundle\NewsletterBundle\Block;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Templating\EngineInterface;

use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Validator\ErrorElement;
use Sonata\AdminBundle\Admin\Pool;

use Sonata\BlockBundle\Model\BlockInterface;
use Sonata\BlockBundle\Block\BlockContextInterface;
use Sonata\BlockBundle\Block\BaseBlockService;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class CustomDashboardBlockService extends BaseBlockService
{
    protected $pool;

    /**
     * @param string                                                     $name
     * @param \Symfony\Bundle\FrameworkBundle\Templating\EngineInterface $templating
     * @param \Sonata\AdminBundle\Admin\Pool                             $pool
     */
    public function __construct($name, EngineInterface $templating, Pool $pool)
    {
        parent::__construct($name, $templating);

        $this->pool = $pool;
    }

    public function getName()
    {
        return 'Som Energia dashboard';
    }

    /*public function getDefaultSettings()
    {
        return array(
            'title' => $this->getName(),
        );
    }*/

    public function validateBlock(ErrorElement $errorElement, BlockInterface $block)
    {
    }

    public function buildEditForm(FormMapper $formMapper, BlockInterface $block)
    {
    }

    public function execute(BlockContextInterface $blockContext, Response $response = null)
    {
        //$settings = array_merge($this->getDefaultSettings(), $block->getSettings());

        $dashboardGroups = $this->pool->getDashboardGroups();

        $settings = $blockContext->getSettings();

        $visibleGroups = array();
        foreach ($dashboardGroups as $name => $dashboardGroup) {
            if (!$settings['groups'] || in_array($name, $settings['groups'])) {
                $visibleGroups[] = $dashboardGroup;
            }
        }

        return $this->renderResponse('MainBundle:SonataAdmin:somenergia_custom_adminlist.html.twig', array(
            'block'     => $blockContext->getBlock(),
            'settings'  => $settings,
            'admin_pool'    => $this->pool,
            'groups'        => $visibleGroups
        ), $response);
    }

    public function setDefaultSettings(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'groups' => false
        ));

        $resolver->setAllowedTypes(array(
            'groups' => array('bool')
        ));
    }
}