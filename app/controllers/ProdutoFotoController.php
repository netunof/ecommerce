<?php

declare(strict_types=1);

namespace App\Controllers;

use App\Models\ProdutoFotoModel;
use App\Views\ViewRenderer;

class ProdutoFotoController 
{
    public function __construct(
        private ProdutoFotoModel $produtoFotoModel = new ProdutoFotoModel(),
        private ViewRenderer $view = new ViewRenderer()
    ) {}

    public function store(int $produtoId, array $fotos): bool
    {
        if (empty($fotos['name'][0])) {
            return false;
        }
        
        $allowedTypes = ['image/jpeg', 'image/png'];
        $maxSize = 5 * 1024 * 1024;
        $uploadDir = 'public/img/produtos/';
        
        // Create directory if it doesn't exist
        if (!file_exists($uploadDir)) {
            mkdir($uploadDir, 0755, true);
        }
        
        $success = true;
        $fileCount = count($fotos['name']);
        
        for ($i = 0; $i < $fileCount; $i++) {
            if ($fotos['error'][$i] === UPLOAD_ERR_NO_FILE) {
                continue;
            }
            
            if ($fotos['error'][$i] !== UPLOAD_ERR_OK || 
                !in_array($fotos['type'][$i], $allowedTypes) || 
                $fotos['size'][$i] > $maxSize) {
                $success = false;
                continue;
            }
            
            // Generate unique filename
            $extension = pathinfo($fotos['name'][$i], PATHINFO_EXTENSION);
            $filename = uniqid('prod_'.$produtoId.'_', true) . '.' . $extension;
            $destination = $uploadDir . $filename;
            
            if (move_uploaded_file($fotos['tmp_name'][$i], $destination)) {
                // Store only the filename in database
                if (!$this->produtoFotoModel->create($produtoId, $filename)) {
                    $success = false;
                    // Delete the file if db insert failed
                    unlink($destination);
                }
            } else {
                $success = false;
            }
        }
        
        return $success;
    }

    public function delete(int $id): void
    {
        // First get the filename from database
        $foto = $this->produtoFotoModel->getById($id);
        if ($foto) {
            $filePath = 'uploads/produtos/' . $foto->file_name;
            if (file_exists($filePath)) {
                unlink($filePath);
            }
        }
        
        if (!$this->produtoFotoModel->delete($id)) {
            http_response_code(500);
            die('Error deleting product photo');
        }
    }

    private function notFound(): never
    {
        http_response_code(404);
        $this->view->render('errors/404');
        exit;
    }
}