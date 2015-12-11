<?php

namespace Vmc\VisitBundle\Tests\Handler;

use Vmc\VisitBundle\Handler\VisitHandler;
use Vmc\VisitBundle\Model\VisitInterface;
use Vmc\VisitBundle\Entity\Visit;

class VisitHandlerTest extends \PHPUnit_Framework_TestCase
{
    const DOSEN_CLASS = 'Vmc\VisitBundle\Tests\Handler\DummyVisit';

    /** @var VisitHandler */
    protected $visitHandler;
    /** @var \PHPUnit_Framework_MockObject_MockObject */
    protected $om;
    /** @var \PHPUnit_Framework_MockObject_MockObject */
    protected $repository;

    public function setUp()
    {
        if (!interface_exists('Doctrine\Common\Persistence\ObjectManager')) {
            $this->markTestSkipped('Doctrine Common has to be installed for this test to run.');
        }
        
        $class = $this->getMock('Doctrine\Common\Persistence\Mapping\ClassMetadata');
        $this->om = $this->getMock('Doctrine\Common\Persistence\ObjectManager');
        $this->repository = $this->getMock('Doctrine\Common\Persistence\ObjectRepository');
        $this->formFactory = $this->getMock('Symfony\Component\Form\FormFactoryInterface');

        $this->om->expects($this->any())
            ->method('getRepository')
            ->with($this->equalTo(static::DOSEN_CLASS))
            ->will($this->returnValue($this->repository));
        $this->om->expects($this->any())
            ->method('getClassMetadata')
            ->with($this->equalTo(static::DOSEN_CLASS))
            ->will($this->returnValue($class));
        $class->expects($this->any())
            ->method('getName')
            ->will($this->returnValue(static::DOSEN_CLASS));
    }


    public function testGet()
    {
        $id = 1;
        $visit = $this->getVisit();
        $this->repository->expects($this->once())->method('find')
            ->with($this->equalTo($id))
            ->will($this->returnValue($visit));

        $this->visitHandler = $this->createVisitHandler($this->om, static::DOSEN_CLASS,  $this->formFactory);

        $this->visitHandler->get($id);
    }

    public function testAll()
    {
        $offset = 1;
        $limit = 2;

        $visits = $this->getVisits(2);
        $this->repository->expects($this->once())->method('findBy')
            ->with(array(), null, $limit, $offset)
            ->will($this->returnValue($visits));

        $this->visitHandler = $this->createVisitHandler($this->om, static::DOSEN_CLASS,  $this->formFactory);

        $all = $this->visitHandler->all($limit, $offset);

        $this->assertEquals($visits, $all);
    }

    public function testPost()
    {
        $title = 'title1';
        $body = 'body1';

        $parameters = array('title' => $title, 'body' => $body);

        $visit = $this->getVisit();
        $visit->setTitle($title);
        $visit->setBody($body);

        $form = $this->getMock('Vmc\VisitBundle\Tests\FormInterface'); //'Symfony\Component\Form\FormInterface' bugs on iterator
        $form->expects($this->once())
            ->method('submit')
            ->with($this->anything());
        $form->expects($this->once())
            ->method('isValid')
            ->will($this->returnValue(true));
        $form->expects($this->once())
            ->method('getData')
            ->will($this->returnValue($visit));

        $this->formFactory->expects($this->once())
            ->method('create')
            ->will($this->returnValue($form));

        $this->visitHandler = $this->createVisitHandler($this->om, static::DOSEN_CLASS,  $this->formFactory);
        $visitObject = $this->visitHandler->post($parameters);

        $this->assertEquals($visitObject, $visit);
    }

    /**
     * @expectedException Vmc\VisitBundle\Exception\InvalidFormException
     */
    public function testPostShouldRaiseException()
    {
        $title = 'title1';
        $body = 'body1';

        $parameters = array('title' => $title, 'body' => $body);

        $visit = $this->getVisit();
        $visit->setTitle($title);
        $visit->setBody($body);

        $form = $this->getMock('Vmc\VisitBundle\Tests\FormInterface'); //'Symfony\Component\Form\FormInterface' bugs on iterator
        $form->expects($this->once())
            ->method('submit')
            ->with($this->anything());
        $form->expects($this->once())
            ->method('isValid')
            ->will($this->returnValue(false));

        $this->formFactory->expects($this->once())
            ->method('create')
            ->will($this->returnValue($form));

        $this->visitHandler = $this->createVisitHandler($this->om, static::DOSEN_CLASS,  $this->formFactory);
        $this->visitHandler->post($parameters);
    }

    public function testPut()
    {
        $title = 'title1';
        $body = 'body1';

        $parameters = array('title' => $title, 'body' => $body);

        $visit = $this->getVisit();
        $visit->setTitle($title);
        $visit->setBody($body);

        $form = $this->getMock('Vmc\VisitBundle\Tests\FormInterface'); //'Symfony\Component\Form\FormInterface' bugs on iterator
        $form->expects($this->once())
            ->method('submit')
            ->with($this->anything());
        $form->expects($this->once())
            ->method('isValid')
            ->will($this->returnValue(true));
        $form->expects($this->once())
            ->method('getData')
            ->will($this->returnValue($visit));

        $this->formFactory->expects($this->once())
            ->method('create')
            ->will($this->returnValue($form));

        $this->visitHandler = $this->createVisitHandler($this->om, static::DOSEN_CLASS,  $this->formFactory);
        $visitObject = $this->visitHandler->put($visit, $parameters);

        $this->assertEquals($visitObject, $visit);
    }

    public function testPatch()
    {
        $title = 'title1';
        $body = 'body1';

        $parameters = array('body' => $body);

        $visit = $this->getVisit();
        $visit->setTitle($title);
        $visit->setBody($body);

        $form = $this->getMock('Vmc\VisitBundle\Tests\FormInterface'); //'Symfony\Component\Form\FormInterface' bugs on iterator
        $form->expects($this->once())
            ->method('submit')
            ->with($this->anything());
        $form->expects($this->once())
            ->method('isValid')
            ->will($this->returnValue(true));
        $form->expects($this->once())
            ->method('getData')
            ->will($this->returnValue($visit));

        $this->formFactory->expects($this->once())
            ->method('create')
            ->will($this->returnValue($form));

        $this->visitHandler = $this->createVisitHandler($this->om, static::DOSEN_CLASS,  $this->formFactory);
        $visitObject = $this->visitHandler->patch($visit, $parameters);

        $this->assertEquals($visitObject, $visit);
    }


    protected function createVisitHandler($objectManager, $visitClass, $formFactory)
    {
        return new VisitHandler($objectManager, $visitClass, $formFactory);
    }

    protected function getVisit()
    {
        $visitClass = static::DOSEN_CLASS;

        return new $visitClass();
    }

    protected function getVisits($maxVisits = 5)
    {
        $visits = array();
        for($i = 0; $i < $maxVisits; $i++) {
            $visits[] = $this->getVisit();
        }

        return $visits;
    }
}

class DummyVisit extends Visit
{
}
