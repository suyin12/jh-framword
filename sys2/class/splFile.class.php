<?php

class splFile {

    public $fileName;
    public $mode;
    public $replace; //要替换的内容 或者 行数
    public $actionVal; //修改后的内容

    /*
     * Create a new SplFileObject representation of the file
     * Open it for reading and writing and place the pointer at the beginning of the file
     * @see fopen for additional modes
     */

    function repleace() {
        $file = new SplFileObject($this->fileName, 'a+');

        /*
         * Set a bitmask of the flags to apply - Only relates to reading from file
         * In this case SplFileObject::DROP_NEW_LINE to remove new line charachters
         * and SplFileObject::SKIP_EMPTY to remove empty lines
         */
        $file->setFlags(7);

        /*
         * Lock the file so no other user can interfere with reading and writing while we work with it
         */
        $file->flock(LOCK_EX);

        /*
         * Create a SplTempFileObject
         * 0 indicates not to use memory to store the temp file.
         * This is probably slower than using memory, but for a large file it will be much more effective
         * than loading the entire file into memory
         * @see http://www.php.net/manual/en/spltempfileobject.construct.php for more details
         */
        $temp = new SplTempFileObject(0);

        /*
         * Lock the temp file just in case
         */
        $temp->flock(LOCK_EX);
        /*
         * The line we're hoping to match and remove
         * DO NOT include any line ending charachters these have been stripped already
         */
        $delete = $this->replace;
        switch ($this->mode) {
            case "line":
                /*
                 * Iterate over each line and check its key
                 */
                foreach ($file as $key => $line) {
                    if ($key != $delete) {
                        /*
                         * If this line does NOT match out delete write it to the temp file
                         * Append a line ending to it
                         */
                        $temp->fwrite($line . PHP_EOL);
                    } else {
                        $temp->fwrite($this->actionVal . PHP_EOL);
                    }
                }
                break;
            case "string":
                /*
                 * Iterate over each line of the file only loading one line into memory at any point in time
                 * Use trim() on the line to ensure we don't have excess whitespace anywhere
                 */
                foreach ($file as $line) {

                    if (trim($line) != $delete) {
                        /*
                         * If this line does NOT match out delete write it to the temp file
                         * Append a line ending to it
                         */
                        $temp->fwrite($line . PHP_EOL);
                    } else {
                        $temp->fwrite($this->actionVal . PHP_EOL);
                    }
                }
                break;
        }
        /*
         * Truncate the existing file to 0
         */
        $file->ftruncate(0);


        /*
         * Write the temp file back to the existing file
         */
        foreach ($temp as $line) {

            /*
             * Iterate over temp file and put each line back into original file
             */
            $file->fwrite($line);
        }

        /*
         * Release the file locks
         */
        $temp->flock(LOCK_UN);
        $file->flock(LOCK_UN);
    }

}

?>
