<?php

namespace App\Containers\Feedback\Exceptions;

use App\Port\Exception\Abstracts\Exception;
use Symfony\Component\HttpFoundation\Response;

/**
 * Class FeedbackFailedException.
 *
 * @author Vasyl Perun <perun.vasyl1@gmail.com>
 */
class FeedbackFailedException extends Exception
{

    public $httpStatusCode = Response::HTTP_CONFLICT;

    public $message = 'Failed creating new Feedback.';
}
