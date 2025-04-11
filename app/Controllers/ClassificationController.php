<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\ClassificationModel;
use CodeIgniter\HTTP\ResponseInterface;

class ClassificationController extends BaseController
{
    public function index()
    {
        return view("pages/libraries/records/classifications/index");
    }

    public function getClassificationsData()
    {
        $category_model = new ClassificationModel();
        $classifications = $category_model->getClassifications();

        $data = [];
        foreach ($classifications as $classification) 
        {
            $data[] = [
                'code' => $classification['code'],
                'name' => $classification['name'],
                'actions' => 
                    '<a href="' . base_url('permissions/edit/' . $classification['id']) . '" class="btn btn-primary btn-sm">
                        <i class="fas fa-edit"></i> Edit
                    </a> 
                    <button class="btn btn-danger btn-sm delete-btn" data-category-id="' . $classification['id'] . '" data-category-name="' . $classification['name'] . '">
                        <i class="fas fa-trash-alt"></i> Delete
                    </button>'
            ];

        }
        return response()->setJSON(['data' => $data]);
    }
}
