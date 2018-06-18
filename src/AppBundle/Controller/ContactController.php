<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Contact;
use AppBundle\Form\ContactType;
use Doctrine\ORM\EntityManagerInterface;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

/**
 * Class ContactController
 *
 * @package AppBundle\Controller
 */
class ContactController extends Controller
{
    /**
     * @var EntityManagerInterface
     */
    private $em;

    /**
     * ContactController constructor.
     *
     * @param EntityManagerInterface $em
     */
    public function __construct(EntityManagerInterface $em)
    {
        $this->em = $em;
    }

    /**
     * Presents the home page listing the contacts
     *
     * @Route("/", name="home")
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function indexAction(Request $request)
    {
        $contacts = $this->em->getRepository(Contact::class)->findAllOrderedByLastName();

        return $this->render('contact/index.html.twig',
            [
                'contacts' => $contacts,
            ]);
    }

    /**
     * Presents the page to add a new contact
     *
     * @Route("/phone_book/contact/add", name="phone_book_contact_add")
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function addAction(Request $request)
    {
        $contact = new Contact();
        $form    = $this->createForm(ContactType::class, $contact);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $this->em->persist($contact);
            $this->em->flush();

            $this->addFlash('notification-success', 'A new contact has been added!');

            return $this->redirectToRoute('home');
        }

        return $this->render(":contact:add.html.twig", array(
            'form' => $form->createView(),
        ));
    }

}
