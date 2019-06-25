<?php

namespace App\Containers\Feedback\Exceptions;

use App\Port\Exception\Abstracts\Exception;
use Symfony\Component\HttpFoundation\Response;

/**
 * Class FeedbackNotFoundException.
 *
 * @author Vasyl Perun <perun.vasyl1@gmail.com>
 */
class FeedbackNotFoundException extends Exception
{
    public $httpStatusCode = Response::HTTP_BAD_REQUEST;

    public $message = 'Could not find the Feedback in our database.';
}
