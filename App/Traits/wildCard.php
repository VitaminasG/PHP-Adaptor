<?php


namespace App;


trait wildCard
{
    private $uriList = [];

    private $uriWcard = '';

    /**
     * @return array
     */
    public function getUriList(): array
    {
        return $this->uriList;
    }

    /**
     * @param array $uriList
     */
    public function setUriList(array $uriList)
    {
        $this->uriList = $uriList;
    }

    /**
     * @return string
     */
    public function getUriWcard(): string
    {
        return $this->uriWcard;
    }

    /**
     * @param string $uriWcard
     */
    public function setUriWcard(string $uriWcard)
    {
        $this->uriWcard = $uriWcard;
    }

    protected function createList(array $list)
    {

        $array = [];

        foreach ( $list as $key => $value ) {

            array_push($array, $key);
        }

        $found = preg_grep("/[^\/]+[[\{]*[\w]*[\}]$/s", $array);

        $this->setUriList($found);
    }

    protected function matchBoth(string $uri)
    {
        $subject = "raw/bla/bla/csv";

        $array = ["raw/{name}", "raw/bla/bla/{name}", "raw/yes/{name}"];

        $match = '';

        foreach ( $array as $item){

            preg_match("/^(?:[\w+]*+\/)*/", $subject, $first);
            preg_match("/^(?:[\w+]*+\/)*/", $item, $second);

            if($first === $second){
                $match = $second;
            }

        }

        dd($match);
    }

    protected function findUriWcard(string $uri)
    {

        preg_match("/[^\/]+[\w]*$/s", $uri, $keyword);

        $this->setUriWcard($keyword);
    }

    protected function tempContainer()
    {
//
//        $subject = "raw/bla/bla/csv";
//
//        $array = ["raw/{name}", "raw/bla/bla/{name}", "raw/yes/{name}"];
//
//        $match = '';
//
//        foreach ( $array as $item){
//
//            preg_match("/^(?:[\w+]*+\/)*/", $subject, $first);
//            preg_match("/^(?:[\w+]*+\/)*/", $item, $second);
//
//            if($first === $second){
//                $match = $second;
//            }
//
//
//        }
//
//        dd($match);
//
//        $keyword = '';
//
//        preg_match("/[^\/]+[\w]*$/s", $subject, $keyword);
//
//        dd($keyword);

//        preg_match('/[^\/]+[[\{]*[\w]*[\}]$/s', $found[1], $wildcard);
//
//        pp($wildcard[0]);

        // https://stackoverflow.com/questions/8627334/how-to-search-in-an-array-with-preg-match

    }

}