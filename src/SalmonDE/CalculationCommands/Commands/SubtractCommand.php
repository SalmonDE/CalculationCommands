<?php
declare(strict_types = 1);

namespace SalmonDE\CalculationCommands\Commands;

use pocketmine\command\CommandSender;
use SalmonDE\CalculationCommands\Loader;

class SubtractCommand extends CalculationCommand {

    public function __construct(Loader $plugin){
        parent::__construct('subtract', $plugin);

        $this->setPermission('cmd.calculate.subtract');
        $this->setAliases(['minus', '-']);
        $this->setUsage('/subtract number1 number2 [...]');
    }

    public function onCommand(CommandSender $sender, string $label, array $params): bool{
        $this->parseParams($params);

        if(count($params) < 2){
            return false;
        }

        $calculation = implode(' §d-§r ', $params);
        $result = array_shift($params);

        foreach($params as $number){
            $result -= $number;
        }

        $sender->sendMessage($calculation."\n".(string) $result);
        return true;
    }
}
