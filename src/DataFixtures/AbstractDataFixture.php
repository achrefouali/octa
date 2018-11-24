<?php
/**
 * Description of AbstractDataFixture.php.
 * This class allow implementing and loading fixtures for different environments
 *
 */

namespace App\DataFixtures;



use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\DataFixtures\ReferenceRepository;
use Doctrine\Common\DataFixtures\SharedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;

abstract class AbstractDataFixture implements ContainerAwareInterface, SharedFixtureInterface, OrderedFixtureInterface
{
    /**
     * The dependency injection container.
     *
     * @var ContainerInterface
     */
    protected $container;

    /**
     * {@inheritDoc}
     */
    public function load(ObjectManager $manager)
    {
        // Check if the data fixture has a doAlways method and always run this in any environment
        if(method_exists( $this, 'doAlways'))
        {
            $this->doAlways($manager);
        }

        // Check if the current environment in production and if the doProd method exists
        if($this->getCurrentEnvironment() == 'prod' && method_exists( $this, 'doProd'))
        {
            $this->doProd($manager);
        }

        // Check if the current environment is available in the list of environments assigned to the data fixture
        if (in_array($this->getCurrentEnvironment(), $this->getEnvironments()))
        {
            $this->doLoad($manager);
        }
    }
    /**
     * {@inheritDoc}
     */
    public function setContainer(ContainerInterface $container = null)
    {
        $this->container = $container;
    }

    /**
     * @return string
     */
    public function getCurrentEnvironment()
    {
        /** @var KernelInterface $kernel */
        $kernel = $this->container->get('kernel');
        return $kernel->getEnvironment();
    }

    /**
     * Perform the database objects
     * @param ObjectManager $manager The object manager.
     */
    abstract protected function doLoad(ObjectManager $manager);

    /**
     * Get the environments the data fixtures are ran on
     * @return array The name of the environments.
     */
    abstract protected function getEnvironments();



    /**
     * References
     */
    /**
     * Fixture reference repository
     *
     * @var ReferenceRepository
     */
    protected $referenceRepository;

    /**
     * {@inheritdoc}
     */
    public function setReferenceRepository(ReferenceRepository $referenceRepository)
    {
        $this->referenceRepository = $referenceRepository;
    }

    /**
     * Set the reference entry identified by $name
     * and referenced to managed $object. If $name
     * already is set, it overrides it
     *
     * @param string $name
     * @param object $object - managed object
     * @see Doctrine\Common\DataFixtures\ReferenceRepository::setReference
     * @return void
     */
    public function setReference($name, $object)
    {
        $this->referenceRepository->setReference($name, $object);
    }

    /**
     * Set the reference entry identified by $name
     * and referenced to managed $object. If $name
     * already is set, it throws a
     * BadMethodCallException exception
     *
     * @param string $name
     * @param object $object - managed object
     * @see Doctrine\Common\DataFixtures\ReferenceRepository::addReference
     * @throws BadMethodCallException - if repository already has
     *      a reference by $name
     * @return void
     */
    public function addReference($name, $object)
    {
        $this->referenceRepository->addReference($name, $object);
    }

    /**
     * Loads an object using stored reference
     * named by $name
     *
     * @param string $name
     * @see Doctrine\Common\DataFixtures\ReferenceRepository::getReference
     * @return object
     */
    public function getReference($name)
    {
        return $this->referenceRepository->getReference($name);
    }

    /**
     * Check if an object is stored using reference
     * named by $name
     *
     * @param string $name
     * @see Doctrine\Common\DataFixtures\ReferenceRepository::hasReference
     * @return boolean
     */
    public function hasReference($name)
    {
        return $this->referenceRepository->hasReference($name);
    }

}