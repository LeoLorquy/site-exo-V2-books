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
     * @Route("/admin/book/cree", name="bookcree")
     */
    public function createBook(EntityManagerInterface $entityManager)
    {
        $book = new Book();
        $book->setTitle("star wars rebelion");
        $book->setAuthor("lucas films");
        $book->setNbPages("700");
        $book->setPublishedAt(new \DateTime('1995-12-12'));

        $entityManager->persist($book);
        $entityManager->flush();
        return $this->render("indexcreate.html.twig");
    }


    /**
    * @Route("/book/{id}", name="book")
    */
    public function articleShow($id, BookRepository $bookRepository)
    {
        $book = $bookRepository->find($id);
    
        return $this->render("indexBookView.html.twig", ["book" => $book]);
    }

    /**
    * @Route("/admin/books", name="books")
    */
    public function book(BookRepository $bookRepository) //j'integre mon id
    {
        $books = $bookRepository->findAll();
        return $this->render("indexBooks.html.twig", ["books" => $books]);
    }

    /**
     * @Route("/admin/book/deleted/{id}", name="book_delete")
     */
    public function bookDelete($id, BookRepository $bookRepository, EntityManagerInterface $entityManager)
    {
        //je vais dans la base de donnée puis je recupere l'id
        $book = $bookRepository->find($id);

        //je supprime le book choisit a partire de l'id
        $entityManager->remove($book);
        $entityManager->flush();

        //je renvois l'utilisateur sur la page bookRemove pour l'informer de la supression du livre
        return $this->RedirectToRoute("books");
    }

}