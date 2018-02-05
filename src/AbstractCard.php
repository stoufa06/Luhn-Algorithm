<?php
namespace LuhnAlgo;

abstract class AbstractCard 
{
    /**
     * 
     * @var string
     */
    private $cardNumber;
    
    /**
     * 
     * @param string $card_number
     */
    public function __construct(string $card_number = '') 
    {
        if (func_num_args() == 1) {
            $this->ensureIsValidCard($card_number);
            $this->cardNumber = $card_number;
        }
        
    }
    
    /**
     * 
     * @param string $card_number
     */
    public abstract function ensureIsValidCard(string $card_number);
}