<?php
class Item extends WarlocKer
{
    public function __debugInfo()
    {
        return array(
            'string' => $this->string,
            'integer' => $this->integer,
            'boolean' => $this->boolean,
            'float' => $this->float,
            'decimal' => $this->decimal,
        );
    }
}
