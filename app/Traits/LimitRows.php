<?php

namespace App\Traits;

trait LimitRows
{
    public int $size = 305; //max-height: 305px;
    public int $limit = 0;
    public bool $btnDisabled = true;

    public function setLimit(array $limits = []): void
    {
        if (empty($limits)){
            $this->limit = $this->limit + numRowsPaginate();
        }else{
            foreach ($limits as $key){
                $this->$key = $this->$key + numRowsPaginate();
            }
        }
    }

    public function setSize($size): void
    {
        $this->size = $size;
    }

    public function btnVerMas($limit, $rows, array $buttons = []): void
    {
        if ($rows > $limit) {
            if (empty($buttons)){
                $this->btnDisabled = false;
            }else{
                foreach ($buttons as $button){
                    $this->$button = false;
                }
            }

        }else{
            if (empty($buttons)){
                $this->btnDisabled = true;
            }else{
                foreach ($buttons as $button){
                    $this->$button = true;
                }
            }
        }
    }

}
