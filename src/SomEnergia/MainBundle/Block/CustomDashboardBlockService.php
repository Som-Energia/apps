<?php

namespace SomEnergia\MainBundle\Block;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Templating\EngineInterface;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Validator\ErrorElement;
use Sonata\AdminBundle\Admin\Pool;
use Sonata\BlockBundle\Model\BlockInterface;
use Sonata\BlockBundle\Block\BlockContextInterface;
use Sonata\BlockBundle\Block\BaseBlockService;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

/**
 * Class CustomDashboardBlockService
 */
class CustomDashboardBlockService extends BaseBlockService
{
    /**
     * @var Pool
     */
    protected $pool;

    /**
     * Methods
     */

    /**
     * @param string                                                     $name
     * @param EngineInterface $templating
     * @param Pool                             $pool
     */
    public function __construct($name, EngineInterface $templating, Pool $pool)
    {
        parent::__construct($name, $templating);
        $this->pool = $pool;
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'Som Energia dashboard';
    }

    /**
     * @param BlockContextInterface $blockContext
     * @param Response|null $response
     *
     * @return Response
     */
    public function execute(BlockContextInterface $blockContext, Response $response = null)
    {
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

    /**
     * @param OptionsResolverInterface $resolver
     */
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
