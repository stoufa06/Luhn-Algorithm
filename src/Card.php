<?php
namespace LuhnAlgo;

/**
 * 
 * @author stoufa
 *
 */
class Card extends AbstractCard 
{
    /**
     * Correspondance table of double digits which are greater than 9 
     * the double of digits (0;1;2;3;4;5;6;7;8;9) became (0;2;4;6;8;1;3;5;7;9)
     * @var array
     */
    private $correspondenceTable = [0, 2, 4, 6, 8, 1, 3, 5, 7, 9];
    
    /**
     * Use Luhn Algorithm to validate card number
     * {@inheritDoc}
     * @see \LuhnAlgo\\AbstractCard::ensureIsValidCard()
     * @throws \InvalidArgumentException
     */
    public function ensureIsValidCard(string $card_number)
    {
        
        $rev_card_numver = strrev(strval($card_number));
        
        $length = strlen($card_number);
        $sum = 0;
        for($i = 0; $i < $length; $i++)
        {
            $digit = $rev_card_numver[$i];
            if ($i % 2 == 1) 
            {
                $digit = $this->correspondenceTable[$digit];
            }
            $sum += $digit;
        }
       
        if ($sum % 10 != 0) {
            throw new \InvalidArgumentException('Invalid card number!');
        }
    }
    
}