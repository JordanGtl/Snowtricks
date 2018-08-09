<?php
namespace App\Controller;

use App\Entity\Member;
use App\Form\LoginType;
use App\Form\MemberType;
use App\Form\PasswordChangeType;
use App\Form\PasswordLostType;
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

    /**
     * @Route("/LostPassword", name="app_account_lostpassword")
     */
    public function lostpassword(Request $request, EntityManagerInterface $em)
    {
        $form = $this->createForm(PasswordLostType::class);
        $message = '';

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid())
        {
            $repouser = $em->getRepository(Member::class);
            $user = $repouser->findOneBy(['email' => $form->getViewData()['email']]);

            if($user == null)
                $message = 'Aucun utilisateur trouvé';
            else
            {
                $message = 'Un email à été envoyé à l\'adresse mail saisie pour modifier votre mot de passe';
                $user->setPasswordtoken(md5(uniqid()));
                $em->flush();
                // TODO Envoie du mail quand j'aurais internet ...
            }
        }

        return $this->render('member/passwordlostform.html.twig', [
            'form' => $form->createView(),
            'message' => $message
        ]);
    }

    /**
     * @Route("/PasswordChange/{token}", name="app_account_passwordchange")
     */
    public function passwordchange($token, Request $request, EntityManagerInterface $em, UserPasswordEncoderInterface $passwordEncoder)
    {
        $repouser = $em->getRepository(Member::class);
        $user = $repouser->findOneBy(['passwordtoken' => $token]);
        $message = '';
        $form = null;
        $status = false;

        if($user == null)
        {
            $message = 'Une erreur est survenue, aucun utilisateur trouvé pour le token renseigné.';
        }
        else
        {
            $form = $this->createForm(PasswordChangeType::class);
            $form->handleRequest($request);

            if ($form->isSubmitted() && $form->isValid())
            {
                $password = $passwordEncoder->encodePassword($user, $form->getViewData()['plainPassword']);
                $user->setPassword($password);
                $user->setPasswordtoken('');
                $em->flush();

                $form = null;
                $status = true;
                $message = 'Modification éffectué, vous pouvez vous connecter avec le nouveau mot de passe.';
            }
        }

        return $this->render('member/passwordchange.html.twig', [
            'message' => $message,
            'status' => $status,
            'form' => ($form == null) ? null : $form->createView(),
        ]);
    }
}