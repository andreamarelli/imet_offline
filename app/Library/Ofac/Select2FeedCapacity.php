<?php

namespace App\Library\Ofac;

Trait Select2FeedCapacity
{
    protected $total_count = 0;
    protected $pagination_interval = 20;

    /**
     * Get the term to search for from the request
     * @return string
     */
    protected function getSearchTerm()
    {
        return '%'.\request('q').'%';
    }

    /**
     * Get the page number from the request
     * @return int
     */
    protected function getPage()
    {
        return \request()->has('page') ? (int)\request('page') - 1 : 0;
    }

    /**
     * Build the search request and fetch data from the database
     *
     * @param $modelClass, the model
     * @param array $keysToSearchIn, Columns where to search in
     * @param array $keysToRetrieve, Columns of data needed for the dropdown : // Should be defined as Array['id' => 'the_id_column', 'text' => 'the_label_column']
     * @return mixed, collection of data corresponding to the search
     */
    protected function performSearchForDropdown($modelClass, Array $keysToSearchIn, Array $keysToRetrieve)
    {
        $search_term = $this->getSearchTerm();
        $page = $this->getPage();

        $collection = $modelClass::where($keysToSearchIn[0], 'ILIKE', $search_term);
        if(count($keysToSearchIn) > 1) {
            for($i = 1; $i < count($keysToSearchIn); $i++) $collection = $collection->orWhere($keysToSearchIn[$i], 'ILIKE', $search_term);
        }

        $this->total_count = $collection->count();

        $items = $collection->skip($page * $this->pagination_interval)->take($this->pagination_interval);
        $items = $items->get(array_values($keysToRetrieve));

        return $items;
    }

    /**
     * Format the data as needed for the dropdown
     *
     * @param $collection, collection of data fetched from database
     * @param array $keysToRetrieve, Columns of data needed for the dropdown
     * @return array, Data formatted for the dropdown
     */
    protected function formatResultsForDropDown($collection, Array $keysToRetrieve)
    {
        $items = array();
        foreach ($collection as $element){
            $item = array();
            $item['id'] = $element->{$keysToRetrieve['id']};
            $item['text'] = $this->formatItemInfo($element->{$keysToRetrieve['text']});
            $items[] = $item;
        }
        return $items;
    }

    /**
     * Format a single item text info
     * @param $text
     * @return mixed
     */
    protected function formatItemInfo($text)
    {
        return $text;
    }

    protected function getSelect2Selected($modelClass, $keysToRetrieve)
    {
        $collection = $modelClass::where($keysToRetrieve['id'], \request('selected'))->first();
        $item = array();
        $item['id'] = $collection->{$keysToRetrieve['id']};
        $item['text'] = $this->formatItemInfo($collection->{$keysToRetrieve['text']});

        return json_encode($item);
    }

    /**
     * Encode formatted data as json representation for the ajax request
     *
     * @param $modelClass, the model
     * @param array $keysToSearchIn, Columns where to search in
     * @param array $keysToRetrieve, Columns of data needed for the dropdown : // Should be defined as Array['id' => 'the_id_column', 'text' => 'the_label_column']
     * @return string, json output
     */
    protected function getSelect2Data($modelClass, Array $keysToSearchIn, Array $keysToRetrieve)
    {
        $items = $this->formatResultsForDropDown($this->performSearchForDropdown($modelClass, $keysToSearchIn, $keysToRetrieve), $keysToRetrieve);

        $data = array(
            'items' => $items,
            'total_count' => $this->total_count
        );

        return json_encode($data);
    }
}