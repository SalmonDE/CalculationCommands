<?php
declare(strict_types = 1);

namespace SalmonDE\CalculationCommands\Commands;

use pocketmine\command\CommandSender;
use pocketmine\command\Command;
use SalmonDE\CalculationCommands\Loader;

class MultiplyCommand extends CalculationCommand {

    public function __construct(Loader $plugin){
        parent::__construct('multiply', $plugin);

        $this->setPermission('cmd.calculate.multiply');
        $this->setAliases(['*']);
        $this->setUsage('/multiply number1 number2 [...]');
    }

    public function onCommand(CommandSender $sender, Command $cmd, string $label, array $params): bool{
        $this->parseParams($params);

        if(count($params) < 2){
            return false;
        }

        $calculation = implode(' §d*§r ', $params);
        $result = array_shift($params);

        foreach($params as $number){
            $result *= $number;
        }

        $sender->sendMessage($calculation."\n".(string) $result);
        return true;
    }
}
