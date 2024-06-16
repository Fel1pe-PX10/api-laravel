<?php

namespace App\Filters;

use Illuminate\Http\Request;

class ApiFilter {

    protected $safeParams = [];

    protected $columnMap = [];

    protected $operatorsMap = [];

    public function transform(Request $request)
    {
        $queryItems = [];

        foreach ($this->safeParams as $param => $operators) {
            $query = $request->query($param);

            // If query is empty that param doesn't exist in the request
            if(!isset($query)) {
                continue;
            }

            $column = $this->columnMap[$param] ?? $param;

            foreach ($operators as $operator) {
                if(isset($query[$operator])) {
                    $queryItems[] = [$column, $this->operatorsMap[$operator], $query[$operator]];
                }
            }
        }
        return $queryItems;
    }
}