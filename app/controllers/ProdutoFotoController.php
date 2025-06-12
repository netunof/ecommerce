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
        
        $allowedTypes = ['image/jpeg', 'image/png', 'image/webp'];
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
                // Prepare data for new table structure
                $fotoData = [
                    'file_name' => $filename,
                    'file_path' => $destination,
                    'file_size' => $fotos['size'][$i],
                    'mime_type' => $fotos['type'][$i],
                    'produto_fk' => $produtoId,
                    'is_primary' => ($i === 0), // First image as primary by default
                    'created_by' => $_SESSION['user_id'] ?? null, // Assuming you have auth
                    'active' => true
                ];
                
                if (!$this->produtoFotoModel->create($fotoData)) {
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
        // First get the file info from database
        $foto = $this->produtoFotoModel->getById($id);
        if ($foto) {
            if (file_exists($foto->file_path)) {
                unlink($foto->file_path);
            }
            
            // Check if this was a primary image
            if ($foto->is_primary) {
                $this->produtoFotoModel->setNewPrimary($foto->produto_fk, $id);
            }
        }
        
        if (!$this->produtoFotoModel->delete($id)) {
            http_response_code(500);
            die('Error deleting product photo');
        }
    }

    public function setAsPrimary(int $fotoId): void
    {
        $foto = $this->produtoFotoModel->getById($fotoId);
        if (!$foto) {
            $this->notFound();
        }

        if ($this->produtoFotoModel->setAsPrimary($fotoId, $foto->produto_fk)) {
            header('Location: /produtos/edit/' . $foto->produto_fk);
            exit;
        }

        http_response_code(500);
        die('Error setting photo as primary');
    }

    private function notFound(): never
    {
        http_response_code(404);
        $this->view->render('errors/404');
        exit;
    }
}