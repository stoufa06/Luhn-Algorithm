<?php
namespace LuhnAlgo\Test;

use LuhnAlgo\AbstractCard;


class Test 
{
    
    /**
     * Path to folder with list of json files to extract cards numbers
     * 
     * @var string
     */
    private $_dataFolder;
    
    /**
     * 
     * @param string $testDataFolder
     */
    public function __construct($testDataFolder) 
    {
        $this->_dataFolder = $testDataFolder;
    }
    
    /**
     * Read file content and decode it as json
     * @param string $file: path to file
     * @return array : array of \stdClass objects json decoded file content
     */
    private function _loadJsonFile($file) : array
    {
        return json_decode(read_file($file));
    }

    /**
     * List directory files and return an array with full files path
     * @param string $baseDir: path to folder
     * @return array : array of files path
     */
    private function _listDirectoryFiles($baseDir) : array
    {
        return array_map(
            function($value) use ($baseDir){
                return $baseDir.DIRECTORY_SEPARATOR.$value;
            },
            directory_map($baseDir)
        );
    }
    
    /**
     * Extract card distributer name from file name
     * @param string $file
     * @return string
     */
    private function _extractCardName(string $file) : string
    {
        $file_basename = basename($file, '.json');
        return implode(' ',
            array_map(
                function($str){
                    return ucfirst($str);
                },
                explode('_', $file_basename)
                )
            );
    }
    
    /**
     * Extract card numbers from an array of stdClass objects  
     * @param array $listCards
     * @return array : array of card numbers
     */
    private function _extractCardnumbers($listCards) : array
    {
        $cardNumbers = [];
        foreach ($listCards as $card) 
        {
            $cardNumbers[] = $card->CreditCard->CardNumber;
        }
        return $cardNumbers;
    }
    
    /**
     * Get random number from list [10,1000,100000, 10000000, 1000000000]
     * @return int
     */
    private function _randomNumber() : int
    {
        
        $values = [10,1000,100000, 10000000, 1000000000];
        return $values[mt_rand(0,4)];
    }
    
    /**
     * Execute test : 
     * 1 - List directory files
     * 2 - Fetch listed json files
     * 3 - Extract card name from each file name
     * 4 - Load json file in a variable
     * 5 - Extract card numbers as array from the variable
     * 6 - Fetch card numbers
     * 7 - Test valid card number
     * 8 - Increment card number with random number from predifined list
     * 9 - Test invalid card number
     * @param AbstractCard $card
     */
    public function execute(AbstractCard $card)
    {
        $testResult = [];
        // 1 - List directory files
        $listFiles = $this->_listDirectoryFiles($this->_dataFolder);
        
        // 2 - Fetch listed json files
        foreach ($listFiles as $file) 
        {
            // 3 - Extract card name from each file name
            $cardName = $this->_extractCardName($file);
                      
            // 4 - Load json file in a variable
            $cardList = $this->_loadJsonFile($file);
            
            // 5 - Extract card numbers as array from the variable
            $cardNumbers = $this->_extractCardnumbers($cardList);

            // 6 - Fetch card numbers
            foreach ($cardNumbers as $number) {
                $status = '';
                // 7 - Test valid card number
                try {
                    $card->ensureIsValidCard($number);
                    
                    $status = 'Success';
                } catch (\InvalidArgumentException $e) {
                    
                    $status = 'Fail';
                }
                
                $testResult[] = [
                    'cardName'      => $cardName,
                    'cardNumber'    => $number,
                    'status'        => $status,
                    'isValidNumber' => true
                ];
                
                // 8 - Increment card number with random number from predifined list
                $number += $this->_randomNumber();
                
                // 9 - Test invalid card number
                try {
                    $card->ensureIsValidCard($number);
                    $status = 'Success';
                    
                } catch (\InvalidArgumentException $e) {
                    
                    $status = 'Fail';
                }
                
                $testResult[] = [
                    'cardName'      => $cardName,
                    'cardNumber'    => $number,
                    'status'        => $status,
                    'isValidNumber' => false
                ];
            }
            
            
        }
        
        return $testResult;
        
    }
}