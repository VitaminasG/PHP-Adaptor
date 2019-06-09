<?php


namespace App;


trait wildCard
{
    /**
     * WildCard list.
     *
     * @var array
     */
    private $WL = [];

    /**
     * Normal List sorted/unsorted.
     *
     * @var array
     */
    private $NL = [];

    /**
     * Last chunk of URI.
     *
     * @var string
     */
    private $uriKey = '';

    /**
     * Targeted WildCard Controller with URI keyword.
     *
     * @var array
     */
    private $targetWC = [];

    /**
     * Get the URI keyword.
     *
     * @return string
     */
    public function getUriKey(): string
    {
        return $this->uriKey;
    }

    /**
     * Set the URI keyword.
     *
     * @param string $uriKey
     */
    public function setUriKey(string $uriKey)
    {
        $this->uriKey = $uriKey;
    }

    /**
     * Get the WildCard List.
     *
     * @return array
     */
    public function getWL(): array
    {
        return $this->WL;
    }

    /**
     * Set the WildCard List.
     *
     * @param array $list
     */
    public function setWL(array $list)
    {
        $this->WL = $list;
    }

    /**
     * Get Sorted/Unsorted List.
     *
     * @return array
     */
    public function getNL(): array
    {
        return $this->NL;
    }

    /**
     * Set Sorted/Unsorted List.
     *
     * @param array $NL
     */
    public function setNL(array $NL)
    {
        $this->NL = $NL;
    }

    /**
     * Sorting, setting W-List & N-List.
     *
     * @param array $list
     */
    protected function createWL(array $list)
    {
        $tmpArr = [];
        $tmpArr2 = [];
        $this->setNL($list);

        foreach ( $list as $key => $value ) {

            array_push($tmpArr, $key);
        }

        $found = preg_grep("/[^\/]+[[\{]*[\w]*[\}]$/s", $tmpArr);

        $this->removeWL($found);

        foreach ( $found as $item) {

            foreach ($list as $key => $value ) {

                if ( $item === $key ) {

                    $tmpArr2[$key] = $value;
                }
            }
        }

        $this->setWL($tmpArr2);
    }

    /**
     * Deleting WCards from NList.
     *
     * @param array $wcArr
     *
     * @return array
     */
    protected function removeWL( array $wcArr)
    {
        foreach ( $wcArr as $item) {

            unset($this->NL[$item]);
        }

        return $this->getNL();
    }

    /**
     * Match URI with WCard uri.
     *
     * @param string $uri
     *
     * @return bool
     */
    protected function matchBoth(string $uri)
    {
        $found = false;

        $this->findKeyword($uri);

        foreach ( $this->WL as $key => $value) {

            preg_match("/^(?:[\w]*+\/)*/", $uri, $first);
            preg_match("/^(?:[\w]*+\/)*/", $key, $second);

            if( $first === $second ){

                $found = true;

                $this->targetWC[$this->getUriKey()] = $value;
            }
        }

        return $found;
    }

    /**
     * Find URI Keyword.
     *
     * @param string $uri
     */
    protected function findKeyword(string $uri)
    {

        preg_match("/[^\/]+[\w]*$/s", $uri, $keyword);

        $this->setUriKey($keyword[0]);
    }
}