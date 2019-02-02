<?php
declare(strict_types = 1);

namespace SalmonDE\CalculationCommands;

use pocketmine\plugin\PluginBase;
use SalmonDE\CalculationCommands\Commands\AddCommand;
use SalmonDE\CalculationCommands\Commands\DivideCommand;
use SalmonDE\CalculationCommands\Commands\MultiplyCommand;
use SalmonDE\CalculationCommands\Commands\SubtractCommand;

class Loader extends PluginBase {

    public function onEnable(): void{
        $this->getServer()->getCommandMap()->registerAll('CalculationCommands', [
            new AddCommand($this),
            new DivideCommand($this),
            new MultiplyCommand($this),
            new SubtractCommand($this)
        ]);
    }
}
