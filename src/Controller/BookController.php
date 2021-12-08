<?php

namespace App\Controller;

use App\Entity\book;
use App\Controller\BookController;
use App\Repository\BookRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Doctrine\ORM\EntityManagerInterface;

class BookController extends AbstractController
{

    /**
     * @Route("/book/cree", name="bookcree")
     */
    public function createBook(EntityManagerInterface $entityManager)
    {
        $book = new Book();
        $book->setTitle("Les thanatonautes");
        $book->setAuthor("Bernard Werber");
        $book->setNbPages("700");
        $book->setPublishedAt(new \DateTime('1995-12-12'));

        $entityManager->persist($book);
        $entityManager->flush();
        return $this->render("indexcreate.html.twig");
    }


            /**
            * @Route("/book/{id}", name="book")
            */
            public function articleShow($id)
            {
            // je cree une erreur qui affiche "cette page existe pas." si l'on utilise un id qui nexiste pas
            if (!array_key_exists($id, $this->books)) {
                throw $this->createNotFoundException('cette page existe pas.');
            }
        
            return $this->render("indexBookView.html.twig", ["book" => $this->books[$id]]);
        }

        /**
        * @Route("/books", name="books")
        */
        public function book($id, BookRepository $bookRepository) //j'integre mon id
        {


            return $this->render("indexBooks.html.twig", ["books" => $books]);
    }

    /**
     * @Route("/book/deleted/{id}", name="book_delete")
     */
    public function bookDelete($id, BookRepository $bookRepository, EntityManagerInterface $entityManager)
    {
        //je vais dans la base de donnée puis je recupere l'id
        $book = $bookRepository->find($id);

        //je supprime le book choisit a partire de l'id
        $entityManager->remove($book);
        $entityManager->flush();

        //je renvois l'utilisateur sur la page bookRemove pour l'informer de la supression du livre
        return $this->render("bookRemove.html.twig");
    }

}