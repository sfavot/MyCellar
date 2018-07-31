<?php

declare(strict_types=1);

namespace App\Controller;

use App\Exception\ValidationException;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Validator\Validator\ValidatorInterface;

class BaseController extends AbstractController
{
    protected function validate(ValidatorInterface $validator, $entity, $groups = null, $constraints = null)
    {
        $violations = $validator->validate($entity, $constraints, $groups);
        if ($violations->count() > 0) {
            throw new ValidationException($violations);
        }
    }
}