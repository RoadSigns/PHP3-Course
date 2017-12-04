<?php

    class QRCode
    {

        // https://developers.google.com/chart/infographics/docs/overview

        /**
         *
         */
        private $baseUrl;  // should be private, only accessed in this class

        /**
         *
         */
        protected $params;


        function __construct()
        {

            $this->baseUrl = 'https://chart.googleapis.com/chart';

            // TEST PARAMS
            //------------
            $this->params = array();
            $this->params['cht'] =  'qr';               // Type of image: 'qr' means QR code.
            $this->params['chs'] =  '150x150';          // Size of the image in pixels, in the format <width>x<height>
            $this->params['chl'] =  'Hello%20world';    // The data to encode. Must be URL-encoded.  (  utf8_encode()  )

        }


        function setSize($size)
        {
            if (is_int($size)) {
                $this->params['chs'] = "${size}x${size}";
            } else {
                return;
            }
        }

        function setContent($content)
        {
            $encodedContent = utf8_encode($content);
            $this->params['chl'] = $encodedContent;
        }



        /**
         *
         */
        function generateQRCode()
        {

            $paramArray = array();

            foreach($this->params as $key => $value){
                $paramArray[] = "$key=$value";
            }

            $params = implode('&',$paramArray);

            $URL = $this->baseUrl.'?'.$params;

            return $URL;

        }


    }
