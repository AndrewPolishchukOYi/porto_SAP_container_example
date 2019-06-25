<?php
/*********************************************************************************
 * @apiGroup           Feedback
 * @apiName            CreateFeedback
 * @api                {post} /feedback Create a new Feedback by his parameters
 * @apiDescription     Create new Feedback
 * @apiVersion         1.0.0
 * @apiPermission      Authenticated User
 * @apiHeader          Accept application/json
 * @apiHeader          Authorization Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ91QiLCJhbGciOiJIUzI1NiJ1...
 *
 * @apiSuccessExample  {json}    Success-Response:
 * HTTP/1.1 201 OK
 *
 */
$router->post('feedbacks', [
    'uses' => 'Controller@createFeedback',
    'middleware' => [
            'api.auth',
        ],
]);

/*********************************************************************************
 * @apiGroup           Feedback
 * @apiName            CreateFeedbacks
 * @api                {post} /feedback Create a new Feedbacks by it parameters
 * @apiDescription     Create new Feedbacks
 * @apiVersion         1.0.0
 * @apiPermission      Authenticated User
 * @apiHeader          Accept application/json
 * @apiHeader          Authorization Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ91QiLCJhbGciOiJIUzI1NiJ1...
 *
 * @apiSuccessExample  {json}    Success-Response:
 * HTTP/1.1 201 OK
 *
 */
$router->post('feedbacks_', [
    'uses' => 'Controller@createFeedbacks',
    'middleware' => [
        'api.auth',
    ],
]);

/*********************************************************************************
 * @apiGroup           Feedback
 * @apiName            UpdateFeedback
 * @api                {put} /feedback/{id} Update a Feedback
 * @apiDescription     Update Feedback details
 * @apiVersion         1.0.0
 * @apiPermission      Authenticated User
 * @apiHeader          Accept application/json
 * @apiHeader          Authorization Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ91QiLCJhbGciOiJIUzI1NiJ1...
 *
 * @apiSuccessExample  {json}    Success-Response:
 * HTTP/1.1 200 OK
 *
 * {
 *
 * }
 */
$router->put('feedbacks/{id}', [
    'uses' => 'Controller@updateFeedback',
    'middleware' => [
        'api.auth',
    ],
]);

/*********************************************************************************
 * @apiGroup           Feedback
 * @apiName            DeleteFeedback
 * @api                {delete} /feedback/{id} Delete a Feedback
 * @apiDescription     Delete Feedback from Database
 * @apiVersion         1.0.0
 * @apiPermission      Authenticated User
 * @apiHeader          Accept application/json (required)
 * @apiHeader          Authorization Bearer a1b2c3d4.. (required)
 * @apiParam           {Number}  id the feedback id in the uri (required)
 * @apiSuccessExample  {json}       Success-Response:
 * HTTP/1.1 202 OK
 * {
 * "message": "Feedback (4) Deleted Successfully."
 * }
 */
$router->delete('feedbacks/{id}', [
    'uses' => 'Controller@deleteFeedback',
    'middleware' => [
        'api.auth',
    ],
]);

/*********************************************************************************
 * @apiGroup           Feedback
 * @apiName            DeleteMultipleFeedback
 * @api                {delete} /feedback Delete multiple a Feedback
 * @apiDescription     Delete multiple Feedback from Database
 * @apiVersion         1.0.0
 * @apiPermission      Authenticated User
 * @apiHeader          Accept application/json (required)
 * @apiHeader          Authorization Bearer a1b2c3d4.. (required)
 * @apiSuccessExample  {json}       Success-Response:
 * HTTP/1.1 202 OK
 * {
 * "message": "Every Feedback from list(4) Deleted Successfully."
 * }
 */
$router->delete('feedback/', [
    'uses' => 'Controller@deleteMultipleFeedback',
    'middleware' => [
        'api.auth',
    ],
]);

/*********************************************************************************
 * @apiGroup           Feedback
 * @apiName            ListAllFeedback
 * @api                {get} /feedback Search & Find Feedback
 * @apiDescription     List all the Application Feedback
 * @apiVersion         1.0.0
 * @apiPermission      Authenticated Admin
 * @apiHeader          Accept application/json (required)
 * @apiHeader          Authorization Bearer a1b2c3d4.. (required)
 * @apiParam           search           ?search=name:John Doe;
 * @apiParam           searchFields     ?searchFields=name:like;
 * @apiParam           filter           ?filter=id;name; (optional)
 * @apiSuccessExample  {json}    Success-Response:
 * HTTP/1.1 200 OK
 *
 *
 */
$router->get('feedbacks/{id}', [
    'uses' => 'Controller@findFeedback',
    'middleware' => [
        'api.auth',
    ],
]);

/*********************************************************************************
 * @apiGroup           Feedback
 * @apiName            ListAllFeedback
 * @api                {get} /feedback Search & List all Feedback
 * @apiDescription     List all the Application Feedback
 * @apiVersion         1.0.0
 * @apiPermission      Authenticated Admin
 * @apiHeader          Accept application/json (required)
 * @apiHeader          Authorization Bearer a1b2c3d4.. (required)
 * @apiParam           search           ?search=name:John Doe;
 * @apiParam           searchFields     ?searchFields=name:like;
 * @apiParam           paginate         ?page=3 (optional)
 * @apiParam           order            ?orderBy=id (optional)
 * @apiParam           sort             ?sortedBy=asc (optional)
 * @apiParam           filter           ?filter=id;name; (optional)
 * @apiSuccessExample  {json}    Success-Response:
 * HTTP/1.1 200 OK
 *
 *
 */
$router->get('feedbacks', [
    'uses' => 'Controller@listAllFeedback',
    'middleware' => [
        'api.auth',
    ],
]);


/*********************************************************************************
 * @apiGroup           Feedback Criteria
 * @apiName            ListAllFeedback
 * @api                {get} /feedback Search & List all Feedback Criteria
 * @apiDescription     List all the Application Feedback Criteria
 * @apiVersion         1.0.0
 * @apiPermission      Authenticated Admin
 * @apiHeader          Accept application/json (required)
 * @apiHeader          Authorization Bearer a1b2c3d4.. (required)
 * @apiParam           search           ?search=name:John Doe;
 * @apiParam           searchFields     ?searchFields=name:like;
 * @apiParam           paginate         ?page=3 (optional)
 * @apiParam           order            ?orderBy=id (optional)
 * @apiParam           sort             ?sortedBy=asc (optional)
 * @apiParam           filter           ?filter=id;name; (optional)
 * @apiSuccessExample  {json}    Success-Response:
 * HTTP/1.1 200 OK
 *
 *
 */

$router->get('feedback_criterias', [
    'uses' => 'Controller@listAllFeedbackCriteria',
    'middleware' => [
        'api.auth',
    ],
]);

$router->get('feedback_criterias/{id}', [
    'uses' => 'Controller@findFeedbackCriteria',
    'middleware' => [
        'api.auth',
    ],
]);

$router->post('feedback_criterias', [
    'uses' => 'Controller@createFeedbackCriteria',
    'middleware' => [
        'api.auth',
        'role:super_admin'
    ],
]);

$router->put('feedback_criterias/{id}', [
    'uses' => 'Controller@updateFeedbackCriteria',
    'middleware' => [
        'api.auth',
        'role:super_admin'
    ],
]);

$router->delete('feedback_criterias/{id}', [
    'uses' => 'Controller@deleteFeedbackCriteria',
    'middleware' => [
        'api.auth',
        'role:super_admin'
    ],
]);

$router->get('grades', [
    'uses' => 'Controller@listAllGrades',
    'middleware' => [
        'api.auth',
    ],
]);

$router->get('grades/chart', [
    'uses' => 'Controller@listAllGradesChart',
    'middleware' => [
        'api.auth',
    ],
]);

/*********************************************************************************
 * @apiGroup           User Lessons Contribution
 * @apiName            UserLessonsContribution
 * @api                {get} /contribution Get User Contribution
 * @apiDescription     List all the Application CourseClass
 * @apiVersion         1.0.0
 * @apiPermission      Authenticated Admin
 * @apiHeader          Accept application/json (required)
 * @apiHeader          Authorization Bearer a1b2c3d4.. (required)
 * @apiParam           search           ?search=name:John Doe;
 * @apiParam           searchFields     ?searchFields=name:like;
 * @apiSuccessExample  {json}    Success-Response:
 * HTTP/1.1 200 OK
 *
 *
 */
$router->get('students-feedback-counter', [
    'uses' => 'Controller@getStudentsFeedbackCounter',
    'middleware' => [
        'api.auth',
    ],
]);






