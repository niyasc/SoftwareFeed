<?php 

namespace SoftwareFeedBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use SoftwareFeedBundle\Entity\SoftwareType;
use SoftwareFeedBundle\Form\SoftwareTypeType;
use Cocur\Slugify\Slugify;
use Doctrine\DBAL\Exception\UniqueConstraintViolationException;

/**
 * SoftwareType controller.
 *
 * @Route("/softwaretype")
 */
class SoftwareTypeController extends Controller {
    /**
     * Lists all SoftwareType entities.
     *
     * @Route("/", name="softwaretype_index")
     * @Method("GET")
     */
    public function indexAction() {
        $em = $this->getDoctrine()->getManager();

        $softwareTypes = $em->getRepository('SoftwareFeedBundle:SoftwareType')->findAll();

        return $this->render('softwaretype/index.html.twig', array('softwareTypes' => $softwareTypes, ));
    }

    /**
     * Creates a new SoftwareType entity.
     *
     * @Route("/new", name="softwaretype_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request) {

	$this->denyAccessUnlessGranted('ROLE_ADMIN', null, 'Unable to access this page!');
		
        $softwareType = new SoftwareType();
        $form = $this->createForm('SoftwareFeedBundle\Form\SoftwareTypeType', $softwareType);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();

            //set slug
            $slugify = new Slugify();
            $softwareType->setSlug($slugify->slugify($softwareType->getName()));
            $em->persist($softwareType);
            $em->flush();
            return $this->redirectToRoute('softwaretype_show', array('slug' => $softwareType->getSlug()));
        }

        return $this->render('softwaretype/new.html.twig', array('softwareType' => $softwareType, 'form' => $form->createView(), ));
    }

    /**
     * Finds and displays a SoftwareType entity.
     *
     * @Route("/{slug}", name="softwaretype_show")
     * @Method("GET")
     */
    public function showAction(SoftwareType $softwareType) {
        $deleteForm = $this->createDeleteForm($softwareType);

        return $this->render('softwaretype/show.html.twig', array('softwareType' => $softwareType, 'delete_form' => $deleteForm->createView(), ));
    }

    /**
     * Displays a form to edit an existing SoftwareType entity.
     *
     * @Route("/{slug}/edit", name="softwaretype_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, SoftwareType $softwareType) {
	$this->denyAccessUnlessGranted('ROLE_ADMIN', null, 'Unable to access this page!');
		
        $deleteForm = $this->createDeleteForm($softwareType);
        $editForm = $this->createForm('SoftwareFeedBundle\Form\SoftwareTypeType', $softwareType);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($softwareType);
            $em->flush();
            return $this->redirectToRoute('softwaretype_edit', array('slug' => $softwareType->getSlug()));
        }

        return $this->render('softwaretype/edit.html.twig', array('softwareType' => $softwareType, 'edit_form' => $editForm->createView(), 'delete_form' => $deleteForm->createView(), ));
    }

    /**
     * Deletes a SoftwareType entity.
     *
     * @Route("/{slug}", name="softwaretype_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, SoftwareType $softwareType) {
    	$this->denyAccessUnlessGranted('ROLE_ADMIN', null, 'Unable to access this page!');

        $form = $this->createDeleteForm($softwareType);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($softwareType);
            $em->flush();
        }

        return $this->redirectToRoute('softwaretype_index');
    }

    /**
     * Creates a form to delete a SoftwareType entity.
     *
     * @param SoftwareType $softwareType The SoftwareType entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(SoftwareType $softwareType) {
        return $this->createFormBuilder()->setAction($this->generateUrl('softwaretype_delete', array('slug' => $softwareType->getSlug())))->setMethod('DELETE')->getForm();
    }
}
