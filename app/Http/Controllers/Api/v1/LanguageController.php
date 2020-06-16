<?php

namespace App\Http\Controllers\Api\v1;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\ApiResponseCollection;
use Symfony\Component\HttpFoundation\Response;
use App\Models\Language;

class LanguageController extends Controller
{
    public function index()
    {
        $data = collect([
            'result' => null,
            'errors' => [],
            'status_code' => null,
            'links' => [],
            'message' => null
        ]);

        /**
         * Send correct HTTP code
         * For example here, we send 204 - No Content if result is blank
         */
        $languages = Language::all();
        if ($languages->isEmpty()) {
            $data['status_code'] = Response::HTTP_NO_CONTENT;
        } else {
            $data['result'] = $languages;
            $data['status_code'] = Response::HTTP_OK;
        }

        /**
         * Use our API response format for consistent output
         */
        $result = new ApiResponseCollection($data);
        return $result
                ->response()
                ->setStatusCode($data['status_code']);
    }

    public function get(Request $request, $language_id)
    {
        $data = collect([
            'result' => null,
            'errors' => [],
            'status_code' => null,
            'links' => [],
            'message' => null
        ]);

        /**
         * For simplicity, we are not doing any validations here
         */
        $language = Language::where('id', $language_id)->first();
        if (is_null($language)) {
            $data['status_code'] = Response::HTTP_NOT_FOUND;
            $data['message'] = 'No records found.';
        } else {
            $data['result'] = $language;
            $data['status_code'] = Response::HTTP_OK;
        }

        $result = new ApiResponseCollection($data);
        return $result
                ->response()
                ->setStatusCode($data['status_code']);
    }

    public function add(Request $request)
    {
        $data = collect([
            'result' => null,
            'errors' => [],
            'status_code' => null,
            'links' => [],
            'message' => null
        ]);

        /**
         * For simplicity, we are not doing any validations here
         */
        $requestArray = $request->json()->all();
        $language = Language::create($requestArray);
        if ($language) {
            $data['result'] = $language;
            $data['status_code'] = Response::HTTP_CREATED;
        } else {
            $data['status_code'] = Response::HTTP_BAD_REQUEST;
            $data['message'] = 'Record not created.';
        }

        $result = new ApiResponseCollection($data);
        return $result
                ->response()
                ->setStatusCode($data['status_code']);
    }

    public function update(Request $request, $language_id)
    {
        $data = collect([
            'result' => null,
            'errors' => [],
            'status_code' => null,
            'links' => [],
            'message' => null
        ]);

        /**
         * For simplicity, we are not doing any validations here
         */
        $requestArray = $request->json()->all();
        $update = Language::where('id', $language_id)
                    ->update($requestArray);
        if ($update) {
            $language = Language::where('id', $language_id)->first();
            $data['result'] = $language;
            $data['status_code'] = Response::HTTP_OK;
        } else {
            $data['status_code'] = Response::HTTP_BAD_REQUEST;
            $data['message'] = 'Record not updated.';
        }

        $result = new ApiResponseCollection($data);
        return $result
                ->response()
                ->setStatusCode($data['status_code']);
    }

    public function delete(Request $request, $language_id)
    {
        $data = collect([
            'result' => null,
            'errors' => [],
            'status_code' => null,
            'links' => [],
            'message' => null
        ]);

        /**
         * For simplicity, we are not doing any validations here
         */
        $delete = Language::where('id', $language_id)->delete();
        if ($delete) {
            $data['status_code'] = Response::HTTP_OK;
            $data['message'] = 'Record deleted.';
        } else {
            $data['status_code'] = Response::HTTP_BAD_REQUEST;
            $data['message'] = 'Record could not be deleted.';
        }

        $result = new ApiResponseCollection($data);
        return $result
                ->response()
                ->setStatusCode($data['status_code']);
    }
}
