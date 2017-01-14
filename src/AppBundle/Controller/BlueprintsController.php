<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Blueprint;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

class BlueprintsController extends Controller {
    private function getBlueprint($id) {
        $blueprint = $this->getDoctrine()
            ->getRepository('AppBundle:Blueprint')
            ->find($id);

        if (!$blueprint) {
            throw $this->createNotFoundException('No blueprint found for id ' . $id);
        }

        return $blueprint;
    }

    private function handleFormRequest(Request $request, $form) {
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $blueprint = $form->getData();

            // Persist
            $em = $this->getDoctrine()->getManager();
            $em->persist($blueprint);
            $em->flush();

            return $this->redirectToRoute("show_blueprint", array('id' => $blueprint->getId()));
        }

        return $this->render('blueprint/form.html.twig', array('form' => $form->createView()));
    }

	/**
	* @Route("/blueprints/new")
	*/
	public function new(Request $request) {
		$blueprint = new Blueprint();

		$form = $this->createFormBuilder($blueprint)
			->add('name', TextType::class)
			->add('groupSize', IntegerType::class)
            ->add('roles', TextType::class, array('required' => false))
            ->add('save', SubmitType::class, array('label' => 'Create blueprint'))
            ->getForm();

        return $this->handleFormRequest($request, $form);
	}

    /**
    * @Route("/blueprints/show/{id}", name="show_blueprint")
    */
    public function show($id) {
        $blueprint = $this->getBlueprint($id);

        return $this->render('blueprint/show.html.twig', array('blueprint' => $blueprint));
    }

    /**
     * @Route("/blueprints/edit/{id}", name="edit_blueprint")
     * @ParamConverter("blueprint", class="AppBundle:Blueprint")
     */
    public function edit(Request $request, Blueprint $blueprint) {
        $form = $this->createFormBuilder($blueprint)
            ->add('name', TextType::class)
            ->add('groupSize', IntegerType::class)
            ->add('roles', TextType::class, array('required' => false))
            ->add('save', SubmitType::class, array('label' => 'Update blueprint'))
            ->getForm();

        return $this->handleFormRequest($request, $form);
    }

	/**
	* @Route("/blueprints/list")
	*/
	public function list() {
		$blueprints = $this->getDoctrine()->getRepository('AppBundle:Blueprint')->findAll();

		// Display on page
        return $this->render('blueprint/list.html.twig', array('blueprints' => $blueprints));
	}
}