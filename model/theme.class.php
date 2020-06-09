<?php 

class Theme
{
    private $_idTheme;
    private $_name;
    private $_color;
    private $_image;
    private $_description;
    private $_detailsDescription;
    private $_activity = [];

    public function __construct($idTheme, $name, $color, $image, $description, $detailsDescription, $activity)
    {
        $this->_idTheme = $idTheme;
        $this->_name = $name;
        $this->_color = $color;
        $this->_image = $image;
        $this->_description = $description;
        $this->_detailsDescription = $detailsDescription;
        $this->_activity = $activity;
        $this->_referent = $referent;
    }

    public function get_idTheme()
    {
        return $this->_idTheme;
    }

    public function set_idTheme($_idTheme)
    {
        $this->_idTheme = $_idTheme;

        return $this;
    }
   /* DANS DAO THEME =  public function addTheme()
    {

    }
    DANS DAO THEME = public function getListActivity()
    {

    } */

    public function get_name()
    {
        return $this->_name;
    }

    public function set_name($_name)
    {
        $this->_name = $_name;

        return $this;
    }

    public function get_color()
    {
        return $this->_color;
    }

    public function set_color($_color)
    {
        $this->_color = $_color;

        return $this;
    }

    public function get_image()
    {
        return $this->_image;
    }

    public function set_image($_image)
    {
        $this->_image = $_image;

        return $this;
    }

    public function get_description()
    {
        return $this->_description;
    }
 
    public function set_description($_description)
    {
        $this->_description = $_description;

        return $this;
    }
 
    public function get_detailsDescription()
    {
        return $this->_detailsDescription;
    }

    public function set_detailsDescription($_detailsDescription)
    {
        $this->_detailsDescription = $_detailsDescription;

        return $this;
    }

    public function get_activity()
    {
        return $this->_activity;
    }

    public function set_activity($_activity)
    {
        $this->_activity = $_activity;

        return $this;
    }

    public function get_referent()
    {
        return $this->_referent;
    }
 
    public function set_referent($_referent)
    {
        $this->_referent = $_referent;

        return $this;
    }

}