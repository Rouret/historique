<?php
    class File{
        private $file_url;
        function __construct($file_url)
        {
            $this->file_url=$file_url;
        }
        public function readArray(){
            $monfichier = fopen($this->file_url, 'r');
            $value=fgets($monfichier);
            fclose($monfichier);
            return json_decode(utf8_decode($value));
        }
        public function writeArray($data){
            $monfichier = fopen($this->file_url, 'w');
            fwrite($monfichier, utf8_encode(json_encode($data)));
            fclose($monfichier);
        }
        public function read(){
            $monfichier = fopen($this->file_url, 'r');
            $value=fgets($monfichier);
            fclose($monfichier);
            return $value;
        }
        public function write($data){
            $monfichier = fopen($this->file_url, 'w');
            fwrite($monfichier, $data);
            fclose($monfichier);
        }
    }
?>