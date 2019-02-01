<?php
declare(strict_types = 1);

namespace SalmonDE\CalculationCommands\Commands;

use pocketmine\command\CommandExecutor;
use pocketmine\command\PluginCommand;
use SalmonDE\CalculationCommands\Loader;

abstract class CalculationCommand extends PluginCommand implements CommandExecutor {

    public function __construct(string $cmdName, Loader $plugin){
        parent::__construct($cmdName, $plugin);
        $this->setExecutor($this);
    }

    final protected function parseParams(array &$params): void{
        $parsedParams = [];
        foreach($params as $key => $param){
            $param = str_replace(',', '.', preg_replace('/[^0-9.,-]/', '', $param));
            if(is_numeric($param)){
                if(ctype_digit($param)){
                    $parsedParams[] = (int) $param;
                }else{
                    $parsedParams[] = (float) $param;
                }
            }
        }

        $params = $parsedParams;
    }
}
