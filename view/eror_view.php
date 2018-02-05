<?php


class Eror_view{
    public $Eror_msg;

    public function __construct($eror_msg){
        $this->Eror_msg = $eror_msg;
    }

    public function eror(){
        ?>
            <h4 class="eror">Eror:  <?= $this->Eror_msg?></h4>
        <?php
    }
}
?>