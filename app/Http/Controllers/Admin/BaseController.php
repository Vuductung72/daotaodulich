<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class BaseController extends Controller
{
    protected function dataTableFormat($query, Request $request, $select = '*')
    {
        $start = $request->get('start', 0);
        $length = $request->get('length', 10);
        $orders = $request->get('order', []);
        $search = $request->get('search');
        $columns = $this->prepareDataColumns($request->get('columns', []));
        $filters = $this->prepareDataFilter($request->except([
            'columns',
            'order',
            'search',
            'draw',
            'start',
            'length'
        ]));

        $query->addSelect($select)->filter($filters);

        if (!empty($search['value'])) {
            $query->where(function ($query) use ($columns, $search) {
                foreach ($columns as $column) {
                    if (json_decode($column['searchable'])) {
                        $query->orWhere($column['data'], 'LIKE', '%' . $search['value'] . '%');
                    }
                }
            });
        }

        $countQuery = "select count(*) as aggregate from ({$query->toSql()}) total";
        $count = collect(DB::select($countQuery, $query->getBindings()))->pluck('aggregate')->first();
//        $count = $query->toBase()->getCountForPagination();

        foreach ($orders as $key => $order) {
            if (!empty($columns[$order['column']]['data']) && $columns[$order['column']]['orderable']) {
                $query->orderBy($columns[$order['column']]['data'], $order['dir']);
            }
        }

        $data = $length == -1 ? $query->get() : $query->skip(intval($start))->take(intval($length))->get();

        return [
            'draw' => $request->draw,
            'recordsTotal' => $count,
            'recordsFiltered' => $count,
            'data' => $this->customFormat($data),
            'input' => $request->all()
        ];
    }

    protected function customFormat($data)
    {
        return $data;
    }

    protected function prepareDataFilter($data)
    {
        return $data;
    }

    protected function prepareDataColumns($columns)
    {
        return $columns;
    }
}
