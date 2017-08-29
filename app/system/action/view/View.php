<?php

namespace app\system\action\view;

class View {
    

    // view data
    protected $data = [];

    /**
     * Set view data
     */
    public function __set( $key, $value )
    {
        $this->data[ $key ] = $value;
    }

    /**
     * Get view data
     */
    public function __get( $key )
    {
        if( array_key_exists( $key, $this->data ) )
        {
            return $this->data[ $key ];
        }
        return null;
    }

    /**
     * Render view file
     */
    public function render( $file = '/app/view/index.php')
    {
     //   if( is_file( $file ) )
     //   {
            extract($this->data);
            ob_start();
            include(base_path.$file);
            return ob_get_clean();
    //    }
     //   return 'File not found: '.$file;
    }
}