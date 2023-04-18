<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class TodoController extends AbstractController
{
    #[Route('/todo', name: 'app_todo')]
    public function index(Request $request): Response
    {
        $session = $request->getSession();

        if(!$session->has('todos')){
            $todos = [
                'achat' => 'acheter cles usb', 
                'cours' => 'finaliser mon cours', 
                'correction' => 'corriger mes examens'
            ];
            $session->set('todos', $todos);
            $this->addFlash('info',"la liste des todos viens d'être initialisée" );
        } 
        return $this->render('todo/index.html.twig');
    }
    #[Route('/todo/add/{name}/{content}', name: 'todo.add', defaults:['name' => 'todo','content' => "contenut"])]
    public function addTodo(Request $request, $name, $content):RedirectResponse {
        $session = $request->getSession();
        if($session->has('todos')){
            $todos = $session->get('todos');
            if(isset($todos[$name])){
                $this->addFlash('error',"il existe déja dans la liste" );
            } else {
                $todos[$name]=$content;
                $session->set('todos', $todos);
                $this->addFlash('sucess',"il a été ajouter avec succes" );
            }
        } else {
            $this->addFlash('error',"la liste n'est pas encore initialisée" );
        }
        return $this->redirectToRoute('app_todo');
    }
    #[Route('/todo/update/{name}/{content}', name: 'todo.update')]
    public function updateTodo(Request $request, $name, $content):RedirectResponse {
        $session = $request->getSession();
        if($session->has('todos')){
            $todos = $session->get('todos');
            if(!isset($todos[$name])){
                $this->addFlash('error',"il existe pas dans la liste" );
            } else {
                $todos[$name]=$content;
                $session->set('todos', $todos);
                $this->addFlash('sucess',"il a été modofier avec succes" );
            }
        } else {
            $this->addFlash('error',"la liste n'est pas encore initialisée");
        }
        return $this->redirectToRoute('app_todo');
    }
    #[Route('/todo/delete/{name}', name: 'todo.delete')]
    public function deleteTodo(Request $request, $name):RedirectResponse {
        $session = $request->getSession();
        if($session->has('todos')){
            $todos = $session->get('todos');
            if(!isset($todos[$name])){
                $this->addFlash('error',"il existe pas dans la liste" );
            } else {
                unset($todos[$name]);
                $session->set('todos', $todos);
                $this->addFlash('sucess',"il a été supprimer avec succes" );
            }
        } else {
            $this->addFlash('error',"la liste n'est pas encore initialisée");
        }
        return $this->redirectToRoute('app_todo');
    }
    #[Route('/todo/reset', name: 'todo.reset')]
    public function resetTodo(Request $request):RedirectResponse {
        $session = $request->getSession();
        $session->remove('todos');
        return $this->redirectToRoute('app_todo');
    }
    #[Route('/multiplication/{entier1}/{entier2}')]
    public function multiplication(int $entier1, int $entier2){
        $result = $entier1 * $entier2;
        return new Response("<h1>$result</h1>");
    }
}
