<?php
namespace App\Controllers;
use App\Models\Document;

class DocumentController {
    public function getAllDocuments()
    {
        return Document::getAll();
    }

    public function getDocument($id)
    {
        return Document::getById($id);
    }

    public function searchDocumentByTitle()
    {
        $title = filter_input(INPUT_POST, 'search');
        return Document::getByTitle($title);
    }
}
