<?php
declare(strict_types = 1);

namespace SalmonDE\CalculationCommands\Commands;

use pocketmine\command\CommandSender;
use SalmonDE\CalculationCommands\Loader;

class DivideCommand extends CalculationCommand {

    public function __construct(Loader $plugin){
        parent::__construct('divide', $plugin);

        $this->setPermission('cmd.calculate.divide');
        $this->setUsage('/divide number1 number2 [...]');
    }

    public function onCommand(CommandSender $sender, string $label, array $params): bool{
        $this->parseParams($params);

        if(count($params) < 2){
            return false;
        }

        $calculation = implode(' §d/§r ', $params);
        $result = array_shift($params);

        foreach($params as $number){
            if($number === 0 or $number === 0.0){
                $sender->sendMessage($calculation."\n".'Division through zero detected');
                return true;
            }

            $result /= $number;
        }

        $sender->sendMessage($calculation."\n".(string) $result);
        return true;
    }
}
