<?php

class IndexController extends ControllerBase
{

    public function indexAction()
    {
        $this->respond('You are searching now!');
    }

    public function answersAction()
    {
        $q = $this->request->get('q', 'string');

        $space = str_replace(' ', '', $q);
        $docs = '';

        if ( $space !== '' ) {
            $this->seek->setFuzzy();
            $this->seek->setQuery($q);
            $this->seek->setLimit(static::$limit, static::$offset);
            $docs = $this->seek->search();

            $total = $this->seek->count();
        }

        $this->respond($docs);
    }

}

