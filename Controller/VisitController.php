<?php

namespace Vmc\VisitBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

use FOS\RestBundle\Controller\FOSRestController;
use FOS\RestBundle\Util\Codes;
use FOS\RestBundle\Controller\Annotations;
use FOS\RestBundle\View\View;
use FOS\RestBundle\Request\ParamFetcherInterface;

use Symfony\Component\Form\FormTypeInterface;
use Nelmio\ApiDocBundle\Annotation\ApiDoc;

use Vmc\VisitBundle\Exception\InvalidFormException;
use Vmc\VisitBundle\Form\VisitType;
use Vmc\VisitBundle\Model\VisitInterface;


class VisitController extends FOSRestController
{
    /**
     * List all visits.
     *
     * @ApiDoc(
     *   resource = true,
     *   statusCodes = {
     *     200 = "Returned when successful"
     *   }
     * )
     *
     * @Annotations\QueryParam(name="offset", requirements="\d+", nullable=true, description="Offset from which to start listing visits.")
     * @Annotations\QueryParam(name="limit", requirements="\d+", default="5", description="How many visits to return.")
     *
     * @Annotations\View(
     *  templateVar="visits"
     * )
     *
     * @param Request               $request      the request object
     * @param ParamFetcherInterface $paramFetcher param fetcher service
     *
     * @return array
     */
    public function getVisitsAction(Request $request, ParamFetcherInterface $paramFetcher)
    {
        $offset = $paramFetcher->get('offset');
        $offset = null == $offset ? 0 : $offset;
        $limit = $paramFetcher->get('limit');

        return $this->container->get('ais_visit.visit.handler')->all($limit, $offset);
    }

    /**
     * Get single Visit.
     *
     * @ApiDoc(
     *   resource = true,
     *   description = "Gets a Visit for a given id",
     *   output = "Vmc\VisitBundle\Entity\Visit",
     *   statusCodes = {
     *     200 = "Returned when successful",
     *     404 = "Returned when the visit is not found"
     *   }
     * )
     *
     * @Annotations\View(templateVar="visit")
     *
     * @param int     $id      the visit id
     *
     * @return array
     *
     * @throws NotFoundHttpException when visit not exist
     */
    public function getVisitAction($id)
    {
        $visit = $this->getOr404($id);

        return $visit;
    }

    /**
     * Presents the form to use to create a new visit.
     *
     * @ApiDoc(
     *   resource = true,
     *   statusCodes = {
     *     200 = "Returned when successful"
     *   }
     * )
     *
     * @Annotations\View(
     *  templateVar = "form"
     * )
     *
     * @return FormTypeInterface
     */
    public function newVisitAction()
    {
        return $this->createForm(new VisitType());
    }
    
    /**
     * Presents the form to use to edit visit.
     *
     * @ApiDoc(
     *   resource = true,
     *   statusCodes = {
     *     200 = "Returned when successful"
     *   }
     * )
     *
     * @Annotations\View(
     *  template = "VmcVisitBundle:Visit:editVisit.html.twig",
     *  templateVar = "form"
     * )
     *
     * @param Request $request the request object
     * @param int     $id      the visit id
     *
     * @return FormTypeInterface|View
     *
     * @throws NotFoundHttpException when visit not exist
     */
    public function editVisitAction($id)
    {
		$visit = $this->getVisitAction($id);
		
        return array('form' => $this->createForm(new VisitType(), $visit), 'visit' => $visit);
    }

    /**
     * Create a Visit from the submitted data.
     *
     * @ApiDoc(
     *   resource = true,
     *   description = "Creates a new visit from the submitted data.",
     *   input = "Vmc\VisitBundle\Form\VisitType",
     *   statusCodes = {
     *     200 = "Returned when successful",
     *     400 = "Returned when the form has errors"
     *   }
     * )
     *
     * @Annotations\View(
     *  template = "VmcVisitBundle:Visit:newVisit.html.twig",
     *  statusCode = Codes::HTTP_BAD_REQUEST,
     *  templateVar = "form"
     * )
     *
     * @param Request $request the request object
     *
     * @return FormTypeInterface|View
     */
    public function postVisitAction(Request $request)
    {
        try {
            $newVisit = $this->container->get('ais_visit.visit.handler')->post(
                $request->request->all()
            );

            $routeOptions = array(
                'id' => $newVisit->getId(),
                '_format' => $request->get('_format')
            );

            return $this->routeRedirectView('api_1_get_visit', $routeOptions, Codes::HTTP_CREATED);

        } catch (InvalidFormException $exception) {

            return $exception->getForm();
        }
    }

    /**
     * Update existing visit from the submitted data or create a new visit at a specific location.
     *
     * @ApiDoc(
     *   resource = true,
     *   input = "Vmc\VisitBundle\Form\VisitType",
     *   statusCodes = {
     *     201 = "Returned when the Visit is created",
     *     204 = "Returned when successful",
     *     400 = "Returned when the form has errors"
     *   }
     * )
     *
     * @Annotations\View(
     *  template = "VmcVisitBundle:Visit:editVisit.html.twig",
     *  templateVar = "form"
     * )
     *
     * @param Request $request the request object
     * @param int     $id      the visit id
     *
     * @return FormTypeInterface|View
     *
     * @throws NotFoundHttpException when visit not exist
     */
    public function putVisitAction(Request $request, $id)
    {
        try {
            if (!($visit = $this->container->get('ais_visit.visit.handler')->get($id))) {
                $statusCode = Codes::HTTP_CREATED;
                $visit = $this->container->get('ais_visit.visit.handler')->post(
                    $request->request->all()
                );
            } else {
                $statusCode = Codes::HTTP_NO_CONTENT;
                $visit = $this->container->get('ais_visit.visit.handler')->put(
                    $visit,
                    $request->request->all()
                );
            }

            $routeOptions = array(
                'id' => $visit->getId(),
                '_format' => $request->get('_format')
            );

            return $this->routeRedirectView('api_1_get_visit', $routeOptions, $statusCode);

        } catch (InvalidFormException $exception) {

            return $exception->getForm();
        }
    }

    /**
     * Update existing visit from the submitted data or create a new visit at a specific location.
     *
     * @ApiDoc(
     *   resource = true,
     *   input = "Vmc\VisitBundle\Form\VisitType",
     *   statusCodes = {
     *     204 = "Returned when successful",
     *     400 = "Returned when the form has errors"
     *   }
     * )
     *
     * @Annotations\View(
     *  template = "VmcVisitBundle:Visit:editVisit.html.twig",
     *  templateVar = "form"
     * )
     *
     * @param Request $request the request object
     * @param int     $id      the visit id
     *
     * @return FormTypeInterface|View
     *
     * @throws NotFoundHttpException when visit not exist
     */
    public function patchVisitAction(Request $request, $id)
    {
        try {
            $visit = $this->container->get('ais_visit.visit.handler')->patch(
                $this->getOr404($id),
                $request->request->all()
            );

            $routeOptions = array(
                'id' => $visit->getId(),
                '_format' => $request->get('_format')
            );

            return $this->routeRedirectView('api_1_get_visit', $routeOptions, Codes::HTTP_NO_CONTENT);

        } catch (InvalidFormException $exception) {

            return $exception->getForm();
        }
    }

    /**
     * Fetch a Visit or throw an 404 Exception.
     *
     * @param mixed $id
     *
     * @return VisitInterface
     *
     * @throws NotFoundHttpException
     */
    protected function getOr404($id)
    {
        if (!($visit = $this->container->get('ais_visit.visit.handler')->get($id))) {
            throw new NotFoundHttpException(sprintf('The resource \'%s\' was not found.',$id));
        }

        return $visit;
    }
    
    public function postUpdateVisitAction(Request $request, $id)
    {
		try {
            $visit = $this->container->get('ais_visit.visit.handler')->patch(
                $this->getOr404($id),
                $request->request->all()
            );

            $routeOptions = array(
                'id' => $visit->getId(),
                '_format' => $request->get('_format')
            );

            return $this->routeRedirectView('api_1_get_visit', $routeOptions, Codes::HTTP_NO_CONTENT);

        } catch (InvalidFormException $exception) {

            return $exception->getForm();
        }
	}
}
