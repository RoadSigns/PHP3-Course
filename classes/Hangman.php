<?php

    class Hangman
    {


        /**
         * @var int
         */
        private $numGuesses = 6;

        /**
         * @var Object
         */
        private $hangman;


        /**
         * Hangman constructor.
         */
        public function __construct()
        {

            if (isset($_SESSION['hangman'])){

                // Copy Hangman Object from SESSION
                $this->hangman = $_SESSION['hangman'];

            } else {
                
                $this->hangman = $this->_createDefaultObject();

            }

            // GUESS
            if (isset($_GET['letter'])){

                $this->_checkGuess();

            }

            // RESTART
            if (isset($_GET['restart'])){

                $this->_restartGame();
                $this->_createDefaultObject();

            }
        }


        /**
         */
        public function __destruct()
        {
            $_SESSION['hangman'] = $this->hangman;
        }

        //////////////////////////////////////////////////////////////////////////////
        // PUBLIC METHODS ////////////////////////////////////////////////////////////
        //////////////////////////////////////////////////////////////////////////////


        /**
         * @return string
         */
        public function outputMessage()
        {

            $uniqueLetters      = $this->_uniqueLetters($this->hangman->word);   // Count of unique guesses in selected word
            $correctGuesses     = count($this->hangman->correctGuesses);         // Count of correct guesses
            $incorrectGuesses   = count($this->hangman->incorrectGuesses);       // Count of incorrect guesses

            if ($incorrectGuesses == $this->numGuesses){

                $msg = "<p class='lose'>Sorry - You're DEAD!!  It was '".$this->hangman->word."'<p>";
                $this->hangman->complete = true;

            } elseif ($correctGuesses == $uniqueLetters){

                $msg = "<p class='win'>Congratulations - You WIN!!<p>";
                $this->hangman->complete = true;

            } else {

                $msg = '<p>Select a letter to guess...</p>';
                $this->hangman->complete = false;

            }
            return $msg;
        }


        /**
         * @return string
         */
        public function showWord()
        {

            $elements = array();
            $letters  = str_split($this->hangman->word);

            foreach ($letters as $letter) {

                if ($letter == " "){

                    $elements[] = '&nbsp;';

                } elseif (!in_array($letter, range('a', 'z'))) {

                    $elements[] = $letter;

                } elseif (in_array($letter, $this->hangman->correctGuesses)) {

                    $elements[] = $letter;

                } else {

                    $elements[] = '_';

                }
            }

            return implode(' ', $elements);
        }


        /**
         * @return string
         */
        public function showAlphabet()
        {

            $html = '';

            if ($this->hangman->complete == false) {

                foreach (range('a', 'z') as $letter) {

                    if (in_array($letter, $this->hangman->correctGuesses)) {

                        // Show letter as 'correct'
                        $html .= "\n\t<span class='letter correct'>$letter</span> ";

                    } elseif (in_array($letter, $this->hangman->incorrectGuesses)) {

                        // Show letter as 'incorrect;
                        $html .= "\n\t<span class='letter incorrect'>$letter</span> ";

                    } else {

                        // Show letter as a link
                        $html .= "\n\t<a href='?letter=$letter'><span class='letter'>$letter</span></a>";
                    }
                }
            }

            return $html;
        }


        /**
         * @desc    Return an <img /> tag generated from the current number of incorrect guesses
         * @return  string|boolean
         */
        public function displayImage()
        {

            $stage = count($this->hangman->incorrectGuesses);

            $imagePath = "/learn/phpcourse/resources/hangman/hangman_$stage.png";
            if (file_exists($_SERVER['DOCUMENT_ROOT'].$imagePath)){
                return "<img src='$imagePath' alt='Hangman Stage $stage' >";
            }

            return false;
        }


        //////////////////////////////////////////////////////////////////////////////
        // PRIVATE METHODS ///////////////////////////////////////////////////////////
        //////////////////////////////////////////////////////////////////////////////

        /**
         *
         */
        private function _restartGame()
        {
            unset($this->hangman);
        }


        /**
         *
         */
        private function _createDefaultObject()
        {

            $this->hangman = new stdClass;

            $this->hangman->word = $this->_selectWord();
            $this->hangman->correctGuesses = array();
            $this->hangman->incorrectGuesses = array();

            $this->hangman->complete = false;

            header('Location: ' . $_SERVER['PHP_SELF']);
            exit();

        }


        /**
         */
        private function _checkGuess()
        {

            $letter = filter_input(INPUT_GET, 'letter',     FILTER_SANITIZE_STRING);
            $guessedLetters = array_merge($this->hangman->correctGuesses, $this->hangman->incorrectGuesses);

            if (in_array($letter, range('a', 'z'))) {

                if (!in_array($letter, $guessedLetters)) {

                    if (in_array($letter, str_split($this->hangman->word))) {

                        $this->hangman->correctGuesses[] = $letter;

                    } else {

                        $this->hangman->incorrectGuesses[] = $letter;

                    }

                }

                header("Location: " . $_SERVER['PHP_SELF']);
                exit();
            }
        }


        /**
         * @param   type $string
         * @return  int
         */
        private function _uniqueLetters($string)
        {
            $alphaString    = preg_replace('/[^a-zA-Z]/','',$string);
            $arrayOfLetters = str_split($alphaString);
            $uniqueLetters  = array_unique($arrayOfLetters);
            return count($uniqueLetters);
        }


        /**
         * @return  string|boolean
         */
        private function _selectWord()
        {
            $filename = $_SERVER['DOCUMENT_ROOT'].'/learn/phpcourse/resources/welshPlacenamesV.csv';
            $contents = file_get_contents($filename);

            if ($contents){
                $words = explode("\n",$contents);

                if(is_array($words)){
                    $randomWord = $words[array_rand($words)];
                    return strtolower(trim($randomWord));
                }
            }
            return false;
        }


    }