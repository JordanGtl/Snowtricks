<?php
namespace App\Controller;

use App\Entity\Member;
use App\Form\LoginType;
use App\Form\MemberType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;

class MemberController extends AbstractController
{
    /**
     * @Route("/register", name="app_register")
     */
    public function register(Request $request, UserPasswordEncoderInterface $passwordEncoder)
    {
        $user = $this->getUser();

        if($user != null)
           return $this->redirectToRoute('homepage');

        // 1) build the form
        $user = new Member();
        $form = $this->createForm(MemberType::class, $user);

        // 2) handle the submit (will only happen on POST)
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid())
        {

            // 3) Encode the password (you could also do this via Doctrine listener)
            $password = $passwordEncoder->encodePassword($user, $user->getPlainPassword());
            $user->setPassword($password);
            $user->setActive(false);
            $user->setValidationtoken(md5(uniqid()));

            // TODO : Envois du mail quand j'aurais une connexion internet ....

            // 4) save the User!
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($user);
            $entityManager->flush();

            return $this->redirectToRoute('app_login');
        }

        return $this->render('member/register.html.twig', array('form' => $form->createView()));
    }

    /**
     * @Route("/login", name="app_login")
     */
    public function login(Request $request, AuthenticationUtils $authenticationUtils)
    {
        $user = $this->getUser();

        if($user != null)
            return $this->redirectToRoute('homepage');

        // get the login error if there is one
        $error = $authenticationUtils->getLastAuthenticationError();

        // last username entered by the user
        $lastUsername = $authenticationUtils->getLastUsername();
        $form = $this->createForm(LoginType::class);

        return $this->render('member/login.html.twig', array(
            'last_username' => $lastUsername,
            'error'         => $error,
            'form'          => $form->createView(),
        ));
    }

    /**
     * @Route("/Activate/{token}", name="app_account_active")
     */
    public function accountactive($token, EntityManagerInterface $em)
    {
        $repo = $em->getRepository(Member::class);
        $user = $repo->findOneBy(['validationtoken' => $token]);

        if($user == null)
        {
            return $this->render('member/activate.html.twig', array(
                'message' => 'Aucun compte trouvé avec le token de validation'
            ));
        }
        else
        {
            $user->setActive(true);
            $user->setValidationtoken('');
            $em->flush();

            return $this->render('member/activate.html.twig', array(
                'message' => 'Le compte à été activé, vous pouvez vous connecter'
            ));
        }
    }

    /**
     * @Route("/logout", name="app_logout")
     */
    public function logoutAction()
    {
        throw new \Exception('this should not be reached!');
    }
}