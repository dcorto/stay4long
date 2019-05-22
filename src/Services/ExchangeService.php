<?php

namespace App\Services;

class ExchangeService {

    public function get($currency){

        //TODO: Fetch storage and return

        return [
            'rate' => rand(0,10),
        ];
    }

    public function update($currency, $rate){

        //TODO: Update the storage

        return true;
    }


}