<?php
/**
 * Created by PhpStorm.
 * User: acf
 * Date: 27/11/2018
 * Time: 00:39
 */

namespace App\Form;
use App\Entity\Role;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Form\DataTransformerInterface;
use Symfony\Component\Form\Exception\TransformationFailedException;

class IssueToNumberTransformer implements DataTransformerInterface
{
    private $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    /**
     * Transforms an object (issue) to a string (number).
     *
     * @param  Issue|null $issue
     * @return string
     */
    public function transform($issue)
    {
        if (null === $issue) {
            return '';
        }

        return $issue[0]->getId();
    }

    /**
     * Transforms a string (number) to an object (issue).
     *
     * @param  string $issueNumber
     * @return Issue|null
     * @throws TransformationFailedException if object (issue) is not found.
     */
    public function reverseTransform($issueNumber)
    {
        // no issue number? It's optional, so that's ok
        if (!$issueNumber) {
            return;
        }

        $issue = $this->entityManager
            ->getRepository(Role::class)
            // query for the issue with this id
            ->find($issueNumber)
        ;

        if (null === $issue) {
            // causes a validation error
            // this message is not shown to the user
            // see the invalid_message option
            throw new TransformationFailedException(sprintf(
                'An issue with number "%s" does not exist!',
                $issueNumber
            ));
        }

        return $issue;
    }
}