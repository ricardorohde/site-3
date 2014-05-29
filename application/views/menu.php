<?php defined('SYSPATH') OR die('No direct access allowed.');
    echo '<ul>';
        if ($this->uri->segment(1)):
          echo '<li>'.html::anchor('','home', array('title' => 'home')).'</li>';
        endif;

        foreach($query as $row):
             echo '<li>';
             if(uri::segment(1) == $row->url):
                echo html::anchor($row->url,$row->menu_item, array('class'=>'selected','title' => 'contato'));
             else:
                echo html::anchor($row->url,$row->menu_item, array('title' => 'contato'));
             endif;
             echo '</li>';
        endforeach;
        echo '</ul>';
?>