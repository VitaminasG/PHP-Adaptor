<?php


namespace App;


trait pathFinder
{

    /**
     * Full file path.
     *
     * @var null
     */
    private $_filePath = null;

    /**
     * Default file directory.
     *
     * @var string
     */
    private $_dir = 'files/';

    /**
     * Default file name.
     *
     * @var string
     */
    private $_fileName = 'data';

    /**
     * Set a file path.
     *
     * @param string $extension
     */
    protected function setFilePath(string $extension)
    {
        $path = $this->getLoc() . $extension;

        if( !file_exists($path) ){

            file_put_contents($path, '');
        }

        $this->_filePath = $path;
    }

    /**
     * Get file path.
     *
     * @param string $extension
     *
     * @return string
     * @throws \Exception if file don't exist.
     */
    protected function getFilePath(string $extension)
    {
        if( is_null($this->_filePath) ){

             $this->setFilePath($extension);
        }

        return $this->_filePath;
    }

    /**
     * Change default directory and filename.
     *
     * @param string $dir
     * @param string $filename
     */
    protected function setLoc(string $dir, string $filename)
    {
        $this->_dir = $dir;

        $this->_fileName = $filename;
    }

    /**
     * Get default or new directory and filename.
     *
     * @return string
     */
    protected function getLoc()
    {
        return ( basePath() . $this->_dir . $this->_fileName );
    }

}