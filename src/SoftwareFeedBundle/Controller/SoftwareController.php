<?php

namespace SoftwareFeedBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use SoftwareFeedBundle\Entity\Software;
use SoftwareFeedBundle\Form\SoftwareType;
use Cocur\Slugify\Slugify;

/**
 * Software controller.
 *
 * @Route("/software")
 */
class SoftwareController extends Controller
{
    /**
     * Lists all Software entities.
     *
     * @Route("/", name="software_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $softwares = $em->getRepository('SoftwareFeedBundle:Software')->findAll();

        return $this->render('software/index.html.twig', array(
            'softwares' => $softwares,
        ));
    }

    /**
     * Creates a new Software entity.
     *
     * @Route("/new", name="software_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $software = new Software();
        $form = $this->createForm('SoftwareFeedBundle\Form\SoftwareType', $software);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

        	$slugify = new Slugify();
            $software->setSlug($slugify->slugify($software->getName()));

        	$file = $software->getLogo();

            // Generate a unique name for the file before saving it
            $fileName = md5(uniqid()).'.'.$file->guessExtension();

            // Move the file to the directory where logos are stored
            $logoDir = $this->container->getParameter('kernel.root_dir').'/../web/uploads/logos';
            $file->move($logoDir, $fileName);

            // Update the 'logo' property to store the PDF file name
            // instead of its contents
            $software->setLogo($fileName);

            $em = $this->getDoctrine()->getManager();
            $em->persist($software);
            $em->flush();

            return $this->redirectToRoute('software_show', array('id' => $software->getId()));
        }

        return $this->render('software/new.html.twig', array(
            'software' => $software,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a Software entity.
     *
     * @Route("/{slug}", name="software_show")
     * @Method("GET")
     */
    public function showAction(Software $software)
    {
        $deleteForm = $this->createDeleteForm($software);

        return $this->render('software/show.html.twig', array(
            'software' => $software,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing Software entity.
     *
     * @Route("/{slug}/edit", name="software_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, Software $software)
    {
        $deleteForm = $this->createDeleteForm($software);
        $editForm = $this->createForm('SoftwareFeedBundle\Form\SoftwareType', $software);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($software);
            $em->flush();

            return $this->redirectToRoute('software_edit', array('slug' => $software->getId()));
        }

        return $this->render('software/edit.html.twig', array(
            'software' => $software,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a Software entity.
     *
     * @Route("/{slug}", name="software_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, Software $software)
    {
        $form = $this->createDeleteForm($software);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($software);
            $em->flush();
        }

        return $this->redirectToRoute('software_index');
    }

    /**
     * Creates a form to delete a Software entity.
     *
     * @param Software $software The Software entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Software $software)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('software_delete', array('slug' => $software->getSlug())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
