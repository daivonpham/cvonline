<?php
namespace App\Controllers;
use App\services\CVService;
use App\services\JwtService;
use App\Models\TemplateModel;
use App\Models\CVModel;

class CVController
{

    private $jwtService;

    private $cvService;
    public function __construct()
    {
        $this->cvService = new CVService();
        $this->jwtService = new JwtService();
    }



    public function createCV()
    {

        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $result = $this->cvService->createCV($_POST);

            if (!$result['success']) {
                $errors = $result['errors'];
                var_dump($errors);
                $oldData = $_POST;
                with('error', 'Tạo CV thất bại!');
                render('index', [
                    'template' => '/mycv/cv',
                    'errors' => $errors,
                    'oldData' => $oldData,
                ]);

                exit;
            }
            with('success', 'Tạo CV thành công!');
            render('index', [
                'template' => '/MyCV/allcv',

            ]);
            exit;
        }
        render('index', ['template' => '/mycv/cv']);
    }


    public function updateTemplateCV()
    {

        $TemplateModel = new TemplateModel();
        $CVModel = new CVModel();
        $userId = $this->jwtService->getUserId();
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $result = $this->cvService->updateTemplateCV($_POST['cv_id'] ?? '', $_POST['template_id'] ?? '');

            if (!$result['success']) {
                $errors = $result['errors'];
                $oldData = $_POST;
                with('error', 'Cập nhật giao diện thất bại!');
                render('index', [
                    'template' => '/MyCV/template',
                    'errors' => $errors,
                    'oldData' => $oldData,
                    'templates' => $TemplateModel->getAll(),
                    'namecv' => $CVModel->getCVById($userId),
                ]);
                exit;
            }
            with('success', 'Cập nhật giao diện thành công!');
            render('index', [
                'template' => '/MyCV/template',
                'templates' => $TemplateModel->getAll(),
                'namecv' => $CVModel->getCVById($userId),
            ]);
            exit;
        }
        render('index', ['template' => '/MyCV/template']);
    }

    public function editcv($id)
    {
        if (is_array($id) && isset($id['id'])) {
            $id = (int) $id['id'];
        } else {
            $id = (int) $id;
        }
        $CVModel = new CVModel();
        $userId = $this->jwtService->getUserId();
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $result = $this->cvService->updateCV($id, $_POST);
            if (!$result['success']) {
                $errors = $result['errors'];
                $oldData = $_POST;
                $cvData = $this->cvService->getCVForEdit($id);
                with('error', 'Cập nhật CV thất bại!');
                render('index', [
                    'template' => '/MyCV/editcv',
                    'errors' => $errors,
                    'oldData' => $oldData,
                    'cv' => $cvData,
                ]);
                exit;
            }
            with('success', 'Cập nhật CV thành công!');
            render('index', [
                'template' => '/MyCV/allcv',
                'cv' => $CVModel->getAllCVById($userId),
            ], '/allcv'); 
            exit;
        }
        $cvData = $this->cvService->getCVForEdit($id);
        render('index', [
            'template' => '/MyCV/editcv',
            'cvData' => $cvData,
        ]);
    }

    public function deletecv($id)
    {
        if (is_array($id) && isset($id['id'])) {
            $id = (int) $id['id'];
        } else {
            $id = (int) $id;
        }
        $CVModel = new CVModel();
        $userId = $this->jwtService->getUserId();
        $result = $this->cvService->deleteCV($id);

        if (!$result['success']) {
            render('index', [
                'template' => '/MyCV/allcv',
                with('error', 'Xóa CV thất bại!'),
                'cv' => $CVModel->getAllCVById($userId),
            ], '/allcv');
            exit;
        }
        render('index', [
            'template' => '/MyCV/allcv',
            with('success', 'Xóa CV thành công!'),
            'cv' => $CVModel->getAllCVById($userId),
        ], '/allcv');
        exit;

    }

    public function preview($id)
    {
        if (is_array($id) && isset($id['id'])) {
            $id = (int) $id['id'];
        } else {
            $id = (int) $id;
        }
        render("templates/sample{$id}");

    }

    public function showCVByLink($cvLink)
    {
        if (is_array($cvLink) && isset($cvLink['cv_link'])) {
            $cvLink = (string) $cvLink['cv_link'];
        } else {
            $cvLink = (string) $cvLink;
        }
        $cvData = $this->cvService->getCVByLink($cvLink);
        render("templates/template{$cvData['cv']['template_id']}", [
            'data' => $cvData,
        ]);
    }

}