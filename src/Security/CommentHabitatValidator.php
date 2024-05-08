<?php

namespace App\Security;

use App\Entity\CommentHabitat;

class CommentHabitatValidator extends Security
{
    public function validateCommentHabitat(CommentHabitat $commentHabitat): array
    {
        $errors = [];
        if (empty($commentHabitat->getContent())) {
            $errors['content'] = 'Le champ commentaire ne doit pas être vide';
        }
        return $errors;
    }
}
