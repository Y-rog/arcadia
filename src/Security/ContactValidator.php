<?php

namespace App\Security;


class ContactValidator extends Security
{
    public function validateContact(array $contact): array
    {
        $errors = [];
        if (empty($contact['title'])) {
            $errors['title'] = 'Le champ titre ne doit pas être vide';
        }
        if (empty($contact['email'])) {
            $errors['email'] = 'Le champ email ne doit pas être vide';
        } else if (!filter_var($contact['email'], FILTER_VALIDATE_EMAIL)) {
            $errors['email'] = 'L\'email n\'est pas valide';
        }
        if (empty($contact['message'])) {
            $errors['message'] = 'Le champ message ne doit pas être vide';
        }
        return $errors;
    }
}
