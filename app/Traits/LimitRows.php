<?php

namespace App\Traits;

trait LimitRows
{
    public int $size = 305; //max-height: 305px;
    public int $limit = 0;
    public bool $btnDisabled = true;

    public function setLimit(): void
    {
        $this->limit = $this->limit + numRowsPaginate();
    }

    public function setSize($size): void
    {
        $this->size = $size;
    }

    public function btnVerMas($limit, $rows): void
    {
        if ($rows > $limit) {
            $this->btnDisabled = false;
        }else{
            $this->btnDisabled = true;
        }
    }

}
