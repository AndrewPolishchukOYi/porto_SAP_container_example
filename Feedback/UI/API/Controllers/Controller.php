<?php

namespace App\Containers\Feedback\UI\API\Controllers;

use App\Containers\Feedback\Actions\DeleteFeedbackAction;
use App\Containers\Feedback\Actions\ListAllFeedbackAction;
use App\Containers\Feedback\Actions\ListAllCriteriasAction;
use App\Containers\Feedback\Actions\CreateFeedbackAction;
use App\Containers\Feedback\Actions\UpdateFeedbackAction;
use App\Containers\Feedback\Actions\FindFeedbackAction;
use App\Containers\Feedback\Actions\FeedbackCriteriaAction;
use App\Containers\Feedback\Actions\ListAllGradesAction;
use App\Containers\Feedback\Models\Criteria;
use App\Containers\Feedback\Models\Feedback;
use App\Containers\Feedback\UI\API\Requests\DeleteFeedbackRequest;
use App\Containers\Feedback\UI\API\Requests\DeleteMultipleFeedbackRequest;
use App\Containers\Feedback\UI\API\Requests\CreateFeedbackRequest;
use App\Containers\Feedback\UI\API\Requests\CreateFeedbacksRequest;
use App\Containers\Feedback\UI\API\Requests\UpdateFeedbackRequest;
use App\Containers\Feedback\UI\API\Requests\CriteriaRequests\CreateFeedbackCriteriaRequest;
use App\Containers\Feedback\UI\API\Requests\CriteriaRequests\UpdateFeedbackCriteriaRequest;
use App\Containers\Feedback\UI\API\Requests\CriteriaRequests\DeleteFeedbackCriteriaRequest;
use App\Containers\Feedback\UI\API\Requests\CriteriaRequests\DeleteMultipleFeedbackCriteriaRequest;
use App\Containers\Feedback\UI\API\Transformers\FeedbackTransformer;
use App\Containers\Feedback\UI\API\Transformers\CriteriaTransformer;
use App\Containers\Feedback\UI\API\Transformers\GradeTransformer;
use App\Port\Controller\Abstracts\PortApiController;
use App\Port\Request\Manager\HttpRequest;
use App\Port\Transformer\Eloquent\CustomIdentifierTransformer;
use Illuminate\Http\Request;
use App\Port\Helpers\Traits\CollectionOrPaginateTrait;

/**
 * Class Controller.
 *
 * @author Vasyl Perun <perun.vasyl1@gmail.com>
 */
class Controller extends PortApiController
{
    use CollectionOrPaginateTrait;

    /**
     * @param \App\Containers\Feedback\UI\API\Requests\DeleteFeedbackRequest $request
     * @param \App\Containers\Feedback\Actions\DeleteFeedbackAction          $action
     *
     * @return  \Dingo\Api\Http\Response
     */
    public function deleteFeedback(DeleteFeedbackRequest $request, DeleteFeedbackAction $action)
    {
        $action->run($request->id);

        return $this->response->accepted(null, [
            'message' => 'Feedback (' . $request->id . ') Deleted Successfully.',
        ]);
    }

    /**
     * @param \App\Containers\Feedback\UI\API\Requests\DeleteMultipleFeedbackRequest $request
     * @param \App\Containers\Feedback\Actions\DeleteFeedbackAction          $action
     *
     * @return  \Dingo\Api\Http\Response
     */
    public function deleteMultipleFeedback(DeleteMultipleFeedbackRequest $request, DeleteFeedbackAction $action)
    {
        foreach ($request->ids as $key => $id) {
            $action->run($id);
        }

        return $this->response->accepted(null, [
            'message' => 'Every Feedback from list (' . implode(",",$request->ids) . ') Deleted Successfully.',
        ]);
    }

    /**
        * @param \App\Containers\Feedback\Actions\FindFeedbackAction $action
        *
        * @return  \Dingo\Api\Http\Response
        */
        public function findFeedback(Request $request, FindFeedbackAction $action)
        {
           $feedbacks = $action->run($request->route('id'));

           return $this->response->item($feedbacks,new FeedbackTransformer());
        }

    /**
    * @param \App\Containers\Feedback\Actions\ListAllFeedbackAction $action
    *
    * @return  \Dingo\Api\Http\Response
    */
    public function listAllFeedback(Request $request, ListAllFeedbackAction $action)
    {
       $feedbacks = $action->run();

       return $this->return($feedbacks,new FeedbackTransformer(),$request);
    }

    /**
     * @param \App\Containers\Feedback\UI\API\Requests\CreateFeedbackRequest $request
     * @param \App\Containers\Feedback\Actions\CreateFeedbackAction      $action
     *
     * @return  \Dingo\Api\Http\Response
     */
    public function createFeedback(CreateFeedbackRequest $request, CreateFeedbackAction $action)
    {

        if($request->get('validate')){
            return $this->response->accepted(null, [
                'validate' => true
            ]);
        }
        // create the new Feedback
        $feedback = $action->run($request);

        return $this->response->item($feedback, new FeedbackTransformer());
    }

    /**
     * @param \App\Containers\Feedback\UI\API\Requests\CreateFeedbacksRequest $request
     * @param \App\Containers\Feedback\Actions\CreateFeedbackAction      $action
     *
     * @return  \Dingo\Api\Http\Response
     */
    public function createFeedbacks(CreateFeedbacksRequest $request, CreateFeedbackAction $action)
    {
        // create the new Feedback
        $feedbacks = $action->runMany($request);

        return $this->response->collection($feedbacks, new FeedbackTransformer());
    }

    /**
     * @param \App\Containers\Feedback\UI\API\Requests\UpdateFeedbackRequest $request
     * @param \App\Containers\Feedback\Actions\UpdateFeedbackAction          $action
     *
     * @return  \Dingo\Api\Http\Response
     */
    public function updateFeedback(UpdateFeedbackRequest $request, UpdateFeedbackAction $action)
    {
        $feedback = $action->run($request);

        return $this->response->item($feedback, new FeedbackTransformer());
    }





//  FEEDBACK CRITERIAS API


    public function deleteFeedbackCriteria(DeleteFeedbackCriteriaRequest $request, FeedbackCriteriaAction $action)
    {
        $action->delete($request->id);

        return $this->response->accepted(null, [
            'message' => 'Criteria (' . $request->id . ') Deleted Successfully.',
        ]);
    }

    public function deleteMultipleFeedbackCriteria(DeleteMultipleLevelRequest $request, FeedbackCriteriaAction $action)
    {
        foreach ($request->ids as $key => $id) {
            $action->delete($id);
        }

        return $this->response->accepted(null, [
            'message' => 'Every Criteria from list (' . implode(",",$request->ids) . ') Deleted Successfully.',
        ]);
    }

    public function findFeedbackCriteria(Request $request, FeedbackCriteriaAction $action)
    {
       $criteria = $action->findById($request->route('id'));

       return $this->response->item($criteria,new CriteriaTransformer());
    }

    public function listAllFeedbackCriteria(Request $request, FeedbackCriteriaAction $action)
    {
       $criterias = $action->findAll();

       return $this->return($criterias,new CriteriaTransformer(),$request);
    }

    public function createFeedbackCriteria(CreateFeedbackCriteriaRequest $request, FeedbackCriteriaAction $action)
    {
        // create the new Level
        $criteria = $action->create($request);

        return $this->response->item($criteria, new CriteriaTransformer());
    }

    public function updateFeedbackCriteria(UpdateFeedbackCriteriaRequest $request, FeedbackCriteriaAction $action)
    {
        $criteria = $action->update($request);

        return $this->response->item($criteria, new CriteriaTransformer());
    }

    public function listAllGrades(Request $request, ListAllGradesAction $action)
    {
       $grades = $action->run();

       return $this->return($grades,new GradeTransformer(),$request);
    }

    public function listAllGradesChart(Request $request, ListAllGradesAction $action)
    {
       $grades = $action->chart();

       return $this->response->accepted(null, [
            'data' => $grades,
        ]);
    }

    public function getStudentsFeedbackCounter(Request $request, ListAllFeedbackAction $action)
    {

        return $this->response->accepted(null, [
            'data' => (new CustomIdentifierTransformer($request))->transform( new Feedback)
        ]);

    }

}
