<?php
/**
 * Created by PhpStorm.
 * User: hicham benkachoud
 * Date: 02/01/2020
 * Time: 22:44
 */

namespace App\Controller;


use App\Entity\ToDo;
use App\Repository\ToDoRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Security;

/**
 * Class ToDoController
 * @package App\Controller
 * @Route("/api", name="todo_api")
 */
class ToDoController extends AbstractController
{
    /**
     * @param ToDoRepository $todoRepository
     * @param Security $security
     * @return JsonResponse
     * @Route("/todo", name="todos_get", methods={"GET"})
     */

    public function getTodos(ToDoRepository $todoRepository, Security $security){
        $data = $todoRepository->findBy(["user" => $security->getUser()->getUsername()]);
        return $this->response($data);
    }

    /**
     * @param Request $request
     * @param EntityManagerInterface $entityManager
     * @param ToDoRepository $todoRepository
     * @param Security $security
     * @return JsonResponse
     * @throws \Exception
     * @Route("/todo", name="todo_add", methods={"POST"})
     */
    public function addTodo(Request $request, EntityManagerInterface $entityManager, ToDoRepository $todoRepository, Security $security){

        try{
            $request = $this->transformJsonBody($request);

            if (!$request || !$request->get('name')){
                throw new \Exception();
            }

            $todo = new Todo();
            $todo->setName($request->get('name'));
            $todo->setUser($security->getUser()->getUsername());
            $entityManager->persist($todo);
            $entityManager->flush();

            $data = [
                'status' => 200,
                'success' => "Post added successfully",
            ];
            return $this->response($data);

        }catch (\Exception $e){
            $data = [
                'status' => 422,
                'errors' => "Data no valid",
            ];
            return $this->response($data, 422);
        }

    }


    /**
     * @param ToDoRepository $todoRepository
     * @param Security $security
     * @param $id
     * @return JsonResponse
     * @Route("/todo/{id}", name="todo_get", methods={"GET"})
     */
    public function getPost(ToDoRepository $todoRepository, Security $security,$id){
        $todo = $todoRepository->find($id);

        if (!$todo){
            $data = [
                'status' => 404,
                'errors' => "Post not found",
            ];
            return $this->response($data, 404);
        }
        if ($todo->getUser() != $security->getUser()->getUsername()){
            $data = [
                'status' => 404,
                'errors' => "This is not your todo",
            ];
            return $this->response($data, 404);
        }
        return $this->response($todo);
    }

    /**
     * @param Request $request
     * @param EntityManagerInterface $entityManager
     * @param ToDoRepository $todoRepository
     * @param Security $security
     * @param $id
     * @return JsonResponse
     * @Route("/todo/{id}", name="todo_put", methods={"PUT"})
     */
    public function updatePost(Request $request, EntityManagerInterface $entityManager, ToDoRepository $todoRepository,Security $security, $id){

        try{
            $todo = $todoRepository->find($id);

            if (!$todo){
                $data = [
                    'status' => 404,
                    'errors' => "Post not found",
                ];
                return $this->response($data, 404);
            }
            if ($todo->getUser() != $security->getUser()->getUsername()){
                $data = [
                    'status' => 404,
                    'errors' => "This is not your todo",
                ];
                return $this->response($data, 404);
            }
            $request = $this->transformJsonBody($request);

            if (!$request || !$request->get('name')){
                throw new \Exception();
            }

            $todo->setName($request->get('name'));
            $entityManager->flush();

            $data = [
                'status' => 200,
                'errors' => "Post updated successfully",
            ];
            return $this->response($data);

        }catch (\Exception $e){
            $data = [
                'status' => 422,
                'errors' => "Data no valid",
            ];
            return $this->response($data, 422);
        }

    }


    /**
     * @param ToDoRepository $todoRepository
     * @param Security $security
     * @param $id
     * @return JsonResponse
     * @Route("/todo/{id}", name="todo_delete", methods={"DELETE"})
     */
    public function deletePost(EntityManagerInterface $entityManager, ToDoRepository $todoRepository,Security $security, $id){
        $todo = $todoRepository->find($id);

        if (!$todo){
            $data = [
                'status' => 404,
                'errors' => "Post not found",
            ];
            return $this->response($data, 404);
        }
        if ($todo->getUser() != $security->getUser()->getUsername()){
            $data = [
                'status' => 404,
                'errors' => "This is not your todo",
            ];
            return $this->response($data, 404);
        }
        $entityManager->remove($todo);
        $entityManager->flush();
        $data = [
            'status' => 200,
            'errors' => "Post deleted successfully",
        ];
        return $this->response($data);
    }


    /**
     * Returns a JSON response
     *
     * @param array $data
     * @param $status
     * @param array $headers
     * @return JsonResponse
     */
    public function response($data, $status = 200, $headers = [])
    {
        return new JsonResponse($data, $status, $headers);
    }

    protected function transformJsonBody(\Symfony\Component\HttpFoundation\Request $request)
    {
        $data = json_decode($request->getContent(), true);

        if ($data === null) {
            return $request;
        }

        $request->request->replace($data);

        return $request;
    }

}