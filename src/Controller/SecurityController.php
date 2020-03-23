<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\Common\Persistence\ObjectManager;
use App\Entity\User;
use App\Form\UserType;

class SecurityController extends AbstractController
{

    public function login(AuthenticationUtils $authenticationUtils): Response
    {
        // if ($this->getUser()) {
        //     return $this->redirectToRoute('target_path');
        // }

        // get the login error if there is one
        $error = $authenticationUtils->getLastAuthenticationError();
        // last username entered by the user
        $lastUsername = $authenticationUtils->getLastUsername();

        return $this->render('security/login.html.twig', ['last_username' => $lastUsername, 'error' => $error]);
    }



    public function logout()
    {

    }



    public function register(Request $request, ObjectManager $manager, UserPasswordEncoderInterface $encoder)
    {
        //Création d'un utilisateur vide
        $user = new User();

        //Création du formulaire permettant de saisir un utilisateur
        $formulaireUser = $this->createForm(UserType::class, $user);

        /* On demande au formulaire d'analyser la dernière requête Http. Si le tableau POST contenu dans cette requête contient
        des variables nom, prenom, etc. Alors la méthode handleRequest() recupère les valeurs de ces variables et les
        affecte à l'objet $entreprise. */
        $formulaireUser->handleRequest($request);

        if ($formulaireUser->isSubmitted() && $formulaireUser->isValid())
        {
            //Attribuer un rôle à l'utilisateur
            $user->setRoles(['ROLE_USER']);

            //Encoder le mot de passe de l'utilisateur
            $encodedPassword = $encoder->encodePassword($user, $user->getPassword());
            $user->setPassword($encodedPassword);

            //Enregistrer l'utilisateur en base de données
            $manager->persist($user);
            $manager->flush();

            //Rediriger l'utilisateur vers la page d'accueil
            return $this->redirectToRoute('app_login');
        }

        //Afficher la page présentant le formulaire d'inscription
        return $this->render('security/inscription.html.twig', ['vueFormulaire' => $formulaireUser->createView()]);
    }
}
