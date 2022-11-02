<?php

namespace NinjaForms\ExcelExport\Handlers;

use NinjaForms\ExcelExport\Contracts\QuerySubmissions as ContractsQuerySubmissions;

class QuerySubmissions implements ContractsQuerySubmissions
{
    /** 
     * Form ID as string
     * 
     * @var string 
     */
    protected $formId;

    /**
     * Submissions per page
     *
     * @var int
     */
    protected $subsPerPage;

    /**
     * Current iteration
     *
     * @var int
     */
    protected $iteration;

    /**
     * Filters
     *
     * @var array
     */
    protected $filters;

    public function querySubmissions(string $formId, int $subsPerPage, int $iteration, array $filters): array
    {

        $query_args = array(
            'post_type'         => 'nf_sub',
            'posts_per_page'    => $subsPerPage,
            'offset'            => $subsPerPage * $iteration,
            'date_query'        => array(
                'inclusive'     => true,
            ),
            'meta_query'        => array(
                array(
                    'key' => '_form_id',
                    'value' => $formId,
                )
            )
        );

        if ($this->filters) {
            $query_args = $this->constructQueryArgs($query_args,$filters);
        }

        $subs = new \WP_Query($query_args);

        $sub_objects = array();
        $sub_index = 0;

        if (is_array($subs->posts) && !empty($subs->posts)) {
            foreach ($subs->posts as $sub) {
                $sub_objects[$sub_index] = Ninja_Forms()->form($formId)->get_sub($sub->ID)->get_field_values();
                $sub_objects[$sub_index]['date_submitted'] = \get_the_date('', $sub->ID);
                $sub_index++;
            }
        }

        return $sub_objects;
    }

    private function constructQueryArgs($query_args, $filters)
    {
        foreach ($filters as $filter) {
            if ($filter->field_key == 'submission_date') {
                $date = $filter->value;
                if ($filter->condition == 'GT')
                    $query_args['date_query']['after'] = $date . ' 23:59:59';
                elseif ($filter->condition == 'GE')
                    $query_args['date_query']['after'] = $date . ' 00:00:00';
                elseif ($filter->condition == 'LT')
                    $query_args['date_query']['before'] = $date . ' 00:00:00';
                elseif ($filter->condition == 'LE')
                    $query_args['date_query']['before'] = $date . ' 23:59:59';
                elseif ($filter->condition == 'EQUAL') {
                    $query_args['date_query']['after'] = $date . ' 00:00:00';
                    $query_args['date_query']['before'] = $date . ' 23:59:59';
                }
                // ignore EMPTY and NOTEMPTY
            } elseif ($filter->field_type == 'date') {
                $query_args = $this->apply_query_filter_date($query_args, $filter);
            } elseif (in_array($filter->field_type, array('number', 'starrating', 'quantity', 'shipping', 'total'))) {
                $query_args = $this->apply_query_filter_numeric($query_args, $filter);
            } else {
                $query_args = $this->apply_query_filter_general($query_args, $filter);
            }
        }

        return $query_args;
    }
}
