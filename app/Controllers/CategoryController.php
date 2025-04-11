<?php

namespace App\Controllers;

use App\Models\CategoryModel;
use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;

class CategoryController extends BaseController
{
    public function index()
    {
        return view("pages/libraries/records/categories/index");
    }

    public function getCategoriesData()
    {
        $category_model = new CategoryModel();
        $categories = $category_model->getCategories();

        $data = [];
        foreach ($categories as $category) 
        {
            $data[] = [
                'code' => $category['code'],
                'name' => $category['name'],
                'classification_name' => $category['classification_name'],
                'actions' => 
                    '<a href="' . base_url('permissions/edit/' . $category['id']) . '" class="btn btn-primary btn-sm">
                        <i class="fas fa-edit"></i> Edit
                    </a> 
                    <button class="btn btn-danger btn-sm delete-btn" data-category-id="' . $category['id'] . '" data-category-name="' . $category['name'] . '">
                        <i class="fas fa-trash-alt"></i> Delete
                    </button>'
            ];

        }
        return response()->setJSON(['data' => $data]);
    }
}
