<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\StorageFile;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Core\Security;
use App\Repository\StorageFileRepository;
use Symfony\Component\HttpFoundation\BinaryFileResponse;
use Symfony\Component\HttpFoundation\ResponseHeaderBag;
class StorageController extends AbstractController
{


    public function __construct(string $publicPath){
        $this->publicPath = $publicPath;
    }
    /**
     * @param Security $security
     * @Route("/api/file", name="file_post", methods={"POST"})
     */
    public function uploadFile(Request $request, Security $security){
        try {
            $file = $request->files->get('file');
            $fileName = md5 ( uniqid () ) . '.' . $file->guessExtension();
            $original_name = $file->getClientOriginalName ();
            $file_size = $file->getSize().' bytes';
            $file->move ( $this->publicPath, $fileName );
            $file_entity = new StorageFile ();
            $file_entity->setFileName ( $fileName );
            $file_entity->setActualName ( $original_name );
            $file_entity->setSize($file_size);

            $manager = $this->getDoctrine ()->getManager ();
            $manager->persist ( $file_entity );
            $manager->flush ();
            $array = array (
                'status' => "file uploaded successfully",
                'file_id' => $file_entity->getId()
            );
            $response = new JsonResponse ( $array, 200 );
            return $response;
        } catch ( Exception $e ) {
            $array = array('status'=> 0 );
            $response = new JsonResponse($array, 400);
            return $response;
        }
    }

    /**
     * @param StorageFileRepository $storageFileRepository
     * @param $id
     * @Route("/api/file/{id}", name="file_get", methods={"GET"})
     * @return BinaryFileResponse|JsonResponse
     */
    public function downloadAction(StorageFileRepository $storageFileRepository, $id) {
        try {
            $file = $storageFileRepository->find ( $id );
            if (! $file) {
                $array = array (
                    'status' => 0,
                    'message' => 'File does not exist'
                );
                $response = new JsonResponse ( $array, 200 );
                return $response;
            }
            $displayName = $file->getActualName ();
            $fileName = $file->getFileName ();
            $file_with_path = $this->publicPath . "/" . $fileName;
            $response = new BinaryFileResponse ( $file_with_path );
            $response->headers->set ( 'Content-Type', 'text/plain' );
            $response->setContentDisposition ( ResponseHeaderBag::DISPOSITION_ATTACHMENT, $displayName );
            return $response;
        } catch ( Exception $e ) {
            $array = array (
                'status' => 0,
                'message' => 'Download error'
            );
            $response = new JsonResponse ( $array, 400 );
            return $response;
        }
    }

    /**
     * @param StorageFileRepository $storageFileRepository
     * @Route ("/api/file", name="files_get", methods={"GET"})
     * @return JsonResponse
     */
    public function showFiles(StorageFileRepository $storageFileRepository){
        $data = $storageFileRepository->findAll();
        return new JsonResponse($data, 200);
    }

    /**
     * @param StorageFileRepository $storageFileRepository
     * @param $id
     * @Route ("/api/file/{id}", name="file_delete", methods={"DELETE"})
     * @return JsonResponse
     */
    public function deleteFile(StorageFileRepository $storageFileRepository,$id){

        $myfile = $storageFileRepository->find($id);

        if (!$myfile){
            $data = [
                'status' => 404,
                'errors' => "File not found"
            ];
            return new JsonResponse($data,404);
        }

        $filepath = $this->publicPath."/".$myfile->getFilename();
        unlink($filepath); // удаление в файловой системе

        $manager = $this->getDoctrine()->getManager();
        $manager->remove($myfile);
        $manager->flush();
        $data = [
            'status' => 200,
            'errors' => "File deleted successfully",
        ];
        return new JsonResponse($data, 200);
    }
}
