<?php
namespace Shin1x1\LoaderIo;

class ResultRender
{
    /**
     * @var ResultCollection
     */
    protected $results;

    /**
     * @param ResultCollection $results
     */
    public function __construct(ResultCollection $results)
    {
        $this->results = $results;
    }

    /**
     * @return string
     */
    public function render()
    {
        $output = PHP_EOL;

        $columns = [
            'name',
            'success',
            'error',
            'timeout_error',
            'network_error',
            'avg_response_time',
            'avg_error_rate',
            'public_results_url',
        ];

        $output .= implode(',', $columns) . PHP_EOL;

        foreach ($this->results as $result) {
            $values = [];

            foreach ($columns as $column) {
                $values[] = $result->$column;
            }
            $output .= implode(',', $values) . PHP_EOL;
        }

        return $output;
    }

}