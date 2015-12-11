<?php

namespace Vmc\VisitBundle\Handler;

use Vmc\VisitBundle\Model\VisitInterface;

interface VisitHandlerInterface
{
    /**
     * Get a Visit given the identifier
     *
     * @api
     *
     * @param mixed $id
     *
     * @return VisitInterface
     */
    public function get($id);

    /**
     * Get a list of Visits.
     *
     * @param int $limit  the limit of the result
     * @param int $offset starting from the offset
     *
     * @return array
     */
    public function all($limit = 5, $offset = 0);

    /**
     * Post Visit, creates a new Visit.
     *
     * @api
     *
     * @param array $parameters
     *
     * @return VisitInterface
     */
    public function post(array $parameters);

    /**
     * Edit a Visit.
     *
     * @api
     *
     * @param VisitInterface   $visit
     * @param array           $parameters
     *
     * @return VisitInterface
     */
    public function put(VisitInterface $visit, array $parameters);

    /**
     * Partially update a Visit.
     *
     * @api
     *
     * @param VisitInterface   $visit
     * @param array           $parameters
     *
     * @return VisitInterface
     */
    public function patch(VisitInterface $visit, array $parameters);
}
