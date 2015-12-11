<?php

namespace Vmc\VisitBundle\Handler;

use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\Form\FormFactoryInterface;
use Vmc\VisitBundle\Model\VisitInterface;
use Vmc\VisitBundle\Form\VisitType;
use Vmc\VisitBundle\Exception\InvalidFormException;

class VisitHandler implements VisitHandlerInterface
{
    private $om;
    private $entityClass;
    private $repository;
    private $formFactory;

    public function __construct(ObjectManager $om, $entityClass, FormFactoryInterface $formFactory)
    {
        $this->om = $om;
        $this->entityClass = $entityClass;
        $this->repository = $this->om->getRepository($this->entityClass);
        $this->formFactory = $formFactory;
    }

    /**
     * Get a Visit.
     *
     * @param mixed $id
     *
     * @return VisitInterface
     */
    public function get($id)
    {
        return $this->repository->find($id);
    }

    /**
     * Get a list of Visits.
     *
     * @param int $limit  the limit of the result
     * @param int $offset starting from the offset
     *
     * @return array
     */
    public function all($limit = 5, $offset = 0)
    {
        return $this->repository->findBy(array(), null, $limit, $offset);
    }

    /**
     * Create a new Visit.
     *
     * @param array $parameters
     *
     * @return VisitInterface
     */
    public function post(array $parameters)
    {
        $visit = $this->createVisit();

        return $this->processForm($visit, $parameters, 'POST');
    }

    /**
     * Edit a Visit.
     *
     * @param VisitInterface $visit
     * @param array         $parameters
     *
     * @return VisitInterface
     */
    public function put(VisitInterface $visit, array $parameters)
    {
        return $this->processForm($visit, $parameters, 'PUT');
    }

    /**
     * Partially update a Visit.
     *
     * @param VisitInterface $visit
     * @param array         $parameters
     *
     * @return VisitInterface
     */
    public function patch(VisitInterface $visit, array $parameters)
    {
        return $this->processForm($visit, $parameters, 'PATCH');
    }

    /**
     * Processes the form.
     *
     * @param VisitInterface $visit
     * @param array         $parameters
     * @param String        $method
     *
     * @return VisitInterface
     *
     * @throws \Vmc\VisitBundle\Exception\InvalidFormException
     */
    private function processForm(VisitInterface $visit, array $parameters, $method = "PUT")
    {
        $form = $this->formFactory->create(new VisitType(), $visit, array('method' => $method));
        $form->submit($parameters, 'PATCH' !== $method);
        if ($form->isValid()) {

            $visit = $form->getData();
            $this->om->persist($visit);
            $this->om->flush($visit);

            return $visit;
        }

        throw new InvalidFormException('Invalid submitted data', $form);
    }

    private function createVisit()
    {
        return new $this->entityClass();
    }

}
