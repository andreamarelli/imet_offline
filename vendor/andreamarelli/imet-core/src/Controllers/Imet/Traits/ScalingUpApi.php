<?php

namespace AndreaMarelli\ImetCore\Controllers\Imet\Traits;

use AndreaMarelli\ImetCore\Helpers\API\Common\Common;
use AndreaMarelli\ImetCore\Models\Imet\API\ScalingUp\Api;
use AndreaMarelli\ImetCore\Models\Imet\v2\Modules;
use ErrorException;
use Illuminate\Http\Request;
use ReflectionException;
use function abort;

Trait ScalingUpApi
{
    /**
     * @param Request $request
     * @param string $lang
     * @return object
     * @throws ReflectionException
     */
    public function get_general_info(Request $request, string $lang): object
    {
        $items = $request->attributes->get('records');
        $this->auth_api($items);

        list($form_ids, $records) = Common::retrieve_form_ids($items);
        return static::sendAPIResponse(Api::get_general_info($form_ids));
    }

    /**
     * @param Request $request
     * @param string $lang
     * @return object
     */
    public function get_overall_ranking(Request $request, string $lang): object
    {
        $items = $request->attributes->get('records');
        $this->auth_api($items);

        list($form_ids) = Common::retrieve_form_ids($items);
        return static::sendAPIResponse(Api::overall_ranking($form_ids));
    }

    /**
     * @param Request $request
     * @param string $lang
     * @return object
     */
    public function get_overall_average_of_six_elements(Request $request, string $lang): object
    {
        $items = $request->attributes->get('records');
        $this->auth_api($items);

        list($form_ids) = Common::retrieve_form_ids($items);
        return static::sendAPIResponse(Api::overall_average_of_six_elements($form_ids));
    }

    /**
     * @param Request $request
     * @param string $lang
     * @return object
     */
    public function get_visualization_synthetics_indicators(Request $request, string $lang): object
    {
        $items = $request->attributes->get('records');
        $this->auth_api($items);

        list($form_ids) = Common::retrieve_form_ids($items);
        return static::sendAPIResponse(Api::visualization_synthetics_indicators($form_ids));
    }

    /**
     * @param Request $request
     * @param string $lang
     * @return object
     */
    public function get_scatter_visualization_synthetic_indicators(Request $request, string $lang): object
    {
        $items = $request->attributes->get('records');
        $this->auth_api($items);

        list($form_ids) = Common::retrieve_form_ids($items);
        return static::sendAPIResponse(Api::scatter_visualization_synthetic_indicators($form_ids));
    }

    /**
     * @param Request $request
     * @param string $lang
     * @return object
     */
    public function get_key_elements_conservation(Request $request, string $lang): object
    {
        $items = $request->attributes->get('records');
        $this->auth_api($items);
        list($form_ids, $records) = Common::retrieve_form_ids($items);
        $response = Api::get_key_elements_conservation($form_ids);

        return static::sendAPIResponse(Common::add_fields_to_response($response, $records));
    }

    /**
     * @param Request $request
     * @param string $lang
     * @param string $slug
     * @return object
     */
    public function get_analysis_ranking(Request $request, string $lang, string $slug): object
    {
        $items = $request->attributes->get('records');
        $this->auth_api($items);
        list($form_ids, $records) = Common::retrieve_form_ids($items);

        $slug = str_replace('-', '_', $slug);
        $func = $slug . "_ranking";
        $response = $this->execute_function_url($form_ids, $func);
        return static::sendAPIResponse(Common::add_fields_to_response($response, $records));
    }

    /**
     * @param Request $request
     * @param string $lang
     * @param string $slug
     * @return object
     */
    public function get_analysis_average(Request $request,string $lang, string $slug): object
    {
        $items = $request->attributes->get('records');
        $this->auth_api($items);
        list($form_ids, $records) = Common::retrieve_form_ids($items);
        if(count($form_ids) === 0){
            return static::sendAPIResponse([]);
        }
        $slug = str_replace('-', '_', $slug);
        $func = $slug . "_average";
        return static::sendAPIResponse($this->execute_function_url($form_ids, $func));
    }

    /**
     * @param Request $request
     * @param string $lang
     * @param string $slug
     * @return object
     */
    public function get_analysis_radar(Request $request,string $lang, string $slug): object
    {
        $items = $request->attributes->get('records');
        $this->auth_api($items);
        list($form_ids, $records) = Common::retrieve_form_ids($items);

        if(count($form_ids) === 0){
            return static::sendAPIResponse([]);
        }
        $slug = str_replace('-', '_', $slug);
        $func = $slug . "_radar";
        $response = $this->execute_function_url($form_ids, $func);
        return static::sendAPIResponse(Common::add_fields_to_response($response, $records));
    }

    /**
     * @param Request $request
     * @param string $lang
     * @param string $slug
     * @return object
     */
    public function get_analysis_table(Request $request,string $lang, string $slug): object
    {
        $items = $request->attributes->get('records');
        $this->auth_api($items);
        list($form_ids, $records) = Common::retrieve_form_ids($items);

        if(count($form_ids) === 0){
            return static::sendAPIResponse([]);
        }
        $slug = str_replace('-', '_', $slug);
        $func = $slug . "_table";
        $response = $this->execute_function_url($form_ids, $func);
        return static::sendAPIResponse(Common::add_fields_to_response($response, $records));
    }

    /**
     * @param Request $request
     * @param string $lang
     * @return object
     */
    public function get_analysis_group(Request $request, string $lang): object
    {
        $records = $request->attributes->get('records');

        $this->auth_api($records);
        $items = $request->attributes->get('groups');
        return static::sendAPIResponse(Api::get_grouping_analysis($items));
    }

    /**
     * @param Request $request
     * @return object
     * @throws ErrorException
     */
    public function get_analysis_group_and_indicators_group(Request $request): object
    {
        $records = $request->attributes->get('records');
        $this->auth_api($records);
        $items = $request->attributes->get('groups');
        return static::sendAPIResponse(Api::get_grouping_analysis_by_indicators($items));
    }

    /**
     * @param array $form_ids
     * @param string $func
     * @return array
     */
    private function execute_function_url(array $form_ids, string $func): array
    {
        $response = [];

        if (method_exists(Api::class, $func)) {
            $response = Api::$func($form_ids);
        } else {
            abort(404, trans('imet-core::api.error_messages.page_not_found'));
        }

        return $response;
    }

    private function auth_api($form_ids){
        foreach($form_ids as $form_id) {
            $this->authorize('api_scaling_up', $form_id);
        }
    }

}
