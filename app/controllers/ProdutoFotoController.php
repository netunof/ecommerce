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
        
        // Cria diretório
        if (!file_exists($uploadDir)) {
            mkdir($uploadDir, 0755, true);
        }
        
        $success = true;
        $fileCount = count($fotos['name']);
        
        for ($i = 0; $i < $fileCount; $i++) {
            if ($fotos['error'][$i] === UPLOAD_ERR_NO_FILE) {
                continue;
            }
            
            if ($fotos['error'][$i] !== UPLOAD_ERR_OK || $fotos['size'][$i] > $maxSize ||
                !in_array($fotos['type'][$i], $allowedTypes)) {
                    $success = false;
                    continue;
            }
            
            //Gera um nome único
            $extension = pathinfo($fotos['name'][$i], PATHINFO_EXTENSION);
            $filename = uniqid('prod_'.$produtoId.'_', true) . '.' . $extension;
            $destination = $uploadDir . $filename;
            
            if (move_uploaded_file($fotos['tmp_name'][$i], $destination)) {
                $fotoData = [
                    'file_name' => $filename,
                    'file_path' => $destination,
                    'file_size' => $fotos['size'][$i],
                    'mime_type' => $fotos['type'][$i],
                    'produto_fk' => $produtoId,
                    'is_primary' => ($i === 0), // Define a primeira como primária
                    'created_by' => $_SESSION['user_id'] ?? null, // Preenche por quem está logado
                    'active' => true
                ];
                                
                if (!$this->produtoFotoModel->create($fotoData)) {
                    $success = false;
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
        $foto = $this->produtoFotoModel->getById($id);
        if ($foto) {
            if (file_exists($foto->file_path)) {
                unlink($foto->file_path);
            }
            
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

        if (!$this->produtoFotoModel->setAsPrimary($fotoId, $foto->produto_fk)) {
            http_response_code(500);
            die('Erro ao definir como primária');
        }

    }

    private function notFound(): never
    {
        http_response_code(404);
        $this->view->render('errors/404');
        exit;
    }
}